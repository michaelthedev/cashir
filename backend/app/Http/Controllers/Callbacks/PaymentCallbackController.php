<?php

declare(strict_types=1);

namespace App\Http\Controllers\Callbacks;

use App\Interfaces\PaymentGatewayI;
use App\Models\PaymentGateway;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class PaymentCallbackController
{
    public function handle(Request $request, string $provider): View
    {
        sleep(3);
        $gateway = PaymentGateway::where('name', $provider)
            ->firstOrFail();

        $provider = new $gateway['class']();
        if (!$provider instanceof PaymentGatewayI) {
            return view('callbacks.payment')
                ->with('status', 'error')
                ->with('message', 'Invalid payment gateway');
        }

        $paymentService = new PaymentService();
        $handle = $paymentService->handleCallback($provider, $request->all());

        return view('callbacks.payment')
            ->with('status', $handle['status'])
            ->with('message', $handle['message']);
    }
}
