<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Section;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AssignCategoriesToSections extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'sections:assign-categories {--mapping=} {--dry-run}';

    /**
     * The console command description.
     */
    protected $description = 'Assign categories to sections (parent-child), ensuring a logical grouping';

    public function handle(): int
    {
        $mappingOption = (string) $this->option('mapping');
        $dryRun = (bool) $this->option('dry-run');

        if ($mappingOption === '') {
            $this->error('Please provide --mapping as JSON: {"Section Name": ["Category A", "Category B"]}');
            return self::INVALID;
        }

        try {
            $mapping = json_decode($mappingOption, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable $e) {
            $this->error('Invalid JSON for --mapping: ' . $e->getMessage());
            return self::INVALID;
        }

        // Normalize keys/values to strings
        $normalized = [];
        foreach ($mapping as $sectionName => $categories) {
            $normalized[(string) $sectionName] = array_map('strval', (array) $categories);
        }

        $rows = [];
        foreach ($normalized as $sectionName => $categoryNames) {
            $section = Section::where('name', $sectionName)->first();
            if (!$section) {
                $rows[] = [$sectionName, '-', 'Section not found'];
                continue;
            }

            foreach ($categoryNames as $catName) {
                $category = Category::where('name', $catName)->first();
                if (!$category) {
                    $rows[] = [$sectionName, $catName, 'Category not found'];
                    continue;
                }

                $rows[] = [$sectionName, $catName, 'OK'];
            }
        }

        $this->table(['Section', 'Category', 'Status'], $rows);

        if ($dryRun) {
            $this->info('Dry run complete. No changes applied.');
            return self::SUCCESS;
        }

        DB::transaction(function () use ($normalized) {
            foreach ($normalized as $sectionName => $categoryNames) {
                $section = Section::where('name', $sectionName)->first();
                if (!$section) {
                    continue;
                }
                foreach ($categoryNames as $catName) {
                    $category = Category::where('name', $catName)->first();
                    if (!$category) {
                        continue;
                    }
                    $category->section_id = $section->id;
                    $category->save();
                }
            }
        });

        $this->info('Categories were assigned to sections successfully.');
        return self::SUCCESS;
    }
}


