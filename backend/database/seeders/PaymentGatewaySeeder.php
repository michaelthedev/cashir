<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'config' => '[]'
            ],
            [
                'name' => 'Flutterwave',
                'code' => 'flutterwave',
                'class' => 'App\Services\Gateways\FlutterwavePayment',
                'config' => '[]'
            ]
        ];

        DB::table('payment_gateways')->upsert(
            $gateways,
            ['code'],
            ['name', 'class', 'config']
        );
    }
}
