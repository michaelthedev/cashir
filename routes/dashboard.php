<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/transactions', [TransactionController::class, 'list'])
    ->name('transactions');

Route::prefix('settings')->group(function () {
    Route::patch('/', [SettingsController::class, 'update'])
        ->name('settings.update');

    Route::get('/{group}', [SettingsController::class, 'show'])
        ->name('settings.group');
});

Route::prefix('payments')->group(function () {
    Route::view('/', 'dashboard.payments.create')
        ->name('payments');

    Route::post('/', [PaymentController::class, 'create'])
        ->name('payments.create');

    Route::view('/notice', 'dashboard.payments.notice')
        ->name('payments.notice');
});


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
