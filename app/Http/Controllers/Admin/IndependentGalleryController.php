<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndependentGalleryController extends Controller
{
    /**
     * Display a listing of the gallery items.
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by primary status
        if ($request->has('is_primary') && $request->is_primary != '') {
            $query->where('is_primary', $request->is_primary == '1');
        }

        // Filter by creation date
        if ($request->has('created_from') && $request->created_from != '') {
            $query->whereDate('created_at', '>=', $request->created_from);
        }

        $query->orderBy('created_at', 'desc');
        $galleries = $query->paginate(20);

        return view('admin.independent-gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new gallery item.
     */
    public function create()
    {
        return view('admin.independent-gallery.create');
    }

    /**
     * Store a newly created gallery item.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được quá 255 ký tự.',
            'image.required' => 'Hình ảnh là bắt buộc.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Hình ảnh không được quá 2MB.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->storeAs('gallery', $filename, 'public');

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $filename,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.independent-gallery.index')
            ->with('success', 'Thêm hình ảnh vào thư viện thành công!');
    }

    /**
     * Display the specified gallery item.
     */
    public function show(Gallery $gallery)
    {
        return view('admin.independent-gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the gallery item.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.independent-gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery item.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được quá 255 ký tự.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Hình ảnh không được quá 2MB.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ];

        // Update image if provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image) {
                Storage::disk('public')->delete('gallery/' . $gallery->image);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('gallery', $filename, 'public');
            $data['image'] = $filename;
        }

        $gallery->update($data);

        return redirect()->route('admin.independent-gallery.index')
            ->with('success', 'Cập nhật thư viện thành công!');
    }

    /**
     * Remove the specified gallery item.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image file
        if ($gallery->image) {
            Storage::disk('public')->delete('gallery/' . $gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.independent-gallery.index')
            ->with('success', 'Xóa hình ảnh khỏi thư viện thành công!');
    }

    /**
     * Set image as primary.
     */
    public function setPrimary(Gallery $gallery)
    {
        // Remove primary from other images
        Gallery::where('id', '!=', $gallery->id)->update(['is_primary' => false]);
        
        // Set this image as primary
        $gallery->update(['is_primary' => true]);

        return redirect()->route('admin.independent-gallery.index')
            ->with('success', 'Đặt làm hình ảnh chính thành công!');
    }
}
