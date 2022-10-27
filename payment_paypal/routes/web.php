<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\HistoryController;





Route::get('history',[HistoryController::class,'show']);
Route::get('history/action',[HistoryController::class,'action'])->name('history.action');
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [PayPalController::class, 'goPayment']);

Route::get('payment',[PayPalController::class, 'payment'])->name('payment');
Route::get('cancel',[PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [PayPalController::class, 'success'])->name('payment.success');


