<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SoftDeleteService
{
    /**
     * Get all models with soft delete functionality
     */
    public static function getSoftDeleteModels(): array
    {
        return [
            'products' => \App\Models\Product::class,
            'categories' => \App\Models\Category::class,
            'brands' => \App\Models\Brand::class,
            'materials' => \App\Models\Material::class,
            'offers' => \App\Models\Offer::class,
            'sections' => \App\Models\Section::class,
            'reviews' => \App\Models\Review::class,
            'contacts' => \App\Models\Contact::class,
        ];
    }

    /**
     * Get trashed items for a specific model
     */
    public static function getTrashedItems(string $modelClass): Collection
    {
        return $modelClass::onlyTrashed()->get();
    }

    /**
     * Get all trashed items across all models
     */
    public static function getAllTrashedItems(): array
    {
        $trashedItems = [];
        
        foreach (self::getSoftDeleteModels() as $name => $modelClass) {
            $items = self::getTrashedItems($modelClass);
            if ($items->count() > 0) {
                $trashedItems[$name] = [
                    'model' => $modelClass,
                    'items' => $items,
                    'count' => $items->count()
                ];
            }
        }
        
        return $trashedItems;
    }

    /**
     * Restore a specific item
     */
    public static function restoreItem(string $modelClass, int $id): bool
    {
        $item = $modelClass::withTrashed()->find($id);
        
        if ($item && $item->trashed()) {
            return $item->restore();
        }
        
        return false;
    }

    /**
     * Permanently delete an item
     */
    public static function forceDeleteItem(string $modelClass, int $id): bool
    {
        $item = $modelClass::withTrashed()->find($id);
        
        if ($item) {
            return $item->forceDelete();
        }
        
        return false;
    }

    /**
     * Get statistics for soft deleted items
     */
    public static function getTrashStatistics(): array
    {
        $stats = [];
        
        foreach (self::getSoftDeleteModels() as $name => $modelClass) {
            $stats[$name] = [
                'total' => $modelClass::count(),
                'trashed' => $modelClass::onlyTrashed()->count(),
                'active' => $modelClass::count() - $modelClass::onlyTrashed()->count()
            ];
        }
        
        return $stats;
    }

    /**
     * Bulk restore items
     */
    public static function bulkRestore(string $modelClass, array $ids): int
    {
        $count = 0;
        
        foreach ($ids as $id) {
            if (self::restoreItem($modelClass, $id)) {
                $count++;
            }
        }
        
        return $count;
    }

    /**
     * Bulk force delete items
     */
    public static function bulkForceDelete(string $modelClass, array $ids): int
    {
        $count = 0;
        
        foreach ($ids as $id) {
            if (self::forceDeleteItem($modelClass, $id)) {
                $count++;
            }
        }
        
        return $count;
    }

    /**
     * Clean up old trashed items (older than specified days)
     */
    public static function cleanupOldTrash(int $days = 30): array
    {
        $results = [];
        $cutoffDate = now()->subDays($days);
        
        foreach (self::getSoftDeleteModels() as $name => $modelClass) {
            $oldTrashed = $modelClass::onlyTrashed()
                ->where('deleted_at', '<', $cutoffDate)
                ->get();
            
            $count = 0;
            foreach ($oldTrashed as $item) {
                if ($item->forceDelete()) {
                    $count++;
                }
            }
            
            if ($count > 0) {
                $results[$name] = $count;
            }
        }
        
        return $results;
    }
}
