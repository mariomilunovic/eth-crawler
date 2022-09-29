<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactions(){
        return $this->hasMany(Transaction::class);
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
