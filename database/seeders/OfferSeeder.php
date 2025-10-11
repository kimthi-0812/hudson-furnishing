<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offers = [
            [
                'title' => 'Khuyến Mãi Hè - Giảm Đến 50%',
                'description' => 'Mua sắm nội thất cao cấp với ưu đãi lớn trong mùa hè này!',
                'image' => 'offer1.jpg',
                'start_date' => '2023-06-01',
                'end_date' => '2023-08-31',
                'discount_type' => 'percentage',
                'discount_value' => 50,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bộ Phòng Ngủ Đặc Biệt',
                'description' => 'Bộ Phòng ngủ hoàn chỉnh từ 33.9 triệu . Bao gồm giường, tủ quần áo, tab đầu giường và bàn trang điểm.',
                'image' => 'offer2.jpg',
                'start_date' => '2023-09-01',
                'end_date' => '2023-12-31',
                'discount_type' => 'fixed',
                'discount_value' => 33900000,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Miễn Phí Vận Chuyển Toàn Quốc',
                'description' => 'Đơn hàng từ 5 triệu trở lên sẽ được miễn phí vận chuyển toàn quốc.',
                'image' => 'offer3.jpg',
                'start_date' => '2023-01-01',
                'end_date' => '2023-12-31',
                'discount_type' => 'fixed',
                'discount_value' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        foreach ($offers as $offer) {
            Offer::create($offer);
        }
    }
}
