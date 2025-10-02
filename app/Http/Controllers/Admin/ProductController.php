<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Material;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::with(['section', 'category', 'brand', 'material', 'images'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $sections = Section::all();
        $categories = Category::all();
        $brands = Brand::all();
        $materials = Material::all();

        return view('admin.products.create', compact('sections', 'categories', 'brands', 'materials'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'section_id' => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'material_id' => 'required|exists:materials,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'featured' => 'boolean',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'section_id' => $request->section_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'material_id' => $request->material_id,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'slug' => \Str::slug($request->name),
            'featured' => $request->boolean('featured'),
            'status' => $request->status,
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $filename,
                    'alt_text' => $product->name . ' - Image ' . ($index + 1),
                    'is_primary' => $index === 0,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load(['section', 'category', 'brand', 'material', 'images', 'reviews']);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the product.
     */
    public function edit(Product $product)
    {
        $sections = Section::all();
        $categories = Category::all();
        $brands = Brand::all();
        $materials = Material::all();

        return view('admin.products.edit', compact('product', 'sections', 'categories', 'brands', 'materials'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'section_id' => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'material_id' => 'required|exists:materials,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'featured' => 'boolean',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'section_id' => $request->section_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'material_id' => $request->material_id,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'slug' => \Str::slug($request->name),
            'featured' => $request->boolean('featured'),
            'status' => $request->status,
        ]);

        // Handle additional image uploads
        if ($request->hasFile('images')) {
            $existingImagesCount = $product->images()->count();
            
            foreach ($request->file('images') as $index => $image) {
                $filename = time() . '_' . ($existingImagesCount + $index) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $filename,
                    'alt_text' => $product->name . ' - Image ' . ($existingImagesCount + $index + 1),
                    'is_primary' => false,
                    'sort_order' => $existingImagesCount + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        // Delete associated images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete('products/' . $image->url);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Upload additional images for a product.
     */
    public function uploadImages(Request $request, Product $product)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $existingImagesCount = $product->images()->count();

        foreach ($request->file('images') as $index => $image) {
            $filename = time() . '_' . ($existingImagesCount + $index) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads/products', $filename);

            ProductImage::create([
                'product_id' => $product->id,
                'url' => $filename,
                'alt_text' => $product->name . ' - Image ' . ($existingImagesCount + $index + 1),
                'is_primary' => false,
                'sort_order' => $existingImagesCount + $index + 1,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Images uploaded successfully.']);
    }
}
