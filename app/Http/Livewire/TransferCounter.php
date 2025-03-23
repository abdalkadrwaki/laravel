<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transfer;

class TransferCounter extends Component
{
    public $transferCount;

    public function mount()
    {
        $this->transferCount = $this->getTransferCount();
    }

    public function getTransferCount()
    {
        return Transfer::where('destination', auth()->id())
                       ->whereIn('status', ['Pending', 'Frozen'])
                       ->count();
    }

    public function updated()
    {
        $this->transferCount = $this->getTransferCount();
    }

    public function render()
    {
        return view('livewire.transfer-counter');
    }
}


