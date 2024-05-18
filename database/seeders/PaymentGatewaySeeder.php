<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gateways = [
            [
                'name' => 'Paystack',
                'code' => 'paystack',
                'class' => 'App\Services\Gateways\PaystackPayment',
                'config' => []
            ],
            [
                'name' => 'Flutterwave',
                'code' => 'flutterwave',
                'class' => 'App\Services\Gateways\FlutterwavePayment',
                'config' => []
            ]
        ];

        // use DB::table
        foreach ($gateways as $gateway) {
            PaymentGateway::create($gateway);
        }
    }
}
