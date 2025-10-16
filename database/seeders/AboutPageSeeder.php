<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutPage;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutPage::create([
            // Hero Section
            'hero_title' => 'Về Hudson Furnishing',
            'hero_subtitle' => 'Khám phá câu chuyện đằng sau thương hiệu nội thất hàng đầu Việt Nam',
            
            // Company Story
            'story_title' => 'Câu Chuyện Của Chúng Tôi',
            'story_content_1' => 'Hudson Furnishing được thành lập vào năm 2015 với tầm nhìn mang đến những sản phẩm nội thất cao cấp, kết hợp giữa truyền thống thủ công và thiết kế hiện đại.',
            'story_content_2' => 'Từ một xưởng sản xuất nhỏ tại TP.HCM, chúng tôi đã phát triển thành một trong những thương hiệu nội thất được tin tưởng nhất tại Việt Nam, phục vụ hàng nghìn khách hàng trên toàn quốc.',
            'story_content_3' => 'Chúng tôi tin rằng mỗi không gian sống đều có thể trở thành một tác phẩm nghệ thuật, nơi gia đình tạo nên những kỷ niệm đẹp và thể hiện cá tính riêng của mình.',
            
            // Mission, Vision, Values
            'mission_title' => 'Sứ Mệnh',
            'mission_content' => 'Mang đến những sản phẩm nội thất chất lượng cao, kết hợp giữa nghệ thuật thủ công truyền thống và thiết kế hiện đại, tạo nên không gian sống hoàn hảo cho mọi gia đình Việt Nam.',
            'mission_icon' => 'fas fa-bullseye',
            'vision_title' => 'Tầm Nhìn',
            'vision_content' => 'Trở thành thương hiệu nội thất hàng đầu Việt Nam, được công nhận về chất lượng sản phẩm, dịch vụ khách hàng và đóng góp tích cực cho cộng đồng.',
            'vision_icon' => 'fas fa-eye',
            'values_title' => 'Giá Trị Cốt Lõi',
            'values_content' => 'Chất lượng, Sáng tạo, Chân thành và Bền vững. Chúng tôi cam kết mang đến những sản phẩm tốt nhất với giá trị lâu dài cho khách hàng.',
            'values_icon' => 'fas fa-heart',
            
            // Our Values Section
            'our_values_title' => 'Giá Trị Của Chúng Tôi',
            'our_values_subtitle' => 'Những nguyên tắc định hướng mọi hoạt động của Hudson Furnishing',
            
            // Value Items
            'value_1_title' => 'Chất Lượng Cao Cấp',
            'value_1_content' => 'Mỗi sản phẩm đều được chế tác từ những nguyên liệu tốt nhất, đảm bảo độ bền và vẻ đẹp theo thời gian.',
            'value_2_title' => 'Thiết Kế Sáng Tạo',
            'value_2_content' => 'Đội ngũ thiết kế giàu kinh nghiệm luôn tạo ra những sản phẩm độc đáo, phù hợp với xu hướng hiện đại.',
            'value_3_title' => 'Dịch Vụ Tận Tâm',
            'value_3_content' => 'Từ tư vấn thiết kế đến lắp đặt và bảo hành, chúng tôi luôn đồng hành cùng khách hàng.',
            'value_4_title' => 'Bền Vững Môi Trường',
            'value_4_content' => 'Sử dụng nguyên liệu thân thiện với môi trường và quy trình sản xuất bền vững.',
            
            // Our Team Section
            'team_title' => 'Đội Ngũ Của Chúng Tôi',
            'team_subtitle' => 'Những con người tài năng đằng sau thành công của Hudson Furnishing',
            
            // Team Members
            'member_1_name' => 'Lê Tấn Bửu',
            'member_1_position' => 'Giám Đốc Điều Hành',
            'member_1_description' => 'Với hơn 15 năm kinh nghiệm trong ngành nội thất, anh Bửu đã dẫn dắt công ty từ những ngày đầu thành lập.',
            
            'member_2_name' => 'Audrey Nguyễn',
            'member_2_position' => 'Giám Đốc Thiết Kế',
            'member_2_description' => 'Chị Audrey là người tạo ra những thiết kế độc đáo, kết hợp hài hòa giữa truyền thống và hiện đại.',
            
            'member_3_name' => 'Nguyễn Phúc Duy Anh',
            'member_3_position' => 'Trưởng Phòng Sản Xuất',
            'member_3_description' => 'Anh Duy Anh đảm bảo mỗi sản phẩm đều đạt tiêu chuẩn chất lượng cao nhất trước khi đến tay khách hàng.',
            
            // Statistics Section
            'stats_title' => 'Thành Tựu Của Chúng Tôi',
            'stats_subtitle' => 'Những con số ấn tượng phản ánh sự tin tưởng của khách hàng',
            
            'stat_1_number' => '100+',
            'stat_1_label' => 'Dự Án Hoàn Thành',
            'stat_1_icon' => 'fas fa-home',
            'stat_2_number' => '99+',
            'stat_2_label' => 'Khách Hàng Hài Lòng',
            'stat_2_icon' => 'fas fa-users',
            'stat_3_number' => '5+',
            'stat_3_label' => 'Giải Thưởng',
            'stat_3_icon' => 'fas fa-award',
            'stat_4_number' => '8',
            'stat_4_label' => 'Năm Kinh Nghiệm',
            'stat_4_icon' => 'fas fa-calendar',
            
            // CTA Section
            'cta_title' => 'Sẵn Sàng Tạo Nên Không Gian Mơ Ước?',
            'cta_subtitle' => 'Hãy để chúng tôi giúp bạn biến ý tưởng thành hiện thực',
        ]);
    }
}