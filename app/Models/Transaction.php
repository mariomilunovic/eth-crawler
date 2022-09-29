<?php

namespace App\Models;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = []; // set fillable to all attributes

    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }
}
