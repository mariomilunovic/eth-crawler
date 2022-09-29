<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Wallet extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $wallet;

    public function __construct($wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wallet');
    }
}
