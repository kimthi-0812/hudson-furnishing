<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeProductSection;
use App\Models\Product;

class HomeProductSectionSeeder extends Seeder
{
    public function run()
    {
        // Tạo Section "Sản phẩm nổi bật"
        $featured = HomeProductSection::create([
            'title' => 'Sản phẩm nổi bật',
            'type' => 'featured',
            'limit' => 4,
            'is_active' => true,
            'order' => 1,
        ]);

        // Tạo Section "Sản phẩm mới"
        $new = HomeProductSection::create([
            'title' => 'Sản phẩm mới',
            'type' => 'new',
            'limit' => 4,
            'is_active' => true,
            'order' => 2,
        ]);

        // Tạo Section "Sản phẩm đánh giá cao"
        $topRated = HomeProductSection::create([
            'title' => 'Sản phẩm đánh giá cao',
            'type' => 'top_rated',
            'limit' => 4,
            'is_active' => true,
            'order' => 3,
        ]);

        // Nếu muốn Section custom với sản phẩm chọn sẵn
        $customSection = HomeProductSection::create([
            'title' => 'Sản phẩm được chọn',
            'type' => 'custom',
            'limit' => 4,
            'is_active' => true,
            'order' => 4,
        ]);

        // Gán 4 sản phẩm đầu vào section custom
        $products = Product::where('status', 'active')->limit(4)->get();
        $customSection->products()->sync($products->pluck('id')->toArray());
    }
}
