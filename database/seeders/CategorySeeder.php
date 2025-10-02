<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Section;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Danh mục phòng ngủ
            [
                'name' => 'Giường ngủ',
                'section_id' => 1, // Phòng ngủ
                'slug' => 'giuong-ngu',
            ],
            [
                'name' => 'Tủ quần áo',
                'section_id' => 1, // Phòng ngủ
                'slug' => 'tu-quan-ao',
            ],
            [
                'name' => 'Bàn đầu giường',
                'section_id' => 1, // Phòng ngủ
                'slug' => 'ban-dau-giuong',
            ],
            [
                'name' => 'Tủ trang điểm',
                'section_id' => 1, // Phòng ngủ
                'slug' => 'tu-trang-diem',
            ],
            [
                'name' => 'Bộ phòng ngủ',
                'section_id' => 1, // Phòng ngủ
                'slug' => 'bo-phong-ngu',
            ],

            // Danh mục phòng khách
            [
                'name' => 'Sofa',
                'section_id' => 2, // Phòng khách
                'slug' => 'sofa',
            ],
            [
                'name' => 'Bàn cà phê',
                'section_id' => 2, // Phòng khách
                'slug' => 'ban-ca-phe',
            ],
            [
                'name' => 'Kệ tivi',
                'section_id' => 2, // Phòng khách
                'slug' => 'ke-tivi',
            ],
            [
                'name' => 'Kệ sách',
                'section_id' => 2, // Phòng khách
                'slug' => 'ke-sach',
            ],
            [
                'name' => 'Bộ phòng khách',
                'section_id' => 2, // Phòng khách
                'slug' => 'bo-phong-khach',
            ],

            // Danh mục phòng ăn
            [
                'name' => 'Bàn ăn',
                'section_id' => 3, // Phòng ăn
                'slug' => 'ban-an',
            ],
            [
                'name' => 'Ghế ăn',
                'section_id' => 3, // Phòng ăn
                'slug' => 'ghe-an',
            ],
            [
                'name' => 'Tủ ly',
                'section_id' => 3, // Phòng ăn
                'slug' => 'tu-ly',
            ],
            [
                'name' => 'Bộ phòng ăn',
                'section_id' => 3, // Phòng ăn
                'slug' => 'bo-phong-an',
            ],
            [
                'name' => 'Ghế bar',
                'section_id' => 3, // Phòng ăn
                'slug' => 'ghe-bar',
            ],

            // Danh mục văn phòng
            [
                'name' => 'Bàn làm việc',
                'section_id' => 4, // Văn phòng
                'slug' => 'ban-lam-viec',
            ],
            [
                'name' => 'Ghế văn phòng',
                'section_id' => 4, // Văn phòng
                'slug' => 'ghe-van-phong',
            ],
            [
                'name' => 'Tủ hồ sơ',
                'section_id' => 4, // Văn phòng
                'slug' => 'tu-ho-so',
            ],
            [
                'name' => 'Tủ lưu trữ',
                'section_id' => 4, // Văn phòng
                'slug' => 'tu-luu-tru',
            ],
            [
                'name' => 'Bộ văn phòng',
                'section_id' => 4, // Văn phòng
                'slug' => 'bo-van-phong',
            ],

            // Danh mục ngoài trời
            [
                'name' => 'Bộ sân vườn',
                'section_id' => 5, // Ngoài trời
                'slug' => 'bo-san-vuon',
            ],
            [
                'name' => 'Nội thất sân vườn',
                'section_id' => 5, // Ngoài trời
                'slug' => 'noi-that-san-vuon',
            ],
            [
                'name' => 'Bàn ngoài trời',
                'section_id' => 5, // Ngoài trời
                'slug' => 'ban-ngoai-troi',
            ],
            [
                'name' => 'Ghế ngoài trời',
                'section_id' => 5, // Ngoài trời
                'slug' => 'ghe-ngoai-troi',
            ],
            [
                'name' => 'Tủ ngoài trời',
                'section_id' => 5, // Ngoài trời
                'slug' => 'tu-ngoai-troi',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
