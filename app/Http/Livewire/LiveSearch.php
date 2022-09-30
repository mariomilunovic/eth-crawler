<?php

namespace App\Http\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Http\Request;
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
    public $ammount = 10;
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

        $queryResult = 0;

        $this->total = $this->wallet->transactions()
        ->where('blockNumber','>',$this->startblock)
        ->where('blockNumber','<',$this->endblock)->count();


        $queryResult = $this->wallet->transactions()
        ->where('blockNumber','>',$this->startblock)
        ->where('blockNumber','<',$this->endblock)->latest()->take($this->ammount)->get();

        $this->ammount = 10;

        if($this->total>0)
        {
            $this->messageClass = "btn-green";
            $this->transactions = $queryResult ;
            $this->message = 'Showing '.count($queryResult ).' of '.$this->total;
        }
        else
        {
            $this->messageClass = "btn-red";
            $this->transactions = $queryResult ;
            $this->message = "No transactions found";
        }

    }

    public function render()
    {
        return view('livewire.live-search');
    }


    public function load()
    {
        $this->ammount+=10;
        $this->search();
    }

}
