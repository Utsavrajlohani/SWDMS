<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        
        // Ensure defaults if table is empty
        $defaults = [
            'app_name' => config('app.name', 'SWDMS'),
            'gst_rate' => '18',
            'support_email' => 'support@swdms.in',
            'currency_symbol' => '₹',
        ];

        foreach ($defaults as $key => $value) {
            if (!isset($settings[$key])) {
                $settings[$key] = $value;
            }
        }

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->except('_token');

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
