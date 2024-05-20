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
                ->setCallback(route('payments.callback'))
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
}
