<?php

declare(strict_types=1);

namespace App\Services\Gateways;

use GuzzleHttp\Client;

final class FlutterwavePayment extends AbstractGateway
{
    private Client $client;

    public function __construct()
    {
        $config = config('flutterwave');

        $this->client = new Client([
            'base_uri' => "{$config['base_url']}/v3/",
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

        $request = $this->client->post('payments', [
            'json' => [
                'tx_ref' => $this->reference,
                'amount' => $this->amount,
                'currency' => 'NGN',
                'customer' => [
                    'email' => $this->customer['email'],
                    'name' => $this->customer['name']
                ],
                'customizations' => [
                    'title' => 'Payment',
                    'description' => 'Test Payment'
                ],
                'redirect_url' => $this->callback
            ]
        ]);

        $result = json_decode($request->getBody()->getContents(), true);
        if (!empty($result['data']['link'])) {
            $response['error'] = false;
            $response['message'] = 'Payment initialized';
            $response['data']['url'] = $result['data']['link'];
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

        $reference = $data['tx_ref'] ?? null;
        if (!$reference) {
            $response['message'] = 'Invalid reference';
            return $response;
        }

        $request = $this->client->get("transactions/verify_by_reference", [
            'query' => ['tx_ref' => $reference]
        ]);
        $result = json_decode($request->getBody()->getContents());

        $response['error'] = false;
        $response['message'] = 'success';
        $response['data'] = [
            'status' => ($result->data->status == 'successful') ? 'success' : 'failed',
            'reference' => $reference
        ];

        return $response;
    }
}
