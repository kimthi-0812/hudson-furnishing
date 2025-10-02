<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_address' => 'required|string|max:500',
            'business_hours' => 'required|string|max:500',
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_pinterest' => 'nullable|url|max:255',
            'ticker_enabled' => 'boolean',
            'ticker_text' => 'nullable|string|max:500',
            'visitor_counter_enabled' => 'boolean',
            'featured_products_count' => 'required|integer|min:1|max:20',
            'products_per_page' => 'required|integer|min:1|max:50',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'meta_keywords' => 'required|string|max:500',
            'currency_symbol' => 'required|string|max:10',
            'currency_code' => 'required|string|max:10',
            'free_shipping_threshold' => 'required|numeric|min:0',
            'return_policy_days' => 'required|integer|min:1',
            'warranty_years' => 'required|integer|min:1',
        ]);

        foreach ($validatedData as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
