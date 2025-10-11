<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Hudson Furnishing',
                'description' => 'The name of the website',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Transform Your Space with Premium Furniture',
                'description' => 'The tagline displayed on the website',
            ],
            [
                'key' => 'site_logo',
                'value' => 'uploads/logo/hudson-furnishing-logo.png',
                'description' => 'Path to the site logo image',
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@hudsonfurnishing.com',
                'description' => 'Main contact email address',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1 (555) 123-4567',
                'description' => 'Main contact phone number',
            ],
            [
                'key' => 'contact_address',
                'value' => '123 Furniture Street, Design District, NY 10001',
                'description' => 'Physical address of the business',
            ],
            [
                'key' => 'business_hours',
                'value' => "T2 - T6: 8:00 - 18:00\nT7: 9:00 - 17:00\nCN: Nghỉ",
                'description' => 'Business operating hours',
            ],
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/hudsonfurnishing',
                'description' => 'Facebook page URL',
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/hudsonfurnishing',
                'description' => 'Instagram profile URL',
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/hudsonfurnishing',
                'description' => 'Twitter profile URL',
            ],
            [
                'key' => 'social_pinterest',
                'value' => 'https://pinterest.com/hudsonfurnishing',
                'description' => 'Pinterest profile URL',
            ],
            [
                'key' => 'ticker_enabled',
                'value' => 'true',
                'description' => 'Enable or disable the ticker display',
            ],
            [
                'key' => 'ticker_text',
                'value' => 'Welcome to Hudson Furnishing - Premium Furniture for Every Home',
                'description' => 'Text to display in the ticker',
            ],
            [
                'key' => 'visitor_counter_enabled',
                'value' => 'true',
                'description' => 'Enable or disable the visitor counter',
            ],
            [
                'key' => 'featured_products_count',
                'value' => '8',
                'description' => 'Number of featured products to display on homepage',
            ],
            [
                'key' => 'products_per_page',
                'value' => '12',
                'description' => 'Number of products to display per page',
            ],
            [
                'key' => 'reviews_per_page',
                'value' => '10',
                'description' => 'Number of reviews to display per page',
            ],
            [
                'key' => 'gallery_images_per_page',
                'value' => '16',
                'description' => 'Number of gallery images to display per page',
            ],
            [
                'key' => 'meta_title',
                'value' => 'Hudson Furnishing - Premium Furniture Store',
                'description' => 'Default meta title for SEO',
            ],
            [
                'key' => 'meta_description',
                'value' => 'Discover premium furniture for every room at Hudson Furnishing. Quality pieces for bedroom, living room, dining room, home office, and outdoor spaces.',
                'description' => 'Default meta description for SEO',
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'furniture, home decor, bedroom furniture, living room furniture, dining room furniture, office furniture, outdoor furniture',
                'description' => 'Default meta keywords for SEO',
            ],
            [
                'key' => 'google_analytics_id',
                'value' => 'GA-XXXXXXXXX-X',
                'description' => 'Google Analytics tracking ID',
            ],
            [
                'key' => 'google_maps_api_key',
                'value' => 'YOUR_GOOGLE_MAPS_API_KEY',
                'description' => 'Google Maps API key for location services',
            ],
            [
                'key' => 'currency_symbol',
                'value' => '$',
                'description' => 'Currency symbol for pricing',
            ],
            [
                'key' => 'currency_code',
                'value' => 'USD',
                'description' => 'Currency code for pricing',
            ],
            [
                'key' => 'free_shipping_threshold',
                'value' => '500',
                'description' => 'Minimum order amount for free shipping',
            ],
            [
                'key' => 'return_policy_days',
                'value' => '30',
                'description' => 'Number of days for return policy',
            ],
            [
                'key' => 'warranty_years',
                'value' => '2',
                'description' => 'Standard warranty period in years',
            ],
            [
                'key' => 'maintenance_email',
                'value' => 'maintenance@hudsonfurnishing.com',
                'description' => 'Email for maintenance notifications',
            ],
            [
                'key' => 'support_email',
                'value' => 'support@hudsonfurnishing.com',
                'description' => 'Email for customer support',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }
    }
}
