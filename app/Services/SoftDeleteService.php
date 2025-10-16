<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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
     * Get Vietnamese names for models
     */
    public static function getModelNames(): array
    {
        return [
            'products' => 'Sản phẩm',
            'categories' => 'Danh mục',
            'brands' => 'Thương hiệu',
            'materials' => 'Vật liệu',
            'offers' => 'Ưu đãi',
            'sections' => 'Khu vực',
            'reviews' => 'Đánh giá',
            'contacts' => 'Liên hệ',
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
            try {
                // Handle specific models with foreign key constraints
                if ($modelClass === \App\Models\Product::class) {
                    // Force delete all related images first (including soft deleted ones)
                    $images = $item->images()->withTrashed()->get();
                    foreach ($images as $image) {
                        $image->forceDelete();
                    }
                    
                    // Delete files from storage
                    if ($item->primary_image) {
                        $filePath = storage_path('app/public/uploads/products/' . $item->primary_image);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                    
                    // Delete additional image files
                    foreach ($item->images as $image) {
                        if ($image->url) {
                            $filePath = storage_path('app/public/uploads/' . $image->url);
                            if (file_exists($filePath)) {
                                unlink($filePath);
                            }
                        }
                    }
                }
                
                return $item->forceDelete();
            } catch (\Exception $e) {
                Log::error('Force delete failed for ' . $modelClass . ' ID: ' . $id, [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return false;
            }
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
