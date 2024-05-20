<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\PaymentGatewayI;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Log;

final class PaymentService
{
    private User $user;

    public function getOptions(): array
    {
        $gateways = PaymentGateway::all();

        return [
            'amount' => [
                'min' => 1,
                'max' => 10000
            ],
            'gateways' => $gateways->map(function ($gateway) {
                return [
                    'id' => $gateway['id'],
                    'name' => $gateway['name']
                ];
            })
        ];
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function initialize(int $gateway_id, float $amount): array
    {
        $response['status'] = false;
        $response['message'] = 'Error occurred while initializing payment';

        $reference = 'deposit_'.uniqid();
        $gateway = PaymentGateway::find($gateway_id);
        $provider = new $gateway['class']();

        if (!$provider instanceof PaymentGatewayI) {
            $response['message'] = 'Invalid payment gateway';
            return $response;
        }

        $this->createTransaction($gateway, $amount, $reference);

        try {
            $payment = $provider->setAmount($amount)
                ->setReference($reference)
                ->setCustomer($this->user->only(['email', 'name']))
                ->setCallback(route('callbacks.payment', $gateway['code']))
                ->checkout();

            if ($payment->isSuccessful()) {
                $url = $payment->getData()['url'];

                $response['status'] = true;
                $response['message'] = $payment->getMessage();
                $response['data']['url'] = $url;
            }

            $response['message'] = $payment->getMessage();
        } catch (\Exception $e) {
            Log::error('Payment: '.$e->getMessage(), [
                'gateway' => $gateway['name'],
                'e' => $e
            ]);

            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    private function createTransaction(
        PaymentGateway $gateway,
        float $amount,
        string $reference
    ): void
    {
        Transaction::new([
            'user_id' => $this->user->id,
            'amount' => $amount,
            'reference' => $reference,
            'type' => 'payment',
            'flow' => 'credit',
            'details' => [
                'gateway_id' => $gateway->id,
            ]
        ]);
    }

    public function handleCallback(PaymentGatewayI $provider, array $data): array
    {
        $response['status'] = false;
        $response['message'] = 'Payment verification failed';

        try {
            $result = $provider->verifyCallback($data);
            if ($result['error']) {
                Log::error('payment.callback', [
                    'data' => $data,
                    'result' => $result
                ]);

                $response['message'] = $result['message'];
                return $response;
            }

            $transaction = Transaction::whereReference($result['data']['reference'])
                ->first();

            if (!$transaction) {
                $response['message'] = 'Invalid transaction reference';

                Log::error('payment.callback', [
                    'message' => $response['message'],
                    'result' => $result
                ]);
                return $response;
            }

            $transaction->status = $result['data']['status'];
            $transaction->save();

            if ($result['data']['status'] === 'success') {
                $response['status'] = true;
                $response['message'] = 'Your payment has been verified';
            }
        } Catch (\Exception $e) {
            Log::error('payment.callback', [
                'data' => $data,
                'message' => $e->getMessage(),
                'e' => $e
            ]);
        }

        return $response;
    }
}
