
// Job Class: ProcessTransferTransaction.php
<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\Transfer;
use App\Services\BalanceService;
use App\Services\AntiFraudService;
use App\Events\TransferProcessed;
use Carbon\Carbon;

class ProcessTransferTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 60;

    public function __construct(
        private User $user,
        private array $transferData
    ) {}

    public function handle()
    {
        DB::transaction(function () {
            $this->checkPreconditions();
            $this->processTransfer();
        });
    }

    private function checkPreconditions()
    {
        // التحقق من الرصيد
        if (!BalanceService::hasSufficientBalance(
            $this->user->id,
            $this->transferData['sent_currency'],
            $this->totalAmount()
        )) {
            abort(422, 'رصيد غير كافي');
        }

        // التحقق من الاحتيال
        AntiFraudService::checkTransaction(
            $this->user,
            $this->transferData,
            request()->ip()
        );
    }

    private function processTransfer()
    {
        $transfer = $this->createTransfer();
        $this->updateBalances($transfer);
        $this->generateDocuments($transfer);
        $this->notifyParties($transfer);
    }

    private function createTransfer(): Transfer
    {
        return Transfer::create([
            'user_id' => $this->user->id,
            'recipient_name' => $this->transferData['recipient_name'],
            'recipient_mobile' => $this->transferData['recipient_mobile'],
            'destination' => $this->transferData['destination'],
            'sent_currency' => $this->transferData['sent_currency'],
            'sent_amount' => $this->transferData['sent_amount'],
            'received_currency' => $this->transferData['received_currency'],
            'received_amount' => $this->transferData['received_amount'],
            'fees' => $this->transferData['fees'] ?? 0,
            'exchange_rate' => $this->transferData['exchange_rate'] ?? 1,
            'note' => $this->transferData['note'] ?? null,
            'password' => $this->generateSecurePassword(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }

    private function generateSecurePassword(): string
    {
        return substr(str_replace(['/', '+', '='], '',
            base64_encode(random_bytes(4))), 0, 6);
    }

    private function updateBalances(Transfer $transfer)
    {
        BalanceService::deductFromSender(
            $transfer->user_id,
            $transfer->sent_currency,
            $this->totalAmount()
        );

        BalanceService::addToReceiver(
            $transfer->destination,
            $transfer->received_currency,
            $transfer->received_amount
        );
    }

    private function generateDocuments(Transfer $transfer)
    {
        GenerateTransferImageJob::dispatch($transfer)
            ->delay(now()->addSeconds(10));
    }

    private function notifyParties(Transfer $transfer)
    {
        TransferProcessed::dispatch($transfer);
    }

    private function totalAmount(): float
    {
        return (float)$this->transferData['sent_amount']
             + (float)($this->transferData['fees'] ?? 0);
    }

    public function failed(\Throwable $exception)
    {
        Log::critical('Transfer failed: '.$exception->getMessage(), [
            'user' => $this->user->id,
            'data' => $this->transferData
        ]);

        Notification::send($this->user, new TransferFailedNotification());
    }
}
