<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

function currentRouteName(): string
{
    return Route::currentRouteName();
}

function isCurrentRoute(string $name): bool
{
    return Route::is($name);
}

function settings(?string $name = null, ?string $default = null): null|string|array
{
    $settings = cache()->remember('site_settings', 3600, function() {
        return \App\Models\Settings::all()
            ->mapWithKeys(function($setting) {
                return [$setting->name => $setting->value];
            })->toArray();
    });

    if ($name === null) {
        return $settings;
    } else {
        return $settings[$name] ?? $default;
    }
}

function money($amount): string
{
    return settings('currency_symbol') . number_format($amount, 2);
}
