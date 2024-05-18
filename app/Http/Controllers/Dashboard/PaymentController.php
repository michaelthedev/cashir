<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\PaymentGatewayI;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

final class PaymentController extends Controller
{
    public function create(Request $request): RedirectResponse|View
    {
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        $gateway_id = settings('payment_gateway');
        if (!$gateway_id) {
            return redirect()->back()
                ->with('error', 'Payment gateway is not set');
        }

        $reference = 'deposit_'.uniqid();
        $gateway = PaymentGateway::find($gateway_id);
        $provider = new $gateway['class']();

        if (!$provider instanceof PaymentGatewayI) {
            return redirect()->back()
                ->with('error', 'Invalid payment gateway');
        }

        try {
            $payment = $provider->setAmount($request->amount)
                ->setReference($reference)
                ->setCustomer([
                    'email' => 'test@test.com',
                    'name' => 'Tester'
                ])
                ->setCallback(route('payments.callback'))
                ->checkout();

            if ($payment->isSuccessful()) {
                $url = $payment->getData()['url'];

                return redirect()->route('dashboard.payments.notice')
                    ->with('message', $payment->getMessage())
                    ->with('url', $url);
            }

            return redirect()->back()
                ->with('error', $payment->getMessage());
        } catch (\Exception $e) {
            Log::error('Payment: '.$e->getMessage(), [
                'gateway' => $gateway['name'],
                'e' => $e
            ]);

            return redirect()->back()
                ->with('errorMessage', $e->getMessage());
        }
    }
}
