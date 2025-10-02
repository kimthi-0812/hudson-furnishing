<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryItems = [
            [
                'title' => 'Modern Living Room',
                'description' => 'Contemporary living room design with premium furniture',
                'image' => 'gallery/living-room-1.jpg',
                'is_primary' => true,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Elegant Dining Set',
                'description' => 'Beautiful dining room with elegant furniture collection',
                'image' => 'gallery/dining-room-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cozy Bedroom',
                'description' => 'Comfortable bedroom design for ultimate relaxation',
                'image' => 'gallery/bedroom-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Office Space',
                'description' => 'Professional office furniture for productivity',
                'image' => 'gallery/office-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kitchen Design',
                'description' => 'Modern kitchen with functional furniture',
                'image' => 'gallery/kitchen-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Outdoor Furniture',
                'description' => 'Durable outdoor furniture for garden and patio',
                'image' => 'gallery/outdoor-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kids Room',
                'description' => 'Fun and safe furniture for children',
                'image' => 'gallery/kids-room-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Sofa Collection',
                'description' => 'Premium sofa collection for luxury living',
                'image' => 'gallery/sofa-collection-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Storage Solutions',
                'description' => 'Smart storage furniture for organized living',
                'image' => 'gallery/storage-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Decorative Accessories',
                'description' => 'Beautiful decorative items to complete your space',
                'image' => 'gallery/decorative-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('gallery')->insert($galleryItems);
    }
}
