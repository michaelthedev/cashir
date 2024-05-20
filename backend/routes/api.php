<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });

    Route::get('user', [UserController::class, 'get']);

    Route::prefix('payments')->group(function () {
        Route::get('options', [PaymentController::class, 'options']);
        Route::post('initialize', [PaymentController::class, 'initialize']);
    });

    Route::prefix('transactions')->group(function () {
        Route::get('/', [TransactionController::class, 'index']);
        Route::get('{id}', [TransactionController::class, 'show']);
    });

    // Statistics
    Route::prefix('stats')->group(function () {
        Route::get('transactions', [StatisticsController::class, 'transactions']);
    });
});

