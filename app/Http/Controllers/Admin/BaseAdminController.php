<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

abstract class BaseAdminController extends Controller
{
    protected $model;
    protected $modelName;
    protected $routePrefix;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = $this->model::paginate(15);
        return view("admin.{$this->routePrefix}.index", compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("admin.{$this->routePrefix}.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $item = $this->model::create($validated);
        
        return redirect()
            ->route("admin.{$this->routePrefix}.index")
            ->with('success', "{$this->modelName} created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        return view("admin.{$this->routePrefix}.show", compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $item = $this->model::findOrFail($id);
        return view("admin.{$this->routePrefix}.edit", compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $item = $this->model::findOrFail($id);
        $validated = $this->validateRequest($request);
        $item->update($validated);
        
        return redirect()
            ->route("admin.{$this->routePrefix}.index")
            ->with('success', "{$this->modelName} updated successfully!");
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id): RedirectResponse
    {
        $item = $this->model::findOrFail($id);
        $item->delete(); // This will soft delete
        
        return redirect()
            ->route("admin.{$this->routePrefix}.index")
            ->with('success', "{$this->modelName} deleted successfully!");
    }

    /**
     * Restore a soft deleted resource.
     */
    public function restore($id): RedirectResponse
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $item->restore();
        
        return redirect()
            ->route("admin.{$this->routePrefix}.index")
            ->with('success', "{$this->modelName} restored successfully!");
    }

    /**
     * Permanently delete a resource.
     */
    public function forceDelete($id): RedirectResponse
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $item->forceDelete();
        
        return redirect()
            ->route("admin.{$this->routePrefix}.index")
            ->with('success', "{$this->modelName} permanently deleted!");
    }

    /**
     * Show trashed items.
     */
    public function trashed(): View
    {
        $items = $this->model::onlyTrashed()->paginate(15);
        return view("admin.{$this->routePrefix}.trashed", compact('items'));
    }

    /**
     * Validate the request data.
     */
    abstract protected function validateRequest(Request $request): array;
}
