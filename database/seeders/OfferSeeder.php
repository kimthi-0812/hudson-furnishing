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
                'description' => 'Đại hạ giá mùa hè trên các sản phẩm nội thất được chọn. Ưu đãi có thời hạn!',
                'start_date' => now()->subDays(5),
                'end_date' => now()->addDays(25),
                'discount_type' => 'percentage',
                'discount_value' => 50,
                'status' => 'active',
            ],
            [
                'title' => 'Bộ Phòng Ngủ Đặc Biệt',
                'description' => 'Bộ phòng ngủ hoàn chỉnh từ 33.9 triệu VND. Bao gồm giường, tủ quần áo, bàn đầu giường và tủ trang điểm.',
                'start_date' => now()->subDays(10),
                'end_date' => now()->addDays(20),
                'discount_type' => 'fixed',
                'discount_value' => 8500000, // 8.5 triệu VND
                'status' => 'active',
            ],
            [
                'title' => 'Giảm Giá Khách Hàng Mới',
                'description' => 'Ưu đãi chào mừng khách hàng mới - giảm 15% cho đơn hàng đầu tiên trên 8.5 triệu VND.',
                'start_date' => now()->subDays(30),
                'end_date' => now()->addDays(60),
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'status' => 'active',
            ],
            [
                'title' => 'Bộ Văn Phòng Hoàn Chỉnh',
                'description' => 'Thiết lập văn phòng tại nhà hoàn chỉnh với bàn, ghế và tủ lưu trữ chỉ 33.9 triệu VND. Tiết kiệm 5.1 triệu VND!',
                'start_date' => now()->subDays(7),
                'end_date' => now()->addDays(15),
                'discount_type' => 'fixed',
                'discount_value' => 5100000, // 5.1 triệu VND
                'status' => 'active',
            ],
            [
                'title' => 'Khuyến Mãi Nội Thất Ngoài Trời',
                'description' => 'Biến đổi không gian ngoài trời với bộ sưu tập nội thất sân vườn của chúng tôi. Giảm đến 40%.',
                'start_date' => now()->subDays(3),
                'end_date' => now()->addDays(17),
                'discount_type' => 'percentage',
                'discount_value' => 40,
                'status' => 'active',
            ],
            [
                'title' => 'Phòng Ăn Đặc Biệt',
                'description' => 'Bộ phòng ăn thanh lịch với bàn ăn, ghế ăn và tủ ly. Từ 25.5 triệu VND.',
                'start_date' => now()->subDays(12),
                'end_date' => now()->addDays(8),
                'discount_type' => 'fixed',
                'discount_value' => 3400000, // 3.4 triệu VND
                'status' => 'active',
            ],
            [
                'title' => 'Bộ Sưu Tập Sofa Cao Cấp',
                'description' => 'Sofa và sofa góc cao cấp với chất liệu cao cấp. Các mẫu phiên bản giới hạn.',
                'start_date' => now()->subDays(8),
                'end_date' => now()->addDays(22),
                'discount_type' => 'percentage',
                'discount_value' => 25,
                'status' => 'active',
            ],
            [
                'title' => 'Khuyến Mãi Giải Pháp Lưu Trữ',
                'description' => 'Tổ chức ngôi nhà của bạn với bộ sưu tập nội thất lưu trữ. Tủ quần áo, tủ và nhiều hơn nữa.',
                'start_date' => now()->subDays(15),
                'end_date' => now()->addDays(5),
                'discount_type' => 'percentage',
                'discount_value' => 30,
                'status' => 'active',
            ],
            [
                'title' => 'Giảm Giá Sinh Viên',
                'description' => 'Giá đặc biệt cho sinh viên và giáo viên. Yêu cầu thẻ sinh viên hợp lệ.',
                'start_date' => now()->subDays(20),
                'end_date' => now()->addDays(40),
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'status' => 'active',
            ],
            [
                'title' => 'Sự Kiện Thanh Lý',
                'description' => 'Thanh lý cuối cùng các sản phẩm ngừng sản xuất. Giá giảm đến 70% so với giá gốc.',
                'start_date' => now()->subDays(2),
                'end_date' => now()->addDays(10),
                'discount_type' => 'percentage',
                'discount_value' => 70,
                'status' => 'active',
            ],
            [
                'title' => 'Bộ Sưu Tập Chất Liệu Cao Cấp',
                'description' => 'Nội thất được chế tác từ chất liệu cao cấp bao gồm gỗ sồi nguyên khối, gỗ mahogany và da.',
                'start_date' => now()->subDays(25),
                'end_date' => now()->addDays(35),
                'discount_type' => 'fixed',
                'discount_value' => 6800000, // 6.8 triệu VND
                'status' => 'active',
            ],
            [
                'title' => 'Đặc Biệt Lễ Hội',
                'description' => 'Ưu đãi lễ hội sớm - đặt nội thất ngay bây giờ để giao hàng vào tháng 12.',
                'start_date' => now()->subDays(1),
                'end_date' => now()->addDays(45),
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'status' => 'active',
            ],
            [
                'title' => 'Giảm Giá Mua Số Lượng',
                'description' => 'Mua 3 sản phẩm trở lên và tiết kiệm 20% cho toàn bộ đơn hàng. Hoàn hảo để trang trí nhiều phòng.',
                'start_date' => now()->subDays(18),
                'end_date' => now()->addDays(12),
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'status' => 'active',
            ],
            [
                'title' => 'Bộ Sưu Tập Nhà Thiết Kế',
                'description' => 'Các mẫu nội thất độc quyền của nhà thiết kế với phong cách độc đáo và chất lượng thủ công cao cấp.',
                'start_date' => now()->subDays(6),
                'end_date' => now()->addDays(24),
                'discount_type' => 'fixed',
                'discount_value' => 4250000, // 4.25 triệu VND
                'status' => 'active',
            ],
            [
                'title' => 'Nội Thất Thân Thiện Môi Trường',
                'description' => 'Nội thất bền vững được làm từ vật liệu tái chế và quy trình thân thiện với môi trường.',
                'start_date' => now()->subDays(14),
                'end_date' => now()->addDays(16),
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'status' => 'active',
            ],
        ];

        foreach ($offers as $offer) {
            Offer::create($offer);
        }
    }
}
