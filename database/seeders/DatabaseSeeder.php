<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SectionSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            MaterialSeeder::class,
            ProductSeeder::class,
            OfferSeeder::class,
            ReviewSeeder::class,
            ContactSeeder::class,
            SiteSettingSeeder::class,
            VisitorStatSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
