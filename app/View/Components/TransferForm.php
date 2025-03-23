<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TransferForm extends Component
{
    public $currencies;
    public $destinations;

    public function __construct($currencies, $destinations)
    {
        $this->currencies = $currencies;
        $this->destinations = $destinations;
    }

    public function render()
    {
        return view('components.transfer-form');
    }
}
