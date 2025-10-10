<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

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
            'hero_image_1' => 'nullable|image|max:2048',
            'hero_image_2' => 'nullable|image|max:2048',
            'hero_image_3' => 'nullable|image|max:2048',
            'google_map' => 'nullable|string|max:1000',
        ]);

        // Handle logo upload if present
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $file = $request->file('logo');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $path = $file->storeAs('uploads', $filename, 'public');

            // Delete the old logo if it exists
            $oldLogo = SiteSetting::where('key', 'logo')->first();
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo->value);
            }

            // Save the logo filename as a setting
            SiteSetting::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $path]
            );
        }


        // lưu các setting khác (loại trừ token/method/logo)
        $except = ['_token', '_method', 'logo', 'google_map'];
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

        // Xử lý Google Map riêng
        if ($request->filled('google_map')) {
            $googleMap = $request->input('google_map');

            // Nếu admin dán cả iframe, thì tách lấy src
            if (preg_match('/src="([^"]+)"/', $googleMap, $matches)) {
                $googleMap = $matches[1];
            }

            SiteSetting::updateOrCreate(
                ['key' => 'google_map'],
                ['value' => $googleMap]
            );
        } else {
            SiteSetting::where('key', 'google_map')->delete();
        }

        // Handle hero carousel images
        foreach (['hero_image_1', 'hero_image_2', 'hero_image_3'] as $key) {
            if ($request->hasFile($key) && $request->file($key)->isValid()) {
                $file = $request->file($key);
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                $path = $file->storeAs('uploads/hero', $filename, 'public');

                // Xóa ảnh cũ nếu có
                $oldImage = SiteSetting::where('key', $key)->first();
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage->value);
                }

                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path]
                );
            }
        }


        if (class_exists(\Illuminate\Support\Facades\Cache::class)) {
        \Illuminate\Support\Facades\Cache::forget('site_settings');
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Cập nhật cài đặt thành công.');
    }
}
