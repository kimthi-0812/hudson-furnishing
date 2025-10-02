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
                'name' => 'Solid Oak',
                'description' => 'Premium solid oak wood known for its durability and beautiful grain patterns.',
            ],
            [
                'name' => 'Mahogany',
                'description' => 'Rich, dark mahogany wood with excellent durability and elegant appearance.',
            ],
            [
                'name' => 'Walnut',
                'description' => 'Dark walnut wood with distinctive grain patterns and natural beauty.',
            ],
            [
                'name' => 'Cherry Wood',
                'description' => 'Cherry wood with warm reddish-brown color that darkens over time.',
            ],
            [
                'name' => 'Maple',
                'description' => 'Light-colored maple wood known for its strength and smooth finish.',
            ],
            [
                'name' => 'Pine',
                'description' => 'Affordable pine wood with natural knots and rustic appearance.',
            ],
            [
                'name' => 'Leather',
                'description' => 'Premium genuine leather upholstery for luxury furniture pieces.',
            ],
            [
                'name' => 'Fabric',
                'description' => 'High-quality fabric upholstery in various colors and textures.',
            ],
            [
                'name' => 'Metal',
                'description' => 'Sturdy metal construction including steel, aluminum, and iron.',
            ],
            [
                'name' => 'Glass',
                'description' => 'Tempered glass components for modern and contemporary designs.',
            ],
            [
                'name' => 'Marble',
                'description' => 'Natural marble surfaces for elegant and sophisticated furniture.',
            ],
            [
                'name' => 'Granite',
                'description' => 'Durable granite surfaces perfect for high-traffic areas.',
            ],
            [
                'name' => 'Bamboo',
                'description' => 'Sustainable bamboo material for eco-friendly furniture options.',
            ],
            [
                'name' => 'Rattan',
                'description' => 'Natural rattan weaving for outdoor and casual furniture.',
            ],
            [
                'name' => 'MDF',
                'description' => 'Medium-density fiberboard for affordable and versatile furniture construction.',
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
