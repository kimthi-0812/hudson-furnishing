<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ExportDatabaseSeeder extends Seeder
{
    /**
     * Export database to SQL file
     */
    public function run(): void
    {
        $this->command->info('Exporting database to SQL file...');
        
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');
        
        $filename = 'hudson_furnishing_db.sql';
        $filepath = storage_path('app/' . $filename);
        
        // Create the mysqldump command
        $command = sprintf(
            'mysqldump --host=%s --port=%s --user=%s --password=%s --single-transaction --routines --triggers %s > %s',
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($filepath)
        );
        
        // Execute the command
        exec($command, $output, $returnCode);
        
        if ($returnCode === 0) {
            $this->command->info("Database exported successfully to: {$filepath}");
            
            // Copy to project root
            $rootPath = base_path($filename);
            File::copy($filepath, $rootPath);
            $this->command->info("Database also copied to: {$rootPath}");
            
            // Show file size
            $fileSize = File::size($rootPath);
            $this->command->info("File size: " . $this->formatBytes($fileSize));
            
        } else {
            $this->command->error('Failed to export database');
            $this->command->error('Output: ' . implode("\n", $output));
        }
    }
    
    private function formatBytes($size, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, $precision) . ' ' . $units[$i];
    }
}
