<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews.
     */
    public function index(Request $request)
    {
        $query = Review::with('product');

        // Search by product name
        if ($request->has('product') && $request->product != '') {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->product . '%');
            });
        }

        // Search by customer name
        if ($request->has('customer') && $request->customer != '') {
            $query->where('name', 'like', '%' . $request->customer . '%');
        }

        // Filter by rating
        if ($request->has('rating') && $request->rating != '') {
            $query->where('rating', $request->rating);
        }

        // Search by comment
        if ($request->has('comment') && $request->comment != '') {
            $query->where('comment', 'like', '%' . $request->comment . '%');
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('approved', $request->status == 'approved');
        }

        // Filter by creation date
        if ($request->has('created_from') && $request->created_from != '') {
            $query->whereDate('created_at', '>=', $request->created_from);
        }

        // Sort by creation date
        $query->orderBy('created_at', 'desc');

        $reviews = $query->paginate(15)->withQueryString();

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Approve a review.
     */
    public function approve(Review $review)
    {
        $review->update(['approved' => true]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review approved successfully.');
    }

    /**
     * Remove the specified review.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}
