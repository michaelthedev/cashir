<?php

use App\Http\Controllers\Callbacks\PaymentCallbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::any('/_callbacks/payment/{provider}', [PaymentCallbackController::class, 'handle'])
    ->name('callbacks.payment');
