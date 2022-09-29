<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function show(Wallet $wallet)
    {
        return view('models.wallet.show')->with('wallet',$wallet);;
    }


    public function create()
    {
        return view('models.wallet.create');
    }


    public function index()
    {
        $wallets = Wallet::latest()->paginate(6);

        return view('models.wallet.index')->with('wallets',$wallets);
    }


    public function store()
    {
        $wallet_data = $this->validate_input();

        Wallet::create([
            'address'=> $wallet_data['address'],
            'name'=> $wallet_data['name']
        ]);

        return redirect(route('wallet.index'));
    }


    public function transactions(Wallet $wallet)
    {
        $total = $wallet->transactions()->count();
        $transactions = $wallet->transactions()->latest()->paginate(6);

        return view('models.wallet.transactions')
        ->with('total',$total)
        ->with('transactions',$transactions);
    }


    public function validate_input()
    {
        return request()->validate([
            'address' => 'required|alpha_num|size:42|unique:wallets,address',
            'name' => 'required|string|min:6|max:255',
        ]);
    }

}
