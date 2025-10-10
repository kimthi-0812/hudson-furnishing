<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VisitorStat;

class UpdateUniqueVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitor:update-unique-visits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update unique_visits data to make charts more dynamic';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating unique_visits data...');
        
        $stats = VisitorStat::all();
        $updated = 0;
        
        foreach($stats as $stat) {
            // Unique visits thường chiếm 60-80% của total visits
            $ratio = rand(60, 80) / 100;
            $unique_visits = max(1, round($stat->total_visits * $ratio));
            
            $stat->unique_visits = $unique_visits;
            $stat->save();
            $updated++;
        }
        
        $this->info("Updated {$updated} records with unique_visits data");
        $this->info('Charts will now be more dynamic!');
        
        return 0;
    }
}
