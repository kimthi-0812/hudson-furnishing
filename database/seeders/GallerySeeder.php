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
                'title' => 'Phòng Họp Hiện Đại',
                'description' => 'Thiết kế phòng họp hiện đại với nội thất cao cấp',
                'image' => 'gallery/meeting-room-1.jpg',
                'is_primary' => true,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bộ Bàn Ghế Ăn Sang Trọng',
                'description' => 'Bộ bàn ghế ăn với thiết kế sang trọng và tiện nghi',
                'image' => 'gallery/dining-set-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Phòng Khách Ấm Cúng',
                'description' => 'Phòng khách với nội thất ấm cúng và hiện đại',
                'image' => 'gallery/living-room-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Văn Phòng Làm Việc Hiện Đại',
                'description' => 'Không gian văn phòng làm việc với thiết kế hiện đại và tiện nghi',
                'image' => 'gallery/office-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Phòng Ngủ Thoải Mái',
                'description' => 'Phòng ngủ với nội thất thoải mái và thiết kế tinh tế',
                'image' => 'gallery/bedroom-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Phòng Trẻ Em Vui Nhộn',
                'description' => 'Phòng trẻ em với thiết kế vui nhộn và an toàn',
                'image' => 'gallery/kids-room-1.jpg',
                'is_primary' => false,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]            
        ];

        DB::table('gallery')->insert($galleryItems);
    }
}
