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

        // Validate only some fields and allow others to be saved dynamically
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:1000',
            'business_hours' => 'nullable|string|max:1000',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'items_per_page' => 'nullable|integer|min:1|max:100',
            'maintenance_mode' => 'nullable|in:0,1',
            'logo' => 'nullable|image|max:2048',
        ]);

        // Handle logo upload if present
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $file = $request->file('logo');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $path = $file->storeAs('uploads', $filename, 'public');

            // Save the logo filename as a setting
            SiteSetting::updateOrCreate(
                ['key' => 'logo'],
                ['value' => basename($path)]
            );
        }

        // Save all other inputs (except _token, _method, logo)
        $except = ['_token', '_method', 'logo'];
        $data = $request->except($except);

        foreach ($data as $key => $value) {
            // normalize booleans
            if (is_array($value)) {
                $value = json_encode($value);
            }

            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => (string) $value]
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
