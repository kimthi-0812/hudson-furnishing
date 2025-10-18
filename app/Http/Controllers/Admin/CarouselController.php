<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of carousels.
     */
    public function index(Request $request)
    {
        $query = Carousel::query();

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->has('is_active') && $request->is_active != '') {
            $query->where('is_active', $request->is_active == '1');
        }

        // Filter by creation date
        if ($request->has('created_from') && $request->created_from != '') {
            $query->whereDate('created_at', '>=', $request->created_from);
        }

        $query->orderBy('sort_order')->orderBy('created_at', 'desc');
        $carousels = $query->paginate(15);

        return view('admin.carousels.index', compact('carousels'));
    }

    /**
     * Show the form for creating a new carousel.
     */
    public function create()
    {
        return view('admin.carousels.create');
    }

    /**
     * Store a newly created carousel.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được quá 255 ký tự.',
            'image.required' => 'Hình ảnh là bắt buộc.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Hình ảnh không được quá 2MB.',
            'button_text.max' => 'Văn bản nút không được quá 100 ký tự.',
            'button_url.url' => 'URL nút không hợp lệ.',
            'button_url.max' => 'URL nút không được quá 500 ký tự.',
            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên.',
            'sort_order.min' => 'Thứ tự sắp xếp phải lớn hơn hoặc bằng 0.',
            'is_active.required' => 'Trạng thái là bắt buộc.',
            'is_active.boolean' => 'Trạng thái không hợp lệ.',
        ]);

        $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->storeAs('carousels', $filename, 'public');

        Carousel::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $filename,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Thêm slide carousel thành công!');
    }

    /**
     * Display the specified carousel.
     */
    public function show(Carousel $carousel)
    {
        return view('admin.carousels.show', compact('carousel'));
    }

    /**
     * Show the form for editing the carousel.
     */
    public function edit(Carousel $carousel)
    {
        return view('admin.carousels.edit', compact('carousel'));
    }

    /**
     * Update the specified carousel.
     */
    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được quá 255 ký tự.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Hình ảnh không được quá 2MB.',
            'button_text.max' => 'Văn bản nút không được quá 100 ký tự.',
            'button_url.url' => 'URL nút không hợp lệ.',
            'button_url.max' => 'URL nút không được quá 500 ký tự.',
            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên.',
            'sort_order.min' => 'Thứ tự sắp xếp phải lớn hơn hoặc bằng 0.',
            'is_active.required' => 'Trạng thái là bắt buộc.',
            'is_active.boolean' => 'Trạng thái không hợp lệ.',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        // Update image if provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($carousel->image) {
                Storage::disk('public')->delete('carousels/' . $carousel->image);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('carousels', $filename, 'public');
            $data['image'] = $filename;
        }

        $carousel->update($data);

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Cập nhật slide carousel thành công!');
    }

    /**
     * Remove the specified carousel.
     */
    public function destroy(Carousel $carousel)
    {
        // Delete image file
        if ($carousel->image) {
            Storage::disk('public')->delete('carousels/' . $carousel->image);
        }

        $carousel->delete();

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Xóa slide carousel thành công!');
    }

    /**
     * Toggle carousel status.
     */
    public function toggleStatus(Carousel $carousel)
    {
        $carousel->update(['is_active' => !$carousel->is_active]);
        
        $status = $carousel->is_active ? 'kích hoạt' : 'vô hiệu hóa';
        return redirect()->route('admin.carousels.index')
            ->with('success', "Đã {$status} slide carousel thành công!");
    }
}