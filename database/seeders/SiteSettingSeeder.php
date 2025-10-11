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
                'description' => 'Tên của website',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Chuyển Đổi Không Gian Sống Với Nội Thất Đẳng Cấp',
                'description' => 'The tagline displayed on the website',
            ],
            [
                'key' => 'site_logo',
                'value' => 'uploads/logo/hudson-furnishing-logo.png',
                'description' => 'Đường dẫn logo của website',
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@hudsonfurnishing.com',
                'description' => 'Địa chỉ email liên hệ chính',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+84 909 909 909',
                'description' => 'Main contact phone number',
            ],
            [
                'key' => 'contact_address',
                'value' => '36/5 Đường D5 Phường 25, Quận Bình Thạnh, TP.HCM',
                'description' => 'Địa chỉ của doanh nghiệp',
            ],
            [
                'key' => 'business_hours',
                'value' => 'Thứ Hai - Thứ Sáu: 9:00 AM - 7:00 PM, Thứ Bảy: 10:00 AM - 6:00 PM, Chủ Nhật: 12:00 PM - 5:00 PM',
                'description' => 'Giờ làm việc',

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
                'value' => 'Chào Mừng Đến Với Hudson Furnishing - Nơi Mang Đến Nội Thất Đẳng Cấp Cho Mọi Không Gian!',
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
                'value' => 'Hubson Furnishing - Thương Hiệu Nội Thất Hàng Đầu',
                'description' => 'Default meta title for SEO',
            ],
            [
                'key' => 'meta_description',
                'value' => 'Khám Phá Nội Thất Cao Cấp Cho Mọi Không Gian Tại Hubson Furnishing. Những Món Đồ Chất Lượng Cho Phòng Ngủ, Phòng Khách, Phòng Ăn, Văn Phòng Tại Nhà Và Không Gian Ngoài Trời.',
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
                'value' => 'đ',
                'description' => 'Currency symbol for pricing',
            ],
            [
                'key' => 'currency_code',
                'value' => 'VND',
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
