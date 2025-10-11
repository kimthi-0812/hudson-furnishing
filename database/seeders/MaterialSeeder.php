<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
                'name' => 'Gỗ Sồi',
                'image' => 'solid-oak.jpg',
                'description' => 'Gỗ sồi tự nhiên, bền đẹp, thích hợp cho nội thất cao cấp.',
            ],
            [
                'name' => 'Gỗ Tần Bì',
                'image' => 'ash-wood.jpg',
                'description' => 'Gỗ tần bì có vân đẹp, độ bền cao, thường dùng trong sản xuất đồ gỗ.',
            ],
            [
                'name' => 'Gỗ Thông',
                'image' => 'pine-wood.jpg',
                'description' => 'Gỗ thông nhẹ, dễ gia công, phù hợp cho các sản phẩm nội thất giá rẻ.',
            ],
            [
                'name' => 'Gỗ Hương',
                'image' => 'rosewood.jpg',
                'description' => 'Gỗ hương quý hiếm, có mùi thơm đặc trưng, thường dùng cho đồ nội thất cao cấp.',
            ],
            [
                'name' => 'Gỗ Căm Xe',
                'image' => 'cam-xe-wood.jpg',
                'description' => 'Gỗ căm xe cứng cáp, chịu lực tốt, thích hợp cho các sản phẩm nội thất ngoài trời.',
            ],
            [
                'name' => 'Kim Loại',
                'image' => 'metal.jpg',
                'description' => 'Kim loại bền bỉ, thường dùng trong khung ghế và các chi tiết trang trí.',
            ],
            [
                'name' => 'Nhựa',
                'image' => 'plastic.jpg',
                'description' => 'Nhựa đa dạng về màu sắc và kiểu dáng, thường dùng trong sản xuất ghế và bàn.',
            ],
            [
                'name' => 'Vải Bọc',
                'image' => 'fabric-upholstery.jpg',
                'description' => 'Vải bọc mềm mại, thoáng khí, thích hợp cho ghế sofa và ghế văn phòng.',
            ],
            [
                'name' => 'Da Thật',
                'image' => 'genuine-leather.jpg',
                'description' => 'Da thật cao cấp, bền đẹp theo thời gian, thường dùng cho ghế sofa và ghế xoay.',
            ],
            [
                'name' => 'Da Công Nghiệp',
                'image' => 'faux-leather.jpg',
                'description' => 'Da công nghiệp giá rẻ, dễ bảo quản, phù hợp cho các sản phẩm nội thất phổ thông.',
            ],
            
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
