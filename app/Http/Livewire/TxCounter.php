<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TxCounter extends Component
{

    public $wallet;
    public $tx_count;

    protected $listeners = ['sync_finished'];

    public function get_transaction_count()
    {
        return $this->wallet->transactions()->count();

    }

    public function mount()
    {
        $this->tx_count = $this->get_transaction_count();
    }

    public function update()
    {
        $this->tx_count = $this->get_transaction_count();
    }

    public function sync_finished()
    {
        $this->update();
    }



    public function render()
    {
        return view('livewire.tx-counter');
    }
}
