<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    /**
     * Store a newly created review.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ], [
            'product_id.required' => 'Sản phẩm không hợp lệ.',
            'product_id.exists' => 'Sản phẩm không tồn tại.',
            'name.required' => 'Vui lòng nhập tên của bạn.',
            'name.max' => 'Tên không được quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email của bạn.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Email không được quá 255 ký tự.',
            'rating.required' => 'Vui lòng chọn đánh giá sao.',
            'rating.integer' => 'Đánh giá sao không hợp lệ.',
            'rating.min' => 'Đánh giá sao phải từ 1 đến 5.',
            'rating.max' => 'Đánh giá sao phải từ 1 đến 5.',
            'comment.required' => 'Vui lòng nhập nhận xét của bạn.',
            'comment.max' => 'Nhận xét không được quá 1000 ký tự.',
        ]);

        Review::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'approved' => false, // Reviews need approval
        ]);

        return redirect()->back()->with('status', 'Cảm ơn bạn đã gửi đánh giá! Đánh giá của bạn sẽ được hiển thị sau khi được duyệt.');
    }
}
