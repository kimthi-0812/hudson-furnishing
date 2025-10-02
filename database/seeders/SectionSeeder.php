<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name' => 'Phòng ngủ',
                'slug' => 'phong-ngu',
                'description' => 'Bộ nội thất phòng ngủ hoàn chỉnh bao gồm giường, tủ quần áo, bàn đầu giường và tủ trang điểm.',
            ],
            [
                'name' => 'Phòng khách',
                'slug' => 'phong-khach',
                'description' => 'Nội thất phòng khách bao gồm sofa, bàn cà phê, kệ tivi và trung tâm giải trí.',
            ],
            [
                'name' => 'Phòng ăn',
                'slug' => 'phong-an',
                'description' => 'Bộ phòng ăn bao gồm bàn ăn, ghế ăn, tủ ly và phụ kiện phòng ăn.',
            ],
            [
                'name' => 'Văn phòng',
                'slug' => 'van-phong',
                'description' => 'Nội thất văn phòng bao gồm bàn làm việc, ghế văn phòng, kệ sách và giải pháp lưu trữ.',
            ],
            [
                'name' => 'Ngoài trời',
                'slug' => 'ngoai-troi',
                'description' => 'Nội thất ngoài trời bao gồm bộ sân vườn, nội thất sân vườn và phụ kiện ngoài trời.',
            ],
            [
                'name' => 'Nhà bếp',
                'slug' => 'nha-bep',
                'description' => 'Nội thất nhà bếp bao gồm tủ bếp, đảo bếp, ghế bar và phụ kiện nhà bếp.',
            ],
            [
                'name' => 'Phòng tắm',
                'slug' => 'phong-tam',
                'description' => 'Nội thất phòng tắm bao gồm tủ lavabo, gương, tủ lưu trữ và phụ kiện.',
            ],
            [
                'name' => 'Lưu trữ',
                'slug' => 'luu-tru',
                'description' => 'Giải pháp lưu trữ bao gồm tủ quần áo, tủ, kệ và nội thất tổ chức.',
            ],
            [
                'name' => 'Phòng trẻ em',
                'slug' => 'phong-tre-em',
                'description' => 'Nội thất trẻ em bao gồm giường, bàn học, tủ đồ chơi và nội thất thân thiện với trẻ em.',
            ],
            [
                'name' => 'Phụ kiện',
                'slug' => 'phu-kien',
                'description' => 'Phụ kiện trang trí nhà bao gồm đèn, thảm, đồ trang trí và nội thất trang trí.',
            ],
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
