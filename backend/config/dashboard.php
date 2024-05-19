<?php

return [
    'navTitle' => config('app.name') . ' Dashboard',
    'navs' => [
        [
            'name' => 'Dashboard',
            'icon' => 'sitemap-4',
            'route' => 'dashboard.home'
        ],
        [
            'name' => 'Transactions',
            'icon' => 'descending-sorting',
            'route' => 'dashboard.transactions'
        ],
        [
            'name' => 'Payment Settings',
            'icon' => 'sliders',
            'route' => 'dashboard.settings.group',
            'params' => ['group' => 'payment']
        ],
        [
            'name' => 'Make Payment',
            'icon' => 'wallet-2',
            'route' => 'dashboard.payments'
        ]
    ]
];
