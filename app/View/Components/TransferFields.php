<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TransferFields extends Component
{
    public $destinations;
    public $currencies;

    public function __construct($destinations, $currencies)
    {
        $this->destinations = $destinations;
        $this->currencies = $currencies;
    }

    public function render()
    {
        return view('components.transfer-fields');
    }
}

