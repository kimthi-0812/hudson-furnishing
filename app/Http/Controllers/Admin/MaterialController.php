<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::withCount('products')->paginate(15);
        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.materials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:materials',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $material = Material::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $request->file('image') ? $request->file('image')->store('materials', 'public') : null,
        ]);

        return redirect()->route('admin.materials.index')->with('success', 'Material created successfully!');
    }

    public function show(Material $material)
    {
        $products= $material->products()->with(['section', 'category', 'brand', 'material', 'images'])->paginate(12);
        
        return view('admin.materials.show', compact('material', 'products'));
    }

    public function edit(Material $material)
    {
        return view('admin.materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:materials,name,' . $material->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $material->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $request->file('image') ? $request->file('image')->store('materials', 'public') : $material->image,
        ]);

        return redirect()->route('admin.materials.index')->with('success', 'Material updated successfully!');
    }

    public function destroy(Material $material)
    {
        if ($material->products()->count() > 0) {
            return redirect()->route('admin.materials.index')->with('error', 'Cannot delete material with existing products!');
        }

        $material->delete();
        return redirect()->route('admin.materials.index')->with('success', 'Material deleted successfully!');
    }
}
