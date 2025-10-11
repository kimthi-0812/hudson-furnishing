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
    public function index(Request $request)
    {
        // 1. Khởi tạo query
        $query = Product::with(['section', 'category', 'brand', 'material', 'images']);

        // 2. Lọc theo tên
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 3. Lọc theo trạng thái
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // 4. Sắp xếp theo ngày tạo giảm dần
        $query->orderBy('created_at', 'desc');

        // 5. Phân trang
        $products = $query->paginate(15)->withQueryString();

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
            'name'        => 'required|string|max:75',
            'description' => 'required|string',
            'section_id'  => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'material_id' => 'required|exists:materials,id',
            'price'       => 'required|numeric|min:1',
            'sale_price'  => 'nullable|numeric|min:1|lt:price',
            'stock'       => 'required|integer|min:1',
            'featured'    => 'boolean',
            'status'      => 'required|in:active,inactive',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'name.required'        => 'Vui lòng nhập tên sản phẩm.',
            'name.string'          => 'Tên sản phẩm phải là chuỗi ký tự.',
            'name.max'             => 'Tên sản phẩm không được vượt quá 75 ký tự để đảm bảo hiển thị đẹp trên product card.',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm.',
            'description.string'   => 'Mô tả sản phẩm phải là chuỗi ký tự.',
            'section_id.required'  => 'Vui lòng chọn mục sản phẩm.',
            'section_id.exists'    => 'Mục sản phẩm không tồn tại.',
            'category_id.required' => 'Vui lòng chọn loại sản phẩm.',
            'category_id.exists'   => 'Loại sản phẩm không tồn tại.',
            'brand_id.required'    => 'Vui lòng chọn thương hiệu.',
            'brand_id.exists'      => 'Thương hiệu không tồn tại.',
            'material_id.required' => 'Vui lòng chọn chất liệu.',
            'material_id.exists'   => 'Chất liệu không tồn tại.',
            'price.required'       => 'Vui lòng nhập đơn giá.',
            'price.numeric'        => 'Đơn giá phải là số.',
            'price.min'            => 'Đơn giá phải lớn hơn 0.',
            'sale_price.numeric'   => 'Giá khuyến mãi phải là số.',
            'sale_price.min'       => 'Giá khuyến mãi phải lớn hơn 0.',
            'sale_price.lt'        => 'Giá khuyến mãi phải nhỏ hơn đơn giá.',
            'stock.required'       => 'Vui lòng nhập số lượng hàng tồn.',
            'stock.integer'        => 'Số lượng hàng tồn phải là số nguyên.',
            'stock.min'            => 'Số lượng hàng tồn phải lớn hơn 0.',
            'status.required'      => 'Vui lòng chọn tình trạng sản phẩm.',
            'status.in'            => 'Tình trạng sản phẩm không hợp lệ.',
            'images.*.image'       => 'Tệp tải lên phải là hình ảnh.',
            'images.*.mimes'       => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'images.*.max'         => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ]);

        $product = Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'section_id'  => $request->section_id,
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id,
            'material_id' => $request->material_id,
            'price'       => $request->price,
            'sale_price'  => $request->sale_price,
            'stock'       => $request->stock,
            'slug'        => \Str::slug($request->name),
            'featured'    => $request->boolean('featured'),
            'status'      => $request->status,
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
            'name'        => 'required|string|max:75',
            'description' => 'required|string',
            'section_id'  => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'material_id' => 'required|exists:materials,id',
            'price'       => 'required|numeric|min:1|max:1000000000',
            'sale_price'  => 'nullable|numeric|min:1|lt:price',
            'stock'       => 'required|integer|min:1',
            'featured'    => 'boolean',
            'status'      => 'required|in:active,inactive',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required'        => 'Vui lòng nhập tên sản phẩm.',
            'name.string'          => 'Tên sản phẩm phải là chuỗi ký tự.',
            'name.max'             => 'Tên sản phẩm không được vượt quá 75 ký tự để đảm bảo hiển thị đẹp trên product card.',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm.',
            'description.string'   => 'Mô tả sản phẩm phải là chuỗi ký tự.',
            'section_id.required'  => 'Vui lòng chọn mục sản phẩm.',
            'section_id.exists'    => 'Mục sản phẩm không tồn tại.',
            'category_id.required' => 'Vui lòng chọn loại sản phẩm.',
            'category_id.exists'   => 'Loại sản phẩm không tồn tại.',
            'brand_id.required'    => 'Vui lòng chọn thương hiệu.',
            'brand_id.exists'      => 'Thương hiệu không tồn tại.',
            'material_id.required' => 'Vui lòng chọn chất liệu.',
            'material_id.exists'   => 'Chất liệu không tồn tại.',
            'price.required'       => 'Vui lòng nhập đơn giá.',
            'price.numeric'        => 'Đơn giá phải là số.',
            'price.min'            => 'Đơn giá phải lớn hơn 1.',
            'sale_price.numeric'   => 'Giá khuyến mãi phải là số.',
            'sale_price.min'       => 'Giá khuyến mãi phải lớn hơn 1.',
            'sale_price.lt'        => 'Giá khuyến mãi phải nhỏ hơn đơn giá.',
            'stock.required'       => 'Vui lòng nhập số lượng hàng tồn.',
            'stock.integer'        => 'Số lượng hàng tồn phải là số nguyên.',
            'stock.min'            => 'Số lượng hàng tồn phải lớn hơn 1.',
            'status.required'      => 'Vui lòng chọn tình trạng sản phẩm.',
            'status.in'            => 'Tình trạng sản phẩm không hợp lệ.',
            'images.*.image'       => 'Tệp tải lên phải là hình ảnh.',
            'images.*.mimes'       => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'images.*.max'         => 'Kích thước hình ảnh không được vượt quá 2MB.',
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
        // Soft delete associated images and product (không xóa file ngay)
        foreach ($product->images as $image) {
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
