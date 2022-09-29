<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Balance extends Component
{

    public $wallet;
    public $balance;

    public function get_balance()
    {
        $response = Http::get('https://api.etherscan.io/api', [
            'module' => 'account',
            'action' => 'balance',
            'address' => $this->wallet->address,
            'apikey' => env('ETHERSCAN_API_KEY'),
        ]);

        return (json_decode($response)->result)*0.00000000192;
    }

    public function mount()
    {
        $this->balance = $this->get_balance();
    }

    public function render()
    {
        return view('livewire.balance');
    }
}
