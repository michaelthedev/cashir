<?php

declare(strict_types=1);

namespace App\Services\Gateways;

use GuzzleHttp\Client;

final class PaystackPayment extends AbstractGateway
{
    private Client $client;

    public function __construct()
    {
        $config = config('paystack');

        $this->client = new Client([
            'base_uri' => "{$config['base_url']}/",
            'headers' => [
                'Authorization' => 'Bearer '.$config['secret_key'],
                'Content-Type'=> 'application/json'
            ]
        ]);
    }

    public function checkout(): self
    {
        $response = [
            'error' => true,
            'message' => 'Failed to initialize payment'
        ];

        $request = $this->client->post('transaction/initialize', [
            'json' => [
                'reference' => $this->reference,
                'amount' => $this->amount * 100,
                'currency' => 'NGN',
                'email' => $this->customer['email'],
                'callback_url' => $this->callback
            ]
        ]);

        $result = json_decode($request->getBody()->getContents(), true);

        if ($result['status'] === true) {
            $response['error'] = false;
            $response['message'] = 'Payment initialized';
            $response['data']['url'] = $result['data']['authorization_url'];
        }

        $this->response = $response;
        return $this;
    }

    public function verify(string $reference): array
    {
        return [];
    }

    public function verifyCallback(array $data): array
    {
        $response['error'] = false;

        $reference = $data['trxref'] ?? null;
        if (!$reference) {
            $response['message'] = 'Invalid reference';
            return $response;
        }

        $request = $this->client->get("transaction/verify/{$reference}");
        $result = json_decode($request->getBody()->getContents());

        $response['error'] = false;
        $response['message'] = 'success';
        $response['data'] = [
            'status' => ($result->data->status == 'success') ? 'success' : 'failed',
            'reference' => $reference
        ];

        return $response;
    }
}
