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
