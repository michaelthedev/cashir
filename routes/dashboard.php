<?php

use App\Http\Controllers\Dashboard\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/transactions', [])
    ->name('transactions');

Route::get('/settings/payment', [])
    ->name('settings.payment');

Route::get('/payments', [])
    ->name('payments');

Route::middleware('guest')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('/login', function () {
            return view('dashboard');
        })->name('login');

        Route::post('login', [AuthController::class, 'authenticate']);

        Route::get('register', [AuthController::class, 'register'])
            ->name('register');
    });
});
