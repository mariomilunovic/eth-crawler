<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TransactionCounter extends Component
{
    /**
    * Create a new component instance.
    *
    * @return void
    */

    public $total_transactions;
    public $latest_local_block;
    public function __construct($wallet)
    {
        $this->total_transactions = $wallet->transactions()->count();
        $this->latest_local_block = $wallet->transactions()->max('blockNumber');
    }

    /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
    public function render()
    {
        return view('components.transaction-counter');
    }
}
