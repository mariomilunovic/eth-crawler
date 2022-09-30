<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
//use Illuminate\Pagination\Paginator;
//use Illuminate\Pagination\LengthAwarePaginator;

class TransactionController extends Controller
{

    public function api_test()
    {

        //'address' => '0xaa7a9ca87d3694b5755f213b5d04094b8d0f0a6f', big wallet
        //'address' => '0xd1250868E7aB85b0Cd87DbBd98F4e6016dF4693E', 16 transaction in-out
        //'address' => '0x8f54972F4Ca40bD3ffC8b085f6Ece1739C40c65f', another big wallet (good example)
        //'address' => '0x3e91F4071b4C82833D8C5dEbf90c2D9F1CFa8741', 1362 transactions
        //'address' => '0xDAFEA492D9c6733ae3d56b7Ed1ADB60692c98Bc5', 15000 transactions

        $response = Http::get('https://api.etherscan.io/api', [
            'module' => 'account',
            'action' => 'txlist',
            'address' => '0xd1250868E7aB85b0Cd87DbBd98F4e6016dF4693E', // 16 transactions
            'startblock' =>  '0',
            'endblock' =>   (string)($this->get_latest_block()),
            'page' => '1',
            'offset' => '10000',
            'sort' => 'desc',
            'apikey' => 'ZNBYMR91YI1IM598367B5WQ28MZ3QSP6Q9',
        ]);

        $transactions = json_decode($response)->result;

        return view('models.transaction.search_results')->with('transactions',$transactions);
    }



    public function show_search_form()
    {
        //dd(request());
        $wallets = Wallet::latest()->get();
        return view('models.transaction.search_form')
            ->with('wallets',$wallets);
    }

    public function livesearch()
    {
        //dd(request());
        $wallets = Wallet::latest()->get();
        return view('models.transaction.livesearch')
            ->with('wallets',$wallets);
    }

    public function search()
    {
        $search_params = $this->validate_input();

        $wallet = Wallet::where('id',$search_params['wallet_id'])->first();



        $transactions = $wallet->transactions()
                                ->where('blockNumber','>',$search_params['startblock'])
                                ->where('blockNumber','<',$search_params['endblock'])->latest()->paginate(6);

        $total = $wallet->transactions()
        ->where('blockNumber','>',$search_params['startblock'])
        ->where('blockNumber','<',$search_params['endblock'])->count();



        return view('models.wallet.transactions')
                ->with('transactions',$transactions)
                ->with('total',$total);
    }

    public function validate_input()
    {
        return request()->validate([
            'wallet_id' => 'required',
            'startblock' => 'required|integer|max:99999999',
            'endblock' => 'required|integer|max:99999999',
        ]);
    }

    public function get_latest_block()
    {
        $response = Http::get('https://api.etherscan.io/api', [
            'module' => 'proxy',
            'action' => 'eth_blockNumber',
            'apikey' => env('ETHERSCAN_API_KEY'),
        ]);

        return hexdec(json_decode($response)->result);
    }

}
