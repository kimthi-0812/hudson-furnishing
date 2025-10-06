<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Hudson Furnishing',
                'slug' => 'hudson-furnishing',
                'logo' => 'brands/brand-1-logo-jpg',
            ],
            [
                'name' => 'Nội Thất Hoàng Gia',
                'slug' => 'noi-that-hoang-gia',
                'logo' => 'brands/hoang-gia-logo.png',
            ],
            [
                'name' => 'Gỗ Việt',
                'slug' => 'go-viet',
                'logo' => 'brands/go-viet-logo.png',
            ],
            [
                'name' => 'Thiết Kế Đông Dương',
                'slug' => 'thiet-ke-dong-duong',
                'logo' => 'brands/dong-duong-logo.png',
            ],
            [
                'name' => 'Nội Thất Cao Cấp',
                'slug' => 'noi-that-cao-cap',
                'logo' => 'brands/cao-cap-logo.png',
            ],
            [
                'name' => 'Gỗ Tự Nhiên',
                'slug' => 'go-tu-nhien',
                'logo' => 'brands/tu-nhien-logo.png',
            ],
            [
                'name' => 'Thiết Kế Hiện Đại',
                'slug' => 'thiet-ke-hien-dai',
                'logo' => 'brands/hien-dai-logo.png',
            ],
            [
                'name' => 'Nội Thất Gia Đình',
                'slug' => 'noi-that-gia-dinh',
                'logo' => 'brands/gia-dinh-logo.png',
            ],
            [
                'name' => 'Gỗ Công Nghiệp',
                'slug' => 'go-cong-nghiep',
                'logo' => 'brands/cong-nghiep-logo.png',
            ],
            [
                'name' => 'Thiết Kế Tối Giản',
                'slug' => 'thiet-ke-toi-gian',
                'logo' => 'brands/toi-gian-logo.png',
            ],
            [
                'name' => 'Nội Thất Văn Phòng',
                'slug' => 'noi-that-van-phong',
                'logo' => 'brands/van-phong-logo.png',
            ],
            [
                'name' => 'Gỗ Sồi',
                'slug' => 'go-soi',
                'logo' => 'brands/go-soi-logo.png',
            ],
            [
                'name' => 'Thiết Kế Cổ Điển',
                'slug' => 'thiet-ke-co-dien',
                'logo' => 'brands/co-dien-logo.png',
            ],
            [
                'name' => 'Nội Thất Trẻ Em',
                'slug' => 'noi-that-tre-em',
                'logo' => 'brands/tre-em-logo.png',
            ],
            [
                'name' => 'Gỗ Óc Chó',
                'slug' => 'go-oc-cho',
                'logo' => 'brands/oc-cho-logo.png',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
