<?php

namespace App\Http\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use Livewire\WithPagination;

class LiveSearch extends Component
{


    use WithPagination;

    public $wallets;
    public $wallet;
    public $transactions;
    public $wallet_id;
    public $startblock="";
    public $endblock="";
    public $total;
    public $message="";
    public $messageClass="";

    protected $rules = [
            'wallet_id' => 'required',

    ];

    public function search()
    {

        $this->validate();

        $this->wallet = Wallet::where('id',$this->wallet_id)->first();

        if($this->startblock =="")
        {
            $this->startblock = 0;
        }


        if($this->endblock =="")
        {
            $this->endblock = $this->wallet->get_latest_block();
        }

        $queryResult = $this->wallet->transactions()
                                ->where('blockNumber','>',$this->startblock)
                                ->where('blockNumber','<',$this->endblock)->latest()->get();

        if(count($queryResult )>0)
        {
            $this->messageClass = "btn-green";
            $this->transactions = $queryResult ;
            $this->message = "Total transaction found : ".count($queryResult );
        }
        else
        {
            $this->messageClass = "btn-red";
            $this->transactions = $queryResult ;
            $this->message = "Total transaction found : ".count($queryResult );
        }



    }



    public function render()
    {
        return view('livewire.live-search');
    }
}
