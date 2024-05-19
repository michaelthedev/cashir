<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class SettingsController extends Controller
{
    public function show(string $group): View
    {
        $settings = settings();

        if (view()->exists("dashboard.settings.{$group}")) {
            return view("dashboard.settings.{$group}")
                ->with('settings', $settings)
                ->with('group', $group);
        }

        abort(404, 'Settings group not found');
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'group' => 'required|string',
            'settings' => 'required|array',
        ]);

        $settings = $data['settings'];

        foreach ($settings as $name => $value) {
            Settings::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );
        }

        // forget cache
        cache()->forget('site_settings');

        // return to the settings page
        return redirect()->route(
            'dashboard.settings.group',
            ['group' => $data['group']]
        )->with('message', 'Settings updated successfully');
    }
}
