<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TransactionFetch extends Component
{
    public $wallet;

    public function transaction_fetch()
    {
        //ini_set('max_execution_time', 300);

        $address = $this->wallet->address;
        $block_range = 100000;
        $startblock = 0;
        $endblock = $this->wallet->get_latest_block();

        $block = $startblock;
        $step = $block_range;

        $this->wallet->transactions()->delete();

        Log::info('Downloading transactions for address : '.$address);
        while($block <= $endblock)
        {
            $response = [];

            $response = $this->fetch_range($address,$block,$block+$step);

            if($response == -1) // over the api limit
            {
                $step = (int)($step/2); // set smaller block step and try again
            }
            else
            {
                $block += $step;
                $step = $block_range; // reset block step

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
                            'value'=>$value->value/10**18,
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
                        $this->log = 'Database exception';
                    }
                }

                Log::info('Transactions found: '.count($response));

            }
        }
        Log::info('Downloading transactions for finished');
        $this->wallet->synced_at = now();
        $this->wallet->save();
        $this->emit('sync_finished');

    }


    public function fetch_range($address, $startblock, $endblock) : array|int
    {
        Log::info('Downloading block range : '.$startblock.' - '.$endblock);
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
        Log::info('Found : '. count($transactions). 'transactions');

        if(count($transactions)==10000)
        {
            return -1; // over API limit
            Log::info('Error : API Limit reached' );
        }
        else

        return $transactions;
    }

    public function render()
    {
        return view('livewire.transaction-fetch');
    }
}
