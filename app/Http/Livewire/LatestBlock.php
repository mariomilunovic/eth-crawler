<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LatestBlock extends Component
{

    public $latest_block;


    public function get_latest_block()
    {
        $response = Http::get('https://api.etherscan.io/api', [
            'module' => 'proxy',
            'action' => 'eth_blockNumber',
            'apikey' => env('ETHERSCAN_API_KEY'),
        ]);

        return hexdec(json_decode($response)->result);
    }

    public function mount()
    {
        $this->latest_block = $this->get_latest_block();
    }

    public function update()
    {
        $this->latest_block = $this->get_latest_block();
    }


    public function render()
    {
        return view('livewire.latest-block');
    }
}
