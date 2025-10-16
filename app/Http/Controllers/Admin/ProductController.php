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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

        // 4. Lọc theo danh mục
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // 5. Lọc theo thương hiệu
        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand_id', $request->brand);
        }

        // 6. Lọc theo khu vực
        if ($request->has('section') && $request->section != '') {
            $query->where('section_id', $request->section);
        }

        // 7. Lọc theo chất liệu
        if ($request->has('material') && $request->material != '') {
            $query->where('material_id', $request->material);
        }

        // 8. Lọc theo khoảng giá
        if ($request->has('price_range') && $request->price_range != '') {
            $priceRange = explode('-', $request->price_range);
            if (count($priceRange) == 2) {
                $minPrice = $priceRange[0];
                $maxPrice = $priceRange[1];
                $query->where('price', '>=', $minPrice);
                if ($maxPrice != '999999999') {
                    $query->where('price', '<=', $maxPrice);
                }
            }
        }

        // 9. Lọc theo khoảng số lượng tồn
        if ($request->has('stock_range') && $request->stock_range != '') {
            $stockRange = explode('-', $request->stock_range);
            if (count($stockRange) == 2) {
                $minStock = $stockRange[0];
                $maxStock = $stockRange[1];
                $query->where('stock', '>=', $minStock);
                if ($maxStock != '999999') {
                    $query->where('stock', '<=', $maxStock);
                }
            } elseif ($request->stock_range == '0') {
                $query->where('stock', '=', 0);
            }
        }

        // 10. Lọc theo sản phẩm nổi bật
        if ($request->has('featured') && $request->featured != '') {
            $query->where('featured', $request->featured == '1');
        }

        // 11. Lọc theo ngày tạo
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // 12. Lọc theo sản phẩm có khuyến mãi
        if ($request->has('on_sale') && $request->on_sale == '1') {
            $query->whereNotNull('sale_price')->where('sale_price', '>', 0);
        }

        // 13. Sắp xếp
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        switch ($sortBy) {
            case 'name':
                $query->orderBy('name', $sortOrder);
                break;
            case 'price':
                $query->orderBy('price', $sortOrder);
                break;
            case 'stock':
                $query->orderBy('stock', $sortOrder);
                break;
            case 'created_at':
                $query->orderBy('created_at', $sortOrder);
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // 14. Phân trang
        $products = $query->paginate(15);

        // 15. Lấy dữ liệu cho filter
        $sections = Section::all();
        $categories = Category::all();
        $brands = Brand::all();
        $materials = Material::all();

        return view('admin.products.index', compact('products', 'sections', 'categories', 'brands', 'materials'));
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
     * Get categories by section ID for AJAX
     */
    public function getCategoriesBySection($sectionId)
    {
        $categories = Category::where('section_id', $sectionId)->get();
        return response()->json($categories);
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        // Xử lý dữ liệu trước khi validate
        $data = $request->all();

        // Loại bỏ dấu phẩy từ price, sale_price, stock, discount_value
        $data['price'] = isset($data['price']) ? str_replace(',', '', $data['price']) : 0;
        $data['sale_price'] = isset($data['sale_price']) ? str_replace(',', '', $data['sale_price']) : null;
        $data['discount_value'] = isset($data['discount_value']) ? str_replace(',', '', $data['discount_value']) : null;
        $data['stock'] = isset($data['stock']) ? str_replace(',', '', $data['stock']) : 0;

        // Tự động chuyển status thành inactive nếu stock = 0
        if ($data['stock'] == 0) {
            $data['status'] = 'inactive';
        }

        $request->merge($data);

        // Debug: Log request data
        Log::info('Product creation request:', [
            'has_primary_image' => $request->hasFile('primary_image'),
            'has_images' => $request->hasFile('images'),
            'files' => $request->allFiles(),
            'all_data' => $request->except(['_token'])
        ]);

        $request->validate([
            'name'        => 'required|string|max:75',
            'description' => 'nullable|string',
            'specifications' => 'required|string',
            'section_id'  => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'material_id' => 'required|exists:materials,id',
            'price'       => 'required|numeric|min:1|max:1000000000',
            'sale_price'  => 'nullable|numeric|min:1|max:1000000000|lt:price',
            'discount_type' => 'nullable|in:percent,amount',
            'discount_value' => 'nullable|numeric|min:0|max:1000000000',
            'stock'       => 'required|integer|min:0',
            'featured'    => 'boolean',
            'status'      => 'required|in:active,inactive',
            'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tạo slug duy nhất
        $nameSlug = Str::slug($request->name);
        $slug = $nameSlug;
        $counter = 1;
        
        // Đảm bảo slug duy nhất
        while (Product::where('slug', $slug)->exists()) {
            $slug = $nameSlug . '-' . $counter;
            $counter++;
            
            // Prevent infinite loop
            if ($counter > 1000) {
                $slug = $nameSlug . '-' . time();
                break;
            }
        }

        // Tạo product với transaction
        try {
            $product = DB::transaction(function () use ($request, $slug) {
                return Product::create([
                    'name'        => $request->name,
                    'description' => $request->description ?: '',
                    'specifications' => $request->specifications,
                    'section_id'  => $request->section_id,
                    'category_id' => $request->category_id,
                    'brand_id'    => $request->brand_id,
                    'material_id' => $request->material_id,
                    'price'       => $request->price,
                    'sale_price'  => $request->sale_price,
                    'discount_type' => $request->discount_type,
                    'discount_value' => $request->discount_value,
                    'stock'       => $request->stock,
                    'slug'        => $slug,
                    'featured'    => $request->boolean('featured'),
                    'status'      => $request->status,
                ]);
            });
        } catch (\Illuminate\Database\QueryException $e) {
            // Nếu vẫn bị duplicate slug, thử lại với timestamp
            if (str_contains($e->getMessage(), 'products_slug_unique')) {
                $slug = $nameSlug . '-' . time() . '-' . rand(1000, 9999);
                $product = Product::create([
                    'name'        => $request->name,
                    'description' => $request->description ?: '',
                    'specifications' => $request->specifications,
                    'section_id'  => $request->section_id,
                    'category_id' => $request->category_id,
                    'brand_id'    => $request->brand_id,
                    'material_id' => $request->material_id,
                    'price'       => $request->price,
                    'sale_price'  => $request->sale_price,
                    'discount_type' => $request->discount_type,
                    'discount_value' => $request->discount_value,
                    'stock'       => $request->stock,
                    'slug'        => $slug,
                    'featured'    => $request->boolean('featured'),
                    'status'      => $request->status,
                ]);
            } else {
                throw $e;
            }
        }

        // Upload ảnh chính
        if ($request->hasFile('primary_image')) {
            $primaryImage = $request->file('primary_image');
            $primaryFilename = 'product-' . $product->id . '-primary.' . $primaryImage->getClientOriginalExtension();
            $primaryImage->storeAs('uploads/products', $primaryFilename, 'public');
            
            // Update product với primary image
            $product->update(['primary_image' => $primaryFilename]);
            
            // Tạo ProductImage cho primary
            ProductImage::create([
                'product_id' => $product->id,
                'url' => $primaryFilename,
                'alt_text' => $product->name . ' - Primary Image',
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        }

        // Upload hình ảnh bổ sung
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = 'product-' . $product->id . '-additional-' . ($index + 1) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads/products', $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $filename,
                    'alt_text' => $product->name . ' - Additional Image ' . ($index + 1),
                    'is_primary' => false, // Không phải ảnh chính
                    'sort_order' => $index + 1,
                ]);
            }
        }


        return redirect()->route('admin.products.index')
            ->with('success', 'Sản phẩm đã được tạo thành công.');
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
        // Xử lý dữ liệu trước khi validate
        $data = $request->all();
        $data['price'] = isset($data['price']) ? str_replace(',', '', $data['price']) : 0;
        $data['sale_price'] = isset($data['sale_price']) ? str_replace(',', '', $data['sale_price']) : null;
        $data['stock'] = isset($data['stock']) ? str_replace(',', '', $data['stock']) : 0;

        if ($data['stock'] == 0) {
            $data['status'] = 'inactive';
        }

        $request->merge($data);

        $request->validate([
            'name'        => 'required|string|max:75',
            'description' => 'required|string',
            'section_id'  => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'material_id' => 'required|exists:materials,id',
            'price'       => 'required|numeric|min:1|max:1000000000',
            'sale_price'  => 'nullable|numeric|min:1|max:1000000000|lt:price',
            'stock'       => 'required|integer|min:0',
            'featured'    => 'boolean',
            'status'      => 'required|in:active,inactive',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tạo slug duy nhất (bỏ qua chính sản phẩm)
        $nameSlug = Str::slug($request->name);
        $slug = $nameSlug;
        $counter = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $nameSlug . '-' . $counter;
            $counter++;
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'section_id'  => $request->section_id,
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id,
            'material_id' => $request->material_id,
            'price'       => $request->price,
            'sale_price'  => $request->sale_price,
            'stock'       => $request->stock,
            'slug'        => $slug,
            'featured'    => $request->boolean('featured'),
            'status'      => $request->status,
        ]);

        // Upload hình ảnh mới (nếu có)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = 'product-' . $product->id . '-' . ($index + 1) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads/products', $filename, 'public'); // Lưu trong storage/app/public/uploads/products

                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => 'products/' . $filename, // đường dẫn đúng để hiển thị
                    'alt_text' => $product->name . ' - Image ' . ($index + 1),
                    'is_primary' => $index === 0,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Đã cập nhật sản phẩm thành công.');
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
            ->with('success', 'Sản phẩm đã được xóa.');
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
            $filename = 'product-' . $product->id . '-' . ($existingImagesCount + $index + 1) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/products', $filename, 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'url' => $filename,
                'alt_text' => $product->name . ' - Image ' . ($existingImagesCount + $index + 1),
                'is_primary' => $index === 0,
                'sort_order' => $existingImagesCount + $index + 1,
            ]);
        }
        return response()->json(['success' => true, 'message' => 'Images uploaded successfully.']);
    }

    /**
     * Delete a specific product image.
     */
    public function deleteImage(Request $request, Product $product, $imageId)
    {
        try {
            $image = ProductImage::where('id', $imageId)
                                ->where('product_id', $product->id)
                                ->first();

            if (!$image) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image not found.'
                ], 404);
            }

            // Delete the image file from storage
            $imagePath = storage_path('app/public/uploads/products/' . $image->url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Delete the image record from database
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }
}
