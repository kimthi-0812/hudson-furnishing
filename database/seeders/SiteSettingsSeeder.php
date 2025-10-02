<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'site_name' => 'Hudson Furnishing',
            'site_tagline' => 'Nội thất cao cấp cho mọi không gian',
            'site_description' => 'Hudson Furnishing cung cấp nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn. Chất lượng thủ công gặp gỡ thiết kế hiện đại.',
            'site_keywords' => 'nội thất, furniture, cao cấp, phòng ngủ, phòng khách, phòng ăn, văn phòng',
            'contact_email' => 'info@hudsonfurnishing.vn',
            'contact_phone' => '+84 (0) 123 45 67 89',
            'contact_address' => "123 Đường Nội Thất\nQuận Thiết Kế, TP.HCM 700000",
            'business_hours' => "T2 - T6: 8:00 - 18:00\nT7: 9:00 - 17:00\nCN: Nghỉ",
            'facebook_url' => 'https://facebook.com/hudsonfurnishing',
            'twitter_url' => 'https://twitter.com/hudsonfurnishing',
            'instagram_url' => 'https://instagram.com/hudsonfurnishing',
            'linkedin_url' => 'https://linkedin.com/company/hudsonfurnishing',
            'google_analytics' => '',
            'google_maps_api' => '',
            'meta_author' => 'Hudson Furnishing',
            'meta_robots' => 'index,follow',
            'items_per_page' => '12',
            'maintenance_mode' => '0',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
