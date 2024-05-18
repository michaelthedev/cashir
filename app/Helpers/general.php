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

function settings(string $name, ?string $default = null): ?string
{
    return cache()->remember('site_settings', 3600, function() {
        return \App\Models\Settings::all()
            ->mapWithKeys(function($setting) {
                return [$setting->name => $setting->value];
            });
    })[$name] ?? $default;
}
