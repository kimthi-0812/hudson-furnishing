<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\SiteSetting;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index(Request $request)
    {
        $siteSettings = SiteSetting::pluck('value', 'key')->toArray();
        
        // Get product info if product_id is provided
        $product = null;
        $productId = $request->get('product_id');
        if ($productId) {
            $product = \App\Models\Product::with(['section', 'category', 'brand', 'material', 'images'])
                ->where('status', 'active')
                ->find($productId);
        }
        
        return view('pages.contact.index', compact('siteSettings', 'product'));
    }

    /**
     * Store a newly created contact message.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
            'product_id' => 'nullable|exists:products,id',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'message.required' => 'Vui lòng nhập thông điệp của bạn.',
            'product_id.exists' => 'Sản phẩm không tồn tại.',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'product_id' => $request->product_id,
            'status' => 'new',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message. We will get back to you soon!'
        ]);
    }
}
