<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->string('blockNumber');
            $table->string('timeStamp');
            $table->string('hash')->unique();
            $table->string('nonce');
            $table->string('blockHash');
            $table->string('transactionIndex');
            $table->string('from');
            $table->string('to');
            $table->string('value');
            $table->string('gas');
            $table->string('gasPrice');
            $table->string('isError');
            $table->string('txreceipt_status');
            $table->string('input');
            $table->string('contractAddress');
            $table->string('cumulativeGasUsed');
            $table->string('gasUsed');
            $table->string('confirmations');
            $table->string('methodId');
            $table->string('functionName');

            $table->timestamps();
            

            $table->unsignedBigInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
