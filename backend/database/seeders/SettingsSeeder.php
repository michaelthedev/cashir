<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->upsert([
            [
                'name' => 'payment_gateway',
                'value' => null,
                'group' => 'payment',
            ],
            [
                'name' => 'currency_name',
                'value' => 'NGN',
                'group' => 'site',
            ],
            [
                'name' => 'currency_symbol',
                'value' => '₦',
                'group' => 'site',
            ]
        ], ['name'], ['value', 'group']);
    }
}
