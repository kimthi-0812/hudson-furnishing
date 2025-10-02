<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = ProductImage::with('product')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.gallery.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'images' => 'required|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $uploadedImages = [];

        foreach ($request->file('images') as $index => $file) {
            $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products', $filename, 'public');

            $image = ProductImage::create([
                'product_id' => $request->product_id,
                'url' => $filename,
                'alt_text' => $request->alt_text ?: $file->getClientOriginalName(),
                'is_primary' => $index === 0, // First image is primary
            ]);

            $uploadedImages[] = $image;
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Images uploaded successfully!');
    }

    public function destroy(ProductImage $image)
    {
        // Delete file from storage
        if (Storage::disk('public')->exists('products/' . $image->url)) {
            Storage::disk('public')->delete('products/' . $image->url);
        }

        $image->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted successfully!');
    }

    public function setPrimary(ProductImage $image)
    {
        // Remove primary from other images of the same product
        ProductImage::where('product_id', $image->product_id)->update(['is_primary' => false]);
        
        // Set this image as primary
        $image->update(['is_primary' => true]);

        return redirect()->route('admin.gallery.index')->with('success', 'Primary image updated successfully!');
    }
}
