<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::with('section')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function show(Category $category){
        $category->load('section');

        $products = $category->products()->with(['section', 'category', 'brand', 'material', 'images'])->paginate(12);

        return view('admin.categories.show', compact('category', 'products'));
    }
    
    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $sections = Section::all();

        return view('admin.categories.create', compact('sections'));
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id',
        ]);

        Category::create([
            'name' => $request->name,
            'section_id' => $request->section_id,
            'slug' => \Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the category.
     */
    public function edit(Category $category)
    {
        $sections = Section::all();

        return view('admin.categories.edit', compact('category', 'sections'));
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id',
        ]);

        $category->update([
            'name' => $request->name,
            'section_id' => $request->section_id,
            'slug' => \Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
