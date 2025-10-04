<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            // Reviews for Modern Platform Bed (Product ID: 1)
            [
                'product_id' => 1,
                'name' => 'Nguyễn Thị Lan',
                'email' => 'lan.nguyen@email.com',
                'rating' => 5,
                'comment' => 'Tôi rất thích chiếc giường này! Ngăn kéo lưu trữ hoàn hảo để giữ phòng ngủ gọn gàng. Lắp ráp dễ dàng và chất lượng tuyệt vời.',
                'approved' => true,
            ],
            [
                'product_id' => 1,
                'name' => 'Trần Văn Minh',
                'email' => 'minh.tran@email.com',
                'rating' => 4,
                'comment' => 'Giường đẹp với thiết kế hiện đại. Nền giường chắc chắn và ngăn kéo hoạt động mượt mà. Chỉ có vấn đề nhỏ về thời gian giao hàng.',
                'approved' => true,
            ],
            [
                'product_id' => 1,
                'name' => 'Lê Thị Hương',
                'email' => 'huong.le@email.com',
                'rating' => 5,
                'comment' => 'Bổ sung hoàn hảo cho phòng ngủ hiện đại của chúng tôi. Đường nét sạch sẽ và chức năng vượt quá mong đợi. Rất được khuyên dùng!',
                'approved' => true,
            ],

            // Reviews for Oak Wardrobe (Product ID: 2)
            [
                'product_id' => 2,
                'name' => 'Phạm Đức Thành',
                'email' => 'thanh.pham@email.com',
                'rating' => 5,
                'comment' => 'Tủ quần áo gỗ sồi đẹp với chất lượng thủ công xuất sắc. Cửa trượt hoạt động hoàn hảo và có nhiều không gian lưu trữ.',
                'approved' => true,
            ],
            [
                'product_id' => 2,
                'name' => 'Võ Thị Mai',
                'email' => 'mai.vo@email.com',
                'rating' => 4,
                'comment' => 'Cấu trúc chắc chắn và vân gỗ đẹp. Chiếm nhiều không gian hơn mong đợi nhưng chất lượng xứng đáng.',
                'approved' => true,
            ],

            // Reviews for Sectional Sofa (Product ID: 16)
            [
                'product_id' => 16,
                'name' => 'Hoàng Văn Nam',
                'email' => 'nam.hoang@email.com',
                'rating' => 5,
                'comment' => 'Ghế sofa góc cực kỳ thoải mái. Hoàn hảo cho những đêm xem phim gia đình. Vải bền và dễ vệ sinh.',
                'approved' => true,
            ],
            [
                'product_id' => 16,
                'name' => 'Đặng Thị Linh',
                'email' => 'linh.dang@email.com',
                'rating' => 4,
                'comment' => 'Sofa tuyệt vời với độ thoải mái xuất sắc. Cấu hình hình chữ L hoạt động hoàn hảo trong phòng khách của chúng tôi. Giao hàng nhanh chóng.',
                'approved' => true,
            ],
            [
                'product_id' => 16,
                'name' => 'Bùi Minh Tuấn',
                'email' => 'tuan.bui@email.com',
                'rating' => 5,
                'comment' => 'Chất lượng và độ thoải mái xuất sắc. Chiếc sofa góc này đã trở thành tâm điểm của phòng khách chúng tôi. Xứng đáng từng đồng!',
                'approved' => true,
            ],

            // Reviews for Farmhouse Dining Table (Product ID: 17)
            [
                'product_id' => 17,
                'name' => 'Ngô Thị Hoa',
                'email' => 'hoa.ngo@email.com',
                'rating' => 5,
                'comment' => 'Bàn ăn phong cách trang trại đẹp có thể ngồi thoải mái cho gia đình 8 người. Hoàn thiện distressed tạo nét đặc trưng chân thực.',
                'approved' => true,
            ],
            [
                'product_id' => 17,
                'name' => 'Lý Văn Hùng',
                'email' => 'hung.ly@email.com',
                'rating' => 4,
                'comment' => 'Cấu trúc chắc chắn và thiết kế đẹp. Bàn nặng nhưng điều đó thể hiện chất lượng. Hoàn hảo cho các buổi tụ họp gia đình.',
                'approved' => true,
            ],

            // Reviews for Executive Desk (Product ID: 18)
            [
                'product_id' => 18,
                'name' => 'Cao Thị Lan',
                'email' => 'lan.cao@email.com',
                'rating' => 5,
                'comment' => 'Bàn làm việc điều hành hoàn hảo cho văn phòng tại nhà. Nhiều không gian lưu trữ và hệ thống quản lý cáp giữ mọi thứ ngăn nắp.',
                'approved' => true,
            ],
            [
                'product_id' => 18,
                'name' => 'Đinh Văn Quang',
                'email' => 'quang.dinh@email.com',
                'rating' => 4,
                'comment' => 'Bàn làm việc xuất sắc với vẻ ngoài chuyên nghiệp. Ngăn kéo rộng rãi và bề mặt hoàn hảo cho màn hình kép.',
                'approved' => true,
            ],

            // Reviews for Patio Dining Set (Product ID: 19)
            [
                'product_id' => 19,
                'name' => 'Vũ Thị Thu',
                'email' => 'thu.vu@email.com',
                'rating' => 5,
                'comment' => 'Bộ bàn ghế sân vườn chống thời tiết trông đẹp và bền bỉ ngoài trời. Hoàn hảo cho việc tiếp khách.',
                'approved' => true,
            ],
            [
                'product_id' => 19,
                'name' => 'Nguyễn Văn Đức',
                'email' => 'duc.nguyen@email.com',
                'rating' => 4,
                'comment' => 'Đồ nội thất ngoài trời chất lượng tốt. Ghế thoải mái và bàn chắc chắn. Lắp ráp đơn giản.',
                'approved' => true,
            ],

            // Reviews for Complete Bedroom Set (Product ID: 5)
            [
                'product_id' => 5,
                'name' => 'Trịnh Thị Nga',
                'email' => 'nga.trinh@email.com',
                'rating' => 5,
                'comment' => 'Biến đổi hoàn toàn phòng ngủ! Tất cả các món đồ đều phù hợp hoàn hảo và chất lượng xuất sắc. Giá trị tuyệt vời cho số tiền bỏ ra.',
                'approved' => true,
            ],
            [
                'product_id' => 5,
                'name' => 'Hồ Văn Tài',
                'email' => 'tai.ho@email.com',
                'rating' => 4,
                'comment' => 'Bộ phòng ngủ đẹp với phong cách nhất quán. Dịch vụ giao hàng và lắp ráp chuyên nghiệp và hiệu quả.',
                'approved' => true,
            ],

            // Reviews for Living Room Set (Product ID: 20)
            [
                'product_id' => 20,
                'name' => 'Lương Thị Bích',
                'email' => 'bich.luong@email.com',
                'rating' => 5,
                'comment' => 'Làm mới hoàn toàn phòng khách với bộ này. Mọi thứ phối hợp đẹp mắt và chất lượng hàng đầu.',
                'approved' => true,
            ],
            [
                'product_id' => 20,
                'name' => 'Đỗ Minh Khang',
                'email' => 'khang.do@email.com',
                'rating' => 4,
                'comment' => 'Bộ phòng khách tuyệt vời đã biến đổi không gian của chúng tôi. Tủ giải trí có nhiều không gian lưu trữ cho tất cả phương tiện của chúng tôi.',
                'approved' => true,
            ],

            // Reviews for Complete Dining Set (Product ID: 17)
            [
                'product_id' => 17,
                'name' => 'Phan Thị Hạnh',
                'email' => 'hanh.phan@email.com',
                'rating' => 5,
                'comment' => 'Bộ bàn ăn thanh lịch hoàn hảo cho việc tổ chức tiệc tối. Ghế thoải mái và bàn rộng rãi.',
                'approved' => true,
            ],
            [
                'product_id' => 17,
                'name' => 'Tôn Văn Long',
                'email' => 'long.ton@email.com',
                'rating' => 4,
                'comment' => 'Bộ phòng ăn đẹp với chất lượng thủ công xuất sắc. Tủ bên cung cấp thêm không gian lưu trữ và trưng bày.',
                'approved' => true,
            ],

            // Reviews for Complete Office Set (Product ID: 18)
            [
                'product_id' => 18,
                'name' => 'Vương Thị Hoa',
                'email' => 'hoa.vuong@email.com',
                'rating' => 5,
                'comment' => 'Thiết lập văn phòng tại nhà hoàn hảo! Tất cả các món đồ hoạt động liền mạch và tạo ra không gian làm việc chuyên nghiệp.',
                'approved' => true,
            ],
            [
                'product_id' => 18,
                'name' => 'Lê Minh Đức',
                'email' => 'duc.le@email.com',
                'rating' => 4,
                'comment' => 'Bộ đồ nội thất văn phòng xuất sắc với giải pháp lưu trữ tuyệt vời. Ghế ergonomic thoải mái cho các phiên làm việc dài.',
                'approved' => true,
            ],

            // Additional reviews for variety
            [
                'product_id' => 3,
                'name' => 'Dương Thị Mai',
                'email' => 'mai.duong@email.com',
                'rating' => 5,
                'comment' => 'Tủ đầu giường tối giản phù hợp hoàn hảo với thiết kế phòng ngủ hiện đại của chúng tôi. Sạch sẽ và chức năng.',
                'approved' => true,
            ],
            [
                'product_id' => 4,
                'name' => 'Bùi Văn Hải',
                'email' => 'hai.bui@email.com',
                'rating' => 4,
                'comment' => 'Bàn cà phê kính thêm sự thanh lịch cho phòng khách của chúng tôi. Dễ vệ sinh và bảo trì.',
                'approved' => true,
            ],
            [
                'product_id' => 2,
                'name' => 'Nguyễn Thị Hương',
                'email' => 'huong.nguyen@email.com',
                'rating' => 5,
                'comment' => 'Ghế ăn thoải mái trông đẹp và cung cấp hỗ trợ xuất sắc trong các bữa ăn dài.',
                'approved' => true,
            ],
            [
                'product_id' => 1,
                'name' => 'Phạm Minh Tuấn',
                'email' => 'tuan.pham@email.com',
                'rating' => 4,
                'comment' => 'Ghế văn phòng ergonomic đã cải thiện tư thế và độ thoải mái của tôi trong giờ làm việc.',
                'approved' => true,
            ],
            [
                'product_id' => 19,
                'name' => 'Trần Thị Lan Anh',
                'email' => 'lananh.tran@email.com',
                'rating' => 5,
                'comment' => 'Ghế vườn đẹp thêm sức hấp dẫn cho không gian ngoài trời của chúng tôi. Chống thời tiết và thoải mái.',
                'approved' => true,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
