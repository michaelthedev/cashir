<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class SettingsController extends Controller
{
    public function show(string $group): View
    {
        $settings = Settings::whereGroup($group);

        // if view for group exists, return it
        if (view()->exists("dashboard.settings.{$group}")) {
            return view("dashboard.settings.{$group}", compact('settings'));
        }

        abort(404, 'Settings group not found');
    }
}
