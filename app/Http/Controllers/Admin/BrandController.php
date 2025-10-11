<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::withCount('products');

        // Search by name
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by product count
        if ($request->has('product_count') && $request->product_count != '') {
            switch ($request->product_count) {
                case '0':
                    $query->having('products_count', '=', 0);
                    break;
                case '1-10':
                    $query->having('products_count', '>=', 1)->having('products_count', '<=', 10);
                    break;
                case '11-50':
                    $query->having('products_count', '>=', 11)->having('products_count', '<=', 50);
                    break;
                case '51+':
                    $query->having('products_count', '>=', 51);
                    break;
            }
        }

        // Filter by creation date
        if ($request->has('created_from') && $request->created_from != '') {
            $query->whereDate('created_at', '>=', $request->created_from);
        }

        // Sort by creation date
        $query->orderBy('created_at', 'desc');

        $brands = $query->paginate(15)->withQueryString();
        
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands',
            'description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brand = Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'logo' => $request->file('logo') ? $request->file('logo')->store('brands', 'public') : null,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully!');
    }

    public function show(Brand $brand)
    {

        $products = $brand->products()->with(['section', 'category', 'brand', 'material', 'images'])->paginate(12);
        
        return view('admin.brands.show', compact('brand', 'products'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'logo' => $request->file('logo') ? $request->file('logo')->store('brands', 'public') : $brand->logo,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully!');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->products()->count() > 0) {
            return redirect()->route('admin.brands.index')->with('error', 'Cannot delete brand with existing products!');
        }

        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully!');
    }
}
