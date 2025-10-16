<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SoftDeleteService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TrashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display the trash dashboard
     */
    public function index(): View
    {
        $trashedItems = SoftDeleteService::getAllTrashedItems();
        $statistics = SoftDeleteService::getTrashStatistics();
        $modelNames = SoftDeleteService::getModelNames();
        
        return view('admin.trash.index', compact('trashedItems', 'statistics', 'modelNames'));
    }

    /**
     * Show trashed items for a specific model
     */
    public function show(string $model): View
    {
        $models = SoftDeleteService::getSoftDeleteModels();
        
        if (!isset($models[$model])) {
            abort(404, 'Model not found');
        }
        
        $modelClass = $models[$model];
        $items = $modelClass::onlyTrashed()->paginate(15);
        $modelNames = SoftDeleteService::getModelNames();
        
        return view('admin.trash.show', compact('items', 'model', 'modelClass', 'modelNames'));
    }

    /**
     * Restore a specific item
     */
    public function restore(Request $request): RedirectResponse
    {
        $request->validate([
            'model' => 'required|string',
            'id' => 'required|integer'
        ]);
        
        $models = SoftDeleteService::getSoftDeleteModels();
        $modelClass = $models[$request->model] ?? null;
        
        if (!$modelClass) {
            return back()->with('error', 'Invalid model');
        }
        
        if (SoftDeleteService::restoreItem($modelClass, $request->id)) {
            return back()->with('success', 'Item restored successfully!');
        }
        
        return back()->with('error', 'Failed to restore item');
    }

    /**
     * Permanently delete an item
     */
    public function forceDelete(Request $request): RedirectResponse
    {
        $request->validate([
            'model' => 'required|string',
            'id' => 'required|integer'
        ]);
        
        $models = SoftDeleteService::getSoftDeleteModels();
        $modelClass = $models[$request->model] ?? null;
        
        if (!$modelClass) {
            return back()->with('error', 'Invalid model');
        }
        
        if (SoftDeleteService::forceDeleteItem($modelClass, $request->id)) {
            return back()->with('success', 'Item permanently deleted!');
        }
        
        return back()->with('error', 'Failed to delete item');
    }

    /**
     * Bulk restore items
     */
    public function bulkRestore(Request $request): RedirectResponse
    {
        $request->validate([
            'model' => 'required|string',
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);
        
        $models = SoftDeleteService::getSoftDeleteModels();
        $modelClass = $models[$request->model] ?? null;
        
        if (!$modelClass) {
            return back()->with('error', 'Invalid model');
        }
        
        $count = SoftDeleteService::bulkRestore($modelClass, $request->ids);
        
        return back()->with('success', "{$count} items restored successfully!");
    }

    /**
     * Bulk force delete items
     */
    public function bulkForceDelete(Request $request): RedirectResponse
    {
        $request->validate([
            'model' => 'required|string',
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);
        
        $models = SoftDeleteService::getSoftDeleteModels();
        $modelClass = $models[$request->model] ?? null;
        
        if (!$modelClass) {
            return back()->with('error', 'Invalid model');
        }
        
        $count = SoftDeleteService::bulkForceDelete($modelClass, $request->ids);
        
        return back()->with('success', "{$count} items permanently deleted!");
    }

    /**
     * Clean up old trash
     */
    public function cleanup(Request $request): RedirectResponse
    {
        $days = $request->input('days', 30);
        $results = SoftDeleteService::cleanupOldTrash($days);
        
        $message = 'Cleanup completed. ';
        foreach ($results as $model => $count) {
            $message .= ucfirst($model) . ": {$count} items deleted. ";
        }
        
        return back()->with('success', $message);
    }
}
