<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/payments/callback', 'payments.callback')
    ->name('payments.callback');
