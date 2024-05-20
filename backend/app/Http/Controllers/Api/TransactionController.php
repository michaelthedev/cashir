<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TransactionController extends Controller
{
    public function index(): JsonResponse
    {
        $user = auth()->user();
        return response()->json([
            'message' => 'User transactions',
            'data' => $user->transactions()
                ->paginate()
        ]);
    }

    public function show(int $trans_id): JsonResponse
    {
        $transaction = Transaction::whereTransId($trans_id)
            ->first();

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Transaction details',
            'data' => $transaction
        ]);
    }
}
