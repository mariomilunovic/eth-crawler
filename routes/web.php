<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/transaction/test',[TransactionController::class,'api_test'])->name('transaction.api_test');
Route::get('/transaction/search',[TransactionController::class,'show_search_form'])->name('transaction.show_search_form');
Route::post('/transaction/search',[TransactionController::class,'search'])->name('transaction.search');
Route::get('/transaction/livesearch',[TransactionController::class,'livesearch'])->name('transaction.livesearch');

Route::get('/wallet',[WalletController::class,'index'])->name('wallet.index');
Route::post('/wallet',[WalletController::class,'store'])->name('wallet.store');
Route::get('/wallet/create',[WalletController::class,'create'])->name('wallet.create');
Route::get('/wallet/{wallet}',[WalletController::class,'show'])->name('wallet.show');
Route::get('/wallet/{wallet}/transactions',[WalletController::class,'transactions'])->name('wallet.transactions');




