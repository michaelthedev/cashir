<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/transactions', [TransactionController::class, 'list'])
    ->name('transactions');

Route::get('/settings/{group}', [SettingsController::class, 'show'])
    ->name('settings.group');

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
