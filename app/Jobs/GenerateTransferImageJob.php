<?php

namespace App\Jobs;

use App\Services\GenerateTransferImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateTransferImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transferId;

    /**
     * إنشاء المهمة.
     *
     * @param int $transferId
     */
    public function __construct($transferId)
    {
        $this->transferId = $transferId;
    }

    /**
     * تنفيذ المهمة.
     *
     * @return void
     */
    public function handle(GenerateTransferImageService $imageService)
    {
        // إنشاء الصورة وتحويلها إلى Base64
        $imageData = $imageService->generateTransferImage($this->transferId);
        // تخزين الصورة في الكاش مع مفتاح خاص بالحوالة
        Cache::put('transfer_image_' . $this->transferId, $imageData, now()->addMinutes(10));
    }
}
