<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Material;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\SiteSetting;
use App\Models\User;

class BackupDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Importing missing data from backup...');
        
        // Import missing sections
        $this->importMissingSections();
        
        // Import missing categories
        $this->importMissingCategories();
        
        // Import missing brands
        $this->importMissingBrands();
        
        // Import missing materials
        $this->importMissingMaterials();
        
        // Import missing products
        $this->importMissingProducts();
        
        // Import missing offers
        $this->importMissingOffers();
        
        // Import missing reviews
        $this->importMissingReviews();
        
        // Import missing contacts
        $this->importMissingContacts();
        
        // Import missing gallery
        $this->importMissingGallery();
        
        // Import missing site settings
        $this->importMissingSiteSettings();
        
        // Import missing user
        $this->importMissingUser();
        
        $this->command->info('Backup data import completed!');
    }

    private function importMissingSections()
    {
        $this->command->info('Importing missing sections...');
        
        $missingSections = [
            [
                'name' => 'Nhà bếp',
                'slug' => 'nha-bep',
                'description' => 'Nội thất nhà bếp bao gồm tủ bếp, đảo bếp, ghế bar và phụ kiện nhà bếp.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingSections as $section) {
            Section::firstOrCreate(
                ['slug' => $section['slug']],
                $section
            );
        }
    }

    private function importMissingCategories()
    {
        $this->command->info('Importing missing categories...');
        
        $missingCategories = [
            [
                'name' => 'Tủ bếp',
                'section_id' => 6, // Nhà bếp
                'slug' => 'tu-bep',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingCategories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }

    private function importMissingBrands()
    {
        $this->command->info('Importing missing brands...');
        
        $missingBrands = [
            [
                'name' => 'IKEA',
                'slug' => 'ikea',
                'logo' => 'brands/ikea-logo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingBrands as $brand) {
            Brand::firstOrCreate(
                ['slug' => $brand['slug']],
                $brand
            );
        }
    }

    private function importMissingMaterials()
    {
        $this->command->info('Importing missing materials...');
        
        $missingMaterials = [
            [
                'name' => 'Gỗ Teak',
                'image' => 'teak-wood.jpg',
                'description' => 'Gỗ teak cao cấp, chống nước và chống mối mọt tốt, thường dùng cho nội thất ngoài trời.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingMaterials as $material) {
            Material::firstOrCreate(
                ['name' => $material['name']],
                $material
            );
        }
    }

    private function importMissingProducts()
    {
        $this->command->info('Importing missing products...');
        
        $missingProducts = [
            [
                'name' => 'Tủ bếp hiện đại',
                'description' => 'Tủ bếp hiện đại với thiết kế tối giản, có nhiều ngăn kéo và tủ để cất đồ bếp.',
                'section_id' => 6,
                'category_id' => 26, // Tủ bếp
                'brand_id' => 6, // IKEA
                'material_id' => 11, // Gỗ Teak
                'price' => 25000000.00,
                'sale_price' => 22000000.00,
                'stock' => 8,
                'slug' => 'tu-bep-hien-dai',
                'featured' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Đảo bếp đa năng',
                'description' => 'Đảo bếp đa năng có thể làm bàn ăn sáng và khu vực chuẩn bị thức ăn.',
                'section_id' => 6,
                'category_id' => 26,
                'brand_id' => 1,
                'material_id' => 1,
                'price' => 15000000.00,
                'stock' => 12,
                'slug' => 'dao-bep-da-nang',
                'featured' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ghế bar cao cấp',
                'description' => 'Ghế bar cao cấp với thiết kế hiện đại, phù hợp cho đảo bếp và quầy bar.',
                'section_id' => 6,
                'category_id' => 26,
                'brand_id' => 2,
                'material_id' => 6,
                'price' => 3500000.00,
                'sale_price' => 3200000.00,
                'stock' => 20,
                'slug' => 'ghe-bar-cao-cap',
                'featured' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bộ nội thất phòng tắm',
                'description' => 'Bộ nội thất phòng tắm hoàn chỉnh bao gồm tủ lavabo, gương và tủ lưu trữ.',
                'section_id' => 7,
                'category_id' => 1,
                'brand_id' => 3,
                'material_id' => 7,
                'price' => 12000000.00,
                'stock' => 15,
                'slug' => 'bo-noi-that-phong-tam',
                'featured' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tủ lưu trữ đa năng',
                'description' => 'Tủ lưu trữ đa năng với nhiều ngăn kéo và kệ, phù hợp cho mọi không gian.',
                'section_id' => 8,
                'category_id' => 1,
                'brand_id' => 4,
                'material_id' => 2,
                'price' => 8500000.00,
                'stock' => 18,
                'slug' => 'tu-luu-tru-da-nang',
                'featured' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giường trẻ em an toàn',
                'description' => 'Giường trẻ em với thiết kế an toàn, có thành chắn và được làm từ vật liệu thân thiện.',
                'section_id' => 9,
                'category_id' => 1,
                'brand_id' => 5,
                'material_id' => 3,
                'price' => 6500000.00,
                'stock' => 25,
                'slug' => 'giuong-tre-em-an-toan',
                'featured' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bàn học trẻ em',
                'description' => 'Bàn học trẻ em có thể điều chỉnh độ cao, có ngăn kéo và kệ sách.',
                'section_id' => 9,
                'category_id' => 16,
                'brand_id' => 1,
                'material_id' => 1,
                'price' => 4500000.00,
                'sale_price' => 4200000.00,
                'stock' => 30,
                'slug' => 'ban-hoc-tre-em',
                'featured' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tủ đồ chơi',
                'description' => 'Tủ đồ chơi với nhiều ngăn và màu sắc vui nhộn, giúp trẻ em sắp xếp đồ chơi.',
                'section_id' => 9,
                'category_id' => 2,
                'brand_id' => 2,
                'material_id' => 7,
                'price' => 3200000.00,
                'stock' => 22,
                'slug' => 'tu-do-choi',
                'featured' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Đèn trang trí hiện đại',
                'description' => 'Đèn trang trí với thiết kế hiện đại, tạo ánh sáng ấm áp cho không gian.',
                'section_id' => 10,
                'category_id' => 1,
                'brand_id' => 3,
                'material_id' => 6,
                'price' => 1800000.00,
                'stock' => 35,
                'slug' => 'den-trang-tri-hien-dai',
                'featured' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thảm trang trí cao cấp',
                'description' => 'Thảm trang trí cao cấp với chất liệu mềm mại, tạo điểm nhấn cho phòng khách.',
                'section_id' => 10,
                'category_id' => 1,
                'brand_id' => 4,
                'material_id' => 8,
                'price' => 2800000.00,
                'sale_price' => 2500000.00,
                'stock' => 28,
                'slug' => 'tham-trang-tri-cao-cap',
                'featured' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kệ trang trí tường',
                'description' => 'Kệ trang trí tường với thiết kế độc đáo, phù hợp để trưng bày đồ trang trí.',
                'section_id' => 10,
                'category_id' => 8,
                'brand_id' => 5,
                'material_id' => 1,
                'price' => 1200000.00,
                'stock' => 40,
                'slug' => 'ke-trang-tri-tuong',
                'featured' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gương trang trí lớn',
                'description' => 'Gương trang trí lớn với khung gỗ đẹp, giúp mở rộng không gian phòng.',
                'section_id' => 10,
                'category_id' => 1,
                'brand_id' => 1,
                'material_id' => 1,
                'price' => 3500000.00,
                'stock' => 15,
                'slug' => 'guong-trang-tri-lon',
                'featured' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lọ hoa trang trí',
                'description' => 'Bộ lọ hoa trang trí với nhiều kích thước, tạo điểm nhấn cho bàn ăn và phòng khách.',
                'section_id' => 10,
                'category_id' => 1,
                'brand_id' => 2,
                'material_id' => 7,
                'price' => 850000.00,
                'sale_price' => 750000.00,
                'stock' => 50,
                'slug' => 'lo-hoa-trang-tri',
                'featured' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Đồng hồ treo tường',
                'description' => 'Đồng hồ treo tường với thiết kế hiện đại, vừa trang trí vừa tiện dụng.',
                'section_id' => 10,
                'category_id' => 1,
                'brand_id' => 3,
                'material_id' => 6,
                'price' => 650000.00,
                'stock' => 45,
                'slug' => 'dong-ho-treo-tuong',
                'featured' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tranh trang trí nghệ thuật',
                'description' => 'Bộ tranh trang trí nghệ thuật với màu sắc hài hòa, tạo không gian sống động.',
                'section_id' => 10,
                'category_id' => 1,
                'brand_id' => 4,
                'material_id' => 7,
                'price' => 2200000.00,
                'stock' => 20,
                'slug' => 'tranh-trang-tri-nghe-thuat',
                'featured' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingProducts as $product) {
            Product::firstOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }

    private function importMissingOffers()
    {
        $this->command->info('Importing missing offers...');
        
        $missingOffers = [
            [
                'title' => 'Khuyến Mãi Đặc Biệt - Giảm 30%',
                'description' => 'Cơ hội mua sắm với giá ưu đãi đặc biệt, giảm 30% cho tất cả sản phẩm.',
                'image' => 'offers/special-offer-30.jpg',
                'start_date' => '2025-10-16',
                'end_date' => '2025-10-25',
                'discount_type' => 'percentage',
                'discount_value' => 30.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bộ Phòng Bếp Hoàn Chỉnh',
                'description' => 'Bộ phòng bếp hoàn chỉnh bao gồm tủ bếp, đảo bếp và ghế bar với giá đặc biệt.',
                'image' => 'offers/kitchen-set-special.jpg',
                'start_date' => '2025-10-16',
                'end_date' => '2025-10-30',
                'discount_type' => 'fixed',
                'discount_value' => 5000000.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Nội Thất Trẻ Em An Toàn',
                'description' => 'Bộ sưu tập nội thất trẻ em với tiêu chuẩn an toàn cao và giá hấp dẫn.',
                'image' => 'offers/kids-furniture-safe.jpg',
                'start_date' => '2025-10-20',
                'end_date' => '2025-11-05',
                'discount_type' => 'percentage',
                'discount_value' => 25.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Phụ Kiện Trang Trí Đa Dạng',
                'description' => 'Khuyến mãi lớn cho các phụ kiện trang trí nhà, giảm giá lên đến 40%.',
                'image' => 'offers/decor-accessories.jpg',
                'start_date' => '2025-10-18',
                'end_date' => '2025-10-28',
                'discount_type' => 'percentage',
                'discount_value' => 40.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingOffers as $offer) {
            Offer::firstOrCreate(
                ['title' => $offer['title']],
                $offer
            );
        }
    }

    private function importMissingReviews()
    {
        $this->command->info('Importing missing reviews...');
        
        // Get the first product to create a review for
        $firstProduct = Product::first();
        if (!$firstProduct) {
            $this->command->warn('No products found, skipping reviews...');
            return;
        }
        
        $missingReviews = [
            [
                'product_id' => $firstProduct->id,
                'name' => 'Nguyễn Văn Minh',
                'email' => 'minh.nguyen@email.com',
                'rating' => 5,
                'comment' => 'Sản phẩm chất lượng tuyệt vời! Giao hàng nhanh và lắp ráp dễ dàng. Rất hài lòng với dịch vụ.',
                'approved' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingReviews as $review) {
            Review::firstOrCreate(
                ['email' => $review['email'], 'product_id' => $review['product_id']],
                $review
            );
        }
    }

    private function importMissingContacts()
    {
        $this->command->info('Importing missing contacts...');
        
        $missingContacts = [
            [
                'name' => 'Lê Thị Hoa',
                'email' => 'hoa.le@email.com',
                'phone' => '+84901234567',
                'message' => 'Tôi muốn tư vấn về thiết kế nội thất phòng bếp. Có thể liên hệ lại với tôi không?',
                'status' => 'new',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingContacts as $contact) {
            Contact::firstOrCreate(
                ['email' => $contact['email']],
                $contact
            );
        }
    }

    private function importMissingGallery()
    {
        $this->command->info('Importing missing gallery...');
        
        $missingGallery = [
            [
                'title' => 'Phòng Bếp Hiện Đại',
                'description' => 'Thiết kế phòng bếp hiện đại với tủ bếp và đảo bếp sang trọng',
                'image' => 'gallery/modern-kitchen-1.jpg',
                'is_primary' => 0,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingGallery as $gallery) {
            Gallery::firstOrCreate(
                ['title' => $gallery['title']],
                $gallery
            );
        }
    }

    private function importMissingSiteSettings()
    {
        $this->command->info('Importing missing site settings...');
        
        $missingSettings = [
            [
                'key' => 'backup_import_date',
                'value' => now()->format('Y-m-d H:i:s'),
                'description' => 'Ngày import dữ liệu từ backup',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($missingSettings as $setting) {
            SiteSetting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }

    private function importMissingUser()
    {
        $this->command->info('Importing missing user...');
        
        $missingUser = [
            'name' => 'Nguyễn Văn Admin',
            'email' => 'admin2@hudsonfurnishing.com',
            'password' => bcrypt('Admin123!'),
            'role_id' => 1, // admin
            'created_at' => now(),
            'updated_at' => now(),
        ];

        User::firstOrCreate(
            ['email' => $missingUser['email']],
            $missingUser
        );
    }
}
