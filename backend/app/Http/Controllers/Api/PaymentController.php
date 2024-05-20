<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentService $paymentService
    ) {}

    public function options(): JsonResponse
    {
        return response()->json([
            'message' => 'success',
            'data' => $this->paymentService->getOptions()
        ]);
    }

    public function initialize(Request $request): JsonResponse
    {
        $request->validate([
            'amount' => 'required|numeric',
            'gateway' => 'required|exists:payment_gateways,id'
        ]);

        // Initialize payment
        $payment = $this->paymentService
            ->setUser($request->user())
            ->initialize($request->gateway, $request->amount);

        if ($payment['status']) {
            return response()->json([
                'message' => $payment['message'],
                'data' => $payment['data']
            ]);
        } else {
            return response()->json([
                'message' => $payment['message']
            ], 422);
        }
    }
}
