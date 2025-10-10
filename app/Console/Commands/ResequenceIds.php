<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResequenceIds extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'db:resequence-ids {--dry-run : Show actions without applying changes} {--only= : Resequence only this parent table}';

    /**
     * The console command description.
     */
    protected $description = 'Resequence primary keys to be continuous starting from 1 and update foreign keys accordingly';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $driver = DB::getDriverName();
        $this->info('Database driver: ' . $driver);

        $plan = $this->buildPlan();

        $only = (string) ($this->option('only') ?? '');
        if ($only !== '') {
            if (!array_key_exists($only, $plan)) {
                $this->error('Unknown table for --only: ' . $only);
                return self::INVALID;
            }
            $plan = [$only => $plan[$only]];
        }

        if ($dryRun) {
            $this->table(['Parent', 'Children (table.column)'], collect($plan)->map(function ($children, $parent) {
                return [
                    $parent,
                    implode(', ', array_map(function ($c) { return $c['table'] . '.' . $c['column']; }, $children)),
                ];
            }));
            $this->info('Dry run complete. No changes applied.');
            return self::SUCCESS;
        }

        $this->disableForeignKeys($driver);

        try {
            // Thực hiện không dùng transaction để tránh lỗi commit khi MySQL implicit commit với DDL
            foreach ($plan as $parentTable => $children) {
                $this->resequenceTableWithChildren($parentTable, $children);
                $this->resetAutoIncrement($driver, $parentTable);
            }
        } catch (\Throwable $e) {
            $this->enableForeignKeys($driver);
            $this->error('Error: ' . $e->getMessage());
            throw $e;
        }

        $this->enableForeignKeys($driver);
        $this->info('Done resequencing all configured tables.');
        return self::SUCCESS;
    }

    /**
     * Define parent tables and their FK dependents.
     * Only include relationships present in migrations.
     */
    private function buildPlan(): array
    {
        return [
            // Order matters: parents before their dependents are updated here only as mapping targets
            'sections' => [
                ['table' => 'categories', 'column' => 'section_id'],
                ['table' => 'products', 'column' => 'section_id'],
            ],
            'categories' => [
                ['table' => 'products', 'column' => 'category_id'],
            ],
            'brands' => [
                ['table' => 'products', 'column' => 'brand_id'],
            ],
            'materials' => [
                ['table' => 'products', 'column' => 'material_id'],
            ],
            'products' => [
                ['table' => 'product_images', 'column' => 'product_id'],
                ['table' => 'reviews', 'column' => 'product_id'],
                ['table' => 'offer_products', 'column' => 'product_id'],
            ],
            'offers' => [
                ['table' => 'offer_products', 'column' => 'offer_id'],
            ],
            // Standalone tables can be resequenced without children
            'gallery' => [],
            'contacts' => [],
            'site_settings' => [],
            'visitor_stats' => [],
            // Users may be referenced polymorphically by personal_access_tokens.tokenable_id
            // We will update those where tokenable_type ends with \\User
            'users' => [
                ['table' => 'personal_access_tokens', 'column' => 'tokenable_id', 'where' => ['tokenable_type', 'LIKE', '%\\\\User']],
            ],
        ];
    }

    private function resequenceTableWithChildren(string $parentTable, array $children): void
    {
        $this->line("Resequencing {$parentTable} ...");

        $rows = DB::table($parentTable)->select('id')->orderBy('id')->get()->pluck('id')->all();
        if (empty($rows)) {
            $this->line("- {$parentTable} is empty, skipping");
            return;
        }

        $maxId = (int) DB::table($parentTable)->max('id');
        $offset = $maxId + 1000000; // large offset to avoid collisions

        // Step 1: push parent and its children IDs by offset to avoid PK collisions during remap
        DB::table($parentTable)->update(['id' => DB::raw('id + ' . $offset)]);
        foreach ($children as $child) {
            $query = DB::table($child['table']);
            if (isset($child['where'])) {
                [$col, $op, $val] = $child['where'];
                $query->where($col, $op, $val);
            }
            $query->update([$child['column'] => DB::raw($child['column'] . ' + ' . $offset)]);
        }

        // Step 2: build mapping from temp id (old+offset) => new sequential id starting at 1 by original order
        $tempIds = DB::table($parentTable)->select('id')->orderBy('id')->get()->pluck('id')->all();
        // tempIds are offset-sorted; mapping must respect original order by (id - offset)
        $originalSorted = array_map(fn($tid) => $tid - $offset, $tempIds);
        array_multisort($originalSorted, SORT_ASC, $tempIds);

        $mapping = [];
        $newId = 1;
        foreach ($tempIds as $tid) {
            $mapping[$tid] = $newId++;
        }

        // Step 3: apply mapping in chunks using CASE updates for efficiency
        $this->bulkRemapIds($parentTable, 'id', $mapping);
        foreach ($children as $child) {
            $this->bulkRemapIds($child['table'], $child['column'], $mapping, $child['where'] ?? null);
        }
    }

    /**
     * Bulk remap a column based on a mapping [oldValue => newValue]. Optionally scoped by a where clause.
     */
    private function bulkRemapIds(string $table, string $column, array $mapping, ?array $where = null): void
    {
        if (empty($mapping)) {
            return;
        }

        // Với một số hệ CSDL và cột PK, cập nhật CASE hàng loạt có thể không áp dụng như mong muốn.
        // Để an toàn tuyệt đối, cập nhật tuần tự từng giá trị.
        foreach ($mapping as $old => $new) {
            $query = DB::table($table)->where($column, $old);
            if ($where) {
                [$wcol, $wop, $wval] = $where;
                $query->where($wcol, $wop, $wval);
            }
            $query->update([$column => $new]);
        }
    }

    private function buildCaseSql(string $column, array $map): string
    {
        $cases = [];
        foreach ($map as $old => $new) {
            $cases[] = "WHEN {$column} = {$old} THEN {$new}";
        }
        return 'CASE ' . $column . ' ' . implode(' ', $cases) . ' ELSE ' . $column . ' END';
    }

    private function disableForeignKeys(string $driver): void
    {
        if ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF');
        }
    }

    private function enableForeignKeys(string $driver): void
    {
        if ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON');
        }
    }

    private function resetAutoIncrement(string $driver, string $table): void
    {
        $maxId = (int) DB::table($table)->max('id');

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `' . $table . '` AUTO_INCREMENT = ' . ($maxId + 1));
            return;
        }

        if ($driver === 'sqlite') {
            // sqlite_sequence holds autoincrement counters for tables that used AUTOINCREMENT
            // If missing, ignore.
            try {
                $exists = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name='sqlite_sequence'");
                if (!empty($exists)) {
                    $row = DB::selectOne('SELECT seq FROM sqlite_sequence WHERE name = ?', [$table]);
                    if ($row) {
                        DB::update('UPDATE sqlite_sequence SET seq = ? WHERE name = ?', [$maxId, $table]);
                    } else {
                        DB::insert('INSERT INTO sqlite_sequence(name, seq) VALUES(?, ?)', [$table, $maxId]);
                    }
                }
            } catch (\Throwable $e) {
                // Best-effort; ignore if not applicable
            }
        }
    }
}


