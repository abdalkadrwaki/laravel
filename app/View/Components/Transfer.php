<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Transfer extends Component
{
    public $title;
    public $amount;

    /**
     * إنشاء مكون Transfer.
     *
     * @param  string  $title
     * @param  int  $amount
     * @return void
     */
    public function __construct($title, $amount)
    {
        $this->title = $title;
        $this->amount = $amount;
    }

    /**
     * الحصول على محتوى العرض الذي سيتم تقديمه.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.transfer');
    }
}
