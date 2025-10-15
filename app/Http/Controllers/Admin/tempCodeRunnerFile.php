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
        $products = $query->paginate(15)->withQueryString();

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
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        // Xử lý dữ liệu trước khi validate
        $data = $request->all();
        
        // Loại bỏ dấu phẩy từ price và sale_price
        if (isset($data['price'])) {
            $data['price'] = str_replace(',', '', $data['price']);
        }
        if (isset($data['sale_price'])) {
            $data['sale_price'] = str_replace(',', '', $data['sale_price']);
        }
        if (isset($data['stock'])) {
            $data['stock'] = str_replace(',', '', $data['stock']);
        }
        
        // Tự động chuyển status thành inactive nếu stock = 0
        if (isset($data['stock']) && $data['stock'] == 0) {
            $data['status'] = 'inactive';
        }
        
        // Cấm chọn active khi stock = 0
        if (isset($data['stock']) && $data['stock'] == 0 && isset($data['status']) && $data['status'] == 'active') {
            $data['status'] = 'inactive';
        }
        
        // Tạo request mới với dữ liệu đã xử lý
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
            'price.max'            => 'Đơn giá không được vượt quá 1 tỷ VNĐ.',
            'sale_price.numeric'   => 'Giá khuyến mãi phải là số.',
            'sale_price.min'       => 'Giá khuyến mãi phải lớn hơn 0.',
            'sale_price.max'       => 'Giá khuyến mãi không được vượt quá 1 tỷ VNĐ.',
            'sale_price.lt'        => 'Giá khuyến mãi phải nhỏ hơn đơn giá.',
            'stock.required'       => 'Vui lòng nhập số lượng hàng tồn.',
            'stock.integer'        => 'Số lượng hàng tồn phải là số nguyên.',
            'stock.min'            => 'Số lượng hàng tồn không được âm.',
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
                $image->storeAs('uploads/products', $filename, 'public');

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
        // Xử lý dữ liệu trước khi validate
        $data = $request->all();
        
        // Loại bỏ dấu phẩy từ price và sale_price
        if (isset($data['price'])) {
            $data['price'] = str_replace(',', '', $data['price']);
        }
        if (isset($data['sale_price'])) {
            $data['sale_price'] = str_replace(',', '', $data['sale_price']);
        }
        if (isset($data['stock'])) {
            $data['stock'] = str_replace(',', '', $data['stock']);
        }
        
        // Tự động chuyển status thành inactive nếu stock = 0
        if (isset($data['stock']) && $data['stock'] == 0) {
            $data['status'] = 'inactive';
        }
        
        // Cấm chọn active khi stock = 0
        if (isset($data['stock']) && $data['stock'] == 0 && isset($data['status']) && $data['status'] == 'active') {
            $data['status'] = 'inactive';
        }
        
        // Tạo request mới với dữ liệu đã xử lý
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
            'price.min'            => 'Đơn giá phải lớn hơn 0.',
            'price.max'            => 'Đơn giá không được vượt quá 1 tỷ VNĐ.',
            'sale_price.numeric'   => 'Giá khuyến mãi phải là số.',
            'sale_price.min'       => 'Giá khuyến mãi phải lớn hơn 0.',
            'sale_price.max'       => 'Giá khuyến mãi không được vượt quá 1 tỷ VNĐ.',
            'sale_price.lt'        => 'Giá khuyến mãi phải nhỏ hơn đơn giá.',
            'stock.required'       => 'Vui lòng nhập số lượng hàng tồn.',
            'stock.integer'        => 'Số lượng hàng tồn phải là số nguyên.',
            'stock.min'            => 'Số lượng hàng tồn không được âm.',
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
                $image->storeAs('uploads/products', $filename, 'public');

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