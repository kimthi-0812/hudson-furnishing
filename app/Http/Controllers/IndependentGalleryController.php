<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class IndependentGalleryController extends Controller
{
    /**
     * Display a listing of gallery images.
     */
    public function index(Request $request)
    {
        $query = Gallery::where('status', 'active');

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');
        $galleries = $query->paginate(16);

        return view('pages.independent-gallery.index', compact('galleries'));
    }

    /**
     * Display the specified gallery image.
     */
    public function show(Gallery $gallery)
    {
        if ($gallery->status !== 'active') {
            abort(404);
        }

        // Get related galleries (same status, different from current)
        $relatedGalleries = Gallery::where('status', 'active')
            ->where('id', '!=', $gallery->id)
            ->limit(8)
            ->get();

        return view('pages.independent-gallery.show', compact('gallery', 'relatedGalleries'));
    }
}
