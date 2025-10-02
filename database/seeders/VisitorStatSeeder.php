<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorStat;

class VisitorStatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate visitor stats for the last 30 days
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            
            // Generate realistic visitor numbers (higher on weekends)
            $baseVisits = $date->isWeekend() ? rand(150, 300) : rand(80, 200);
            $uniqueVisits = rand(60, 120);
            
            VisitorStat::create([
                'date' => $date->format('Y-m-d'),
                'total_visits' => $baseVisits,
                'unique_visits' => $uniqueVisits,
            ]);
        }

        // Add some historical data for the past 3 months
        for ($i = 90; $i >= 30; $i--) {
            $date = now()->subDays($i);
            
            $baseVisits = $date->isWeekend() ? rand(100, 250) : rand(50, 150);
            $uniqueVisits = rand(40, 100);
            
            VisitorStat::create([
                'date' => $date->format('Y-m-d'),
                'total_visits' => $baseVisits,
                'unique_visits' => $uniqueVisits,
            ]);
        }
    }
}
