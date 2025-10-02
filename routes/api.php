<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\VisitorStatController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public API Routes
Route::prefix('v1')->group(function () {
    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/products/section/{section}', [ProductController::class, 'bySection']);
    
    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    
    // Brands
    Route::get('/brands', [BrandController::class, 'index']);
    
    // Materials
    Route::get('/materials', [MaterialController::class, 'index']);
    
    // Offers
    Route::get('/offers', [OfferController::class, 'index']);
    
    // Gallery
    Route::get('/gallery', [GalleryController::class, 'index']);
    
    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store']);
    
    // Contact
    Route::post('/contact', [ContactController::class, 'store']);
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index']);
    
    // Visitor Stats
    Route::post('/visitor-stats', [VisitorStatController::class, 'increment']);
    
    // Authentication
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    
    // User info
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});

// Admin API Routes
Route::prefix('v1/admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return response()->json([
            'total_products' => \App\Models\Product::count(),
            'total_categories' => \App\Models\Category::count(),
            'total_brands' => \App\Models\Brand::count(),
            'total_materials' => \App\Models\Material::count(),
            'total_offers' => \App\Models\Offer::count(),
            'total_reviews' => \App\Models\Review::count(),
            'pending_reviews' => \App\Models\Review::where('approved', false)->count(),
            'total_contacts' => \App\Models\Contact::count(),
            'new_contacts' => \App\Models\Contact::where('status', 'new')->count(),
            'total_visitors' => \App\Models\VisitorStat::sum('total_visits'),
            'unique_visitors' => \App\Models\VisitorStat::sum('unique_visits'),
        ]);
    });
    
    // Products CRUD
    Route::apiResource('products', ProductController::class);
    Route::post('products/{product}/images', [ProductController::class, 'uploadImages']);
    
    // Categories CRUD
    Route::apiResource('categories', CategoryController::class);
    
    // Brands CRUD
    Route::apiResource('brands', BrandController::class);
    
    // Materials CRUD
    Route::apiResource('materials', MaterialController::class);
    
    // Offers CRUD
    Route::apiResource('offers', OfferController::class);
    
    // Reviews Management
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::patch('reviews/{review}/approve', [ReviewController::class, 'approve']);
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy']);
    
    // Gallery Management
    Route::get('gallery', [GalleryController::class, 'index']);
    Route::post('gallery/upload', [GalleryController::class, 'upload']);
    Route::delete('gallery/{image}', [GalleryController::class, 'destroy']);
    
    // Contacts Management
    Route::get('contacts', [ContactController::class, 'index']);
    Route::patch('contacts/{contact}/status', [ContactController::class, 'updateStatus']);
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy']);
    
    // Settings Management
    Route::get('settings', [SettingController::class, 'index']);
    Route::put('settings', [SettingController::class, 'update']);
    
    // Visitor Stats
    Route::get('visitor-stats', [VisitorStatController::class, 'index']);
    Route::get('visitor-stats/chart', [VisitorStatController::class, 'chart']);
});