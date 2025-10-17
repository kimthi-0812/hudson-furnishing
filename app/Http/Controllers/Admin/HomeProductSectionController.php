<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeProductSection;
use App\Models\Product;

class HomeProductSectionController extends Controller
{
    /**
     * Hiển thị danh sách Home Sections
     */
    public function index()
    {

        $settings = SiteSetting::pluck('value', 'key')->toArray();
        $products = Product::where('status', 'active')->get();

        $homeSection = HomeProductSection::with('products')->first();
        return view('admin.settings.index', compact('settings', 'products', 'homeSection'));
    }

    /**
     * Hiển thị form tạo mới
     */
    public function create()
    {
        $products = Product::where('status', 'active')->get();
        return view('admin.home_sections.create', compact('products'));
    }

    /**
     * Lưu Section mới
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'type'      => 'nullable|string|max:100',
            'limit'     => 'nullable|integer|min:1',
            'is_active' => 'sometimes|boolean',
            'order'     => 'nullable|integer|min:0',
            'products'  => 'array',
        ]);

        // Checkbox nếu không tick sẽ không gửi dữ liệu, set mặc định 0
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $section = HomeProductSection::create($data);

        if (!empty($data['products'])) {
            $section->products()->sync($data['products']);
        }

        return back()->with('success', 'Section đã được tạo thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa
     */
    public function edit(HomeProductSection $homeSection)
    {
        $products = Product::where('status', 'active')->get();
        return view('admin.home_sections.edit', compact('homeSection', 'products'));
    }

    /**
     * Cập nhật Section
     */
    public function update(Request $request, HomeProductSection $homeSection)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'type'      => 'nullable|string|max:100',
            'limit'     => 'nullable|integer|min:1',
            'is_active' => 'sometimes|boolean',
            'order'     => 'nullable|integer|min:0',
            'products'  => 'array',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $homeSection->update($data);

        if (!empty($data['products'])) {
            $homeSection->products()->sync($data['products']);
        } else {
            $homeSection->products()->detach();
        }

        return redirect()->route('home-sections.index')
                         ->with('success', 'Section đã được cập nhật thành công!');
    }

    /**
     * Xóa Section (soft delete)
     */
    public function destroy(HomeProductSection $homeSection)
    {
        $homeSection->delete(); // soft delete
        return redirect()->route('home-sections.index')
                         ->with('success', 'Section đã được xóa thành công!');
    }
}
