<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeedVietnameseProducts extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'products:seed-vi {--target=25} {--dry-run}';

    /**
     * The console command description.
     */
    protected $description = 'Bổ sung sản phẩm tiếng Việt cho đủ số lượng, đảm bảo ID nằm trong 1..target';

    public function handle(): int
    {
        $target = (int) $this->option('target');
        $dryRun = (bool) $this->option('dry-run');

        if ($target < 1) {
            $this->error('Target phải >= 1');
            return self::INVALID;
        }

        $existingCount = Product::count();
        $need = max(0, $target - $existingCount);

        $this->info("Sản phẩm hiện có: {$existingCount}. Cần thêm: {$need} để đạt {$target}.");

        // Chuẩn bị FK tối thiểu
        $sectionId = Section::value('id');
        $categoryId = Category::value('id');
        $brandId = Brand::value('id');
        $materialId = Material::value('id');

        if (!$sectionId || !$categoryId || !$brandId || !$materialId) {
            $this->error('Thiếu dữ liệu tham chiếu: cần có ít nhất 1 Section, 1 Category, 1 Brand, 1 Material.');
            return self::INVALID;
        }

        // Danh sách tên/miêu tả tiếng Việt
        $names = [
            'Sofa vải cao cấp','Bàn trà kính tròn','Kệ tivi gỗ sồi','Tủ quần áo 4 cánh','Giường ngủ bọc nệm',
            'Bàn ăn 6 ghế','Ghế thư giãn bọc da','Đèn đứng phòng khách','Kệ sách nhiều tầng','Tủ giày thông minh',
            'Bàn làm việc gỗ óc chó','Ghế công thái học','Gương treo tường lớn','Tủ đầu giường đôi','Chăn ga gối cotton',
            'Thảm trải sàn lông ngắn','Bàn console hành lang','Kệ treo tường tối giản','Tủ trang trí kính','Ghế đôn đa năng',
            'Bàn đảo bếp nhỏ','Tủ bếp treo tường','Kệ gia vị inox','Bình hoa trang trí','Rèm cửa hai lớp',
        ];

        $descriptions = [
            'Thiết kế hiện đại, phù hợp không gian Việt.',
            'Chất liệu bền bỉ, an toàn sức khỏe.',
            'Hoàn thiện tỉ mỉ, dễ vệ sinh.',
        ];

        $newRows = [];
        for ($i = 0; $i < $need; $i++) {
            $name = $names[$i % count($names)];
            $desc = $descriptions[$i % count($descriptions)];
            $price = 1000000 + ($i * 125000);
            $sale = $i % 3 === 0 ? $price * 0.9 : null;
            $newRows[] = [
                'name' => $name,
                'description' => $desc,
                'section_id' => $sectionId,
                'category_id' => $categoryId,
                'brand_id' => $brandId,
                'material_id' => $materialId,
                'price' => $price,
                'sale_price' => $sale,
                'stock' => 10,
                'slug' => Str::slug($name . '-' . ($existingCount + $i + 1)),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if ($dryRun) {
            $preview = array_map(function ($r) {
                return [$r['name'], number_format((float) $r['price'], 0, ',', '.'), $r['sku']];
            }, array_slice($newRows, 0, 10));
            $this->table(['Tên', 'Giá', 'SKU'], $preview);
            $this->info('Dry run: không ghi dữ liệu.');
            return self::SUCCESS;
        }

        DB::transaction(function () use ($newRows) {
            if (!empty($newRows)) {
                Product::insert($newRows);
            }
        });

        // Sắp lại ID sản phẩm về 1..N (N <= target)
        $this->call('db:resequence-ids', []);

        $countAfter = Product::count();
        if ($countAfter > $target) {
            $this->warn('Tổng sản phẩm vượt mục tiêu, nhưng ID đã được sắp lại liên tục.');
        } else {
            $this->info('Đã bổ sung sản phẩm và sắp lại ID trong khoảng yêu cầu.');
        }

        return self::SUCCESS;
    }
}


