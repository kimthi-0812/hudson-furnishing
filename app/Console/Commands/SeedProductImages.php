<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedProductImages extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'products:seed-images {--from=11} {--to=25} {--dry-run}';

    /**
     * The console command description.
     */
    protected $description = 'Tạo dữ liệu product_images cho sản phẩm trong khoảng ID chỉ định';

    public function handle(): int
    {
        $from = (int) $this->option('from');
        $to = (int) $this->option('to');
        $dryRun = (bool) $this->option('dry-run');

        if ($from < 1 || $to < $from) {
            $this->error('Khoảng ID không hợp lệ.');
            return self::INVALID;
        }

        $products = Product::whereBetween('id', [$from, $to])->get(['id', 'name']);
        if ($products->isEmpty()) {
            $this->warn('Không tìm thấy sản phẩm nào trong khoảng ID đã chọn.');
            return self::SUCCESS;
        }

        $rows = [];
        foreach ($products as $p) {
            $rows[] = [$p->id, $p->name];
        }
        $this->table(['Product ID', 'Name'], $rows);

        // Chuẩn bị dữ liệu ảnh
        $images = [];
        foreach ($products as $product) {
            $base = 'placeholder.jpg';
            $primaryUrl = $base;
            $images[] = [
                'product_id' => $product->id,
                'url' => $primaryUrl,
                'alt_text' => 'Ảnh chính - ' . $product->name,
                'is_primary' => true,
                'sort_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Thêm 1-2 ảnh phụ dùng cùng placeholder, khác sort_order
            $images[] = [
                'product_id' => $product->id,
                'url' => $base,
                'alt_text' => 'Ảnh phụ 1 - ' . $product->name,
                'is_primary' => false,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $images[] = [
                'product_id' => $product->id,
                'url' => $base,
                'alt_text' => 'Ảnh phụ 2 - ' . $product->name,
                'is_primary' => false,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if ($dryRun) {
            $this->info('Dry run: không chèn dữ liệu. Số bản ghi sẽ chèn: ' . count($images));
            return self::SUCCESS;
        }

        DB::transaction(function () use ($images) {
            ProductImage::insert($images);
        });

        $this->info('Đã tạo ảnh cho sản phẩm trong khoảng chỉ định.');
        return self::SUCCESS;
    }
}
