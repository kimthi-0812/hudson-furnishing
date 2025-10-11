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
                'name' => 'Hòa Phát',
                'slug' => 'hoa-phat',
                'logo' => 'brands/brand-1-logo-jpg',
            ],
            [
                'name' => 'Nhà Xinh',
                'slug' => 'nha-xinh',
                'logo' => 'brands/brand-2-logo-jpg',
            ],
            [
                'name' => 'Baya',
                'slug' => 'baya',
                'logo' => 'brands/brand-3-logo-jpg',
            ],
            [
                'name' => 'The One',
                'slug' => 'the-one',
                'logo' => 'brands/brand-4-logo-jpg',
            ],
            [
                'name' => '190 Furnishing',
                'slug' => '190-furnishing',
                'logo' => 'brands/brand-5-logo-jpg',
            ],            
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
