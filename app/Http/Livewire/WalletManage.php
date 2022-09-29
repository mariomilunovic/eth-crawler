<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class WalletManage extends Component
{

    public $wallet;
    public $log;

    public function fetch_range($address, $startblock, $endblock) : array|int
    {
        $this->log = 'fetching block range : '.$startblock.' - '.$endblock;
        
        $response = Http::get('https://api.etherscan.io/api', [
            'module' => 'account',
            'action' => 'txlist',
            'address' => $address,
            'startblock' => (string)($startblock),
            'endblock' =>  (string)($endblock),
            'page' => '1',
            'offset' => '10000',
            'sort' => 'asc',
            'apikey' => env('ETHERSCAN_API_KEY'),
        ]);

        $transactions = json_decode($response)->result;

        if(count($transactions)==10000)

        return -1; // over API limit

        else

        return $transactions;
    }


    public function fetch_all()
    {

        $address = $this->wallet->address;

        $block_step = 1000000;
        $startblock = 0;
        $endblock = $this->get_latest_block();

        $block = $startblock;
        $step = $block_step;

        while($block <= $endblock)
        {
            $response = [];
            $response = $this->fetch_range($address,$block,$block+$step);


            if($response == -1) // over the api limit
            {
                $step = (int)($block_step/2); // set smaller block step and try again
            }
            else
            {
                $block += $step;
                $step = $block_step; // reset block step

                foreach($response as $value)
                {

                    try{

                        Transaction::create([
                            'blockNumber'=>$value->blockNumber,
                            'timeStamp'=>$value->timeStamp,
                            'hash'=>$value->hash,
                            'nonce'=>$value->nonce,
                            'blockHash'=>$value->blockHash,
                            'transactionIndex'=>$value->transactionIndex,
                            'from'=>$value->from,
                            'to'=>$value->to,
                            'value'=>$value->value,
                            'gas'=>$value->gas,
                            'gasPrice'=>$value->gasPrice,
                            'isError'=>$value->isError,
                            'txreceipt_status'=>$value->txreceipt_status,
                            'input'=>$value->input,
                            'contractAddress'=>$value->contractAddress,
                            'cumulativeGasUsed'=>$value->cumulativeGasUsed,
                            'gasUsed'=>$value->gasUsed,
                            'confirmations'=>$value->confirmations,
                            'methodId'=>$value->methodId,
                            'functionName'=>$value->functionName,
                            'wallet_id'=>$this->wallet->id
                        ]);
                    }
                    catch (\Exception $e)
                    {
                        $this->log = 'DB Error';
                    }
                }
            }
        }
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

    public function render()
    {
        return view('livewire.wallet-manage');
    }
}
