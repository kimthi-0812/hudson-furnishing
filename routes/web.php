<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\MaterialController as AdminMaterialController;
use App\Http\Controllers\Admin\OfferController as AdminOfferController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Products Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{section}', [ProductController::class, 'bySection'])->name('products.section');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// Categories Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Brands Routes
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');

// Materials Routes
Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');

// Offers Routes
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');

// Gallery Routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->middleware('auth')->name('contact.store');

// Review Routes
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Visitor Stats
Route::post('/visitor-stats', [HomeController::class, 'incrementVisitor'])->name('visitor.increment');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Admin Routes (Protected)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Products Management
    Route::resource('products', AdminProductController::class)->names([
        'index'   => 'admin.products.index',
        'create'  => 'admin.products.create',
        'store'   => 'admin.products.store',
        'show'    => 'admin.products.show',
        'edit'    => 'admin.products.edit',
        'update'  => 'admin.products.update',
        'destroy' => 'admin.products.destroy'
    ]);
    Route::post('products/{product}/images', [AdminProductController::class, 'uploadImages'])->name('admin.products.images');
    
    // Categories Management
    Route::resource('categories', AdminCategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy'
    ]);
    
    // Brands Management
    Route::resource('brands', AdminBrandController::class)->names([
        'index' => 'admin.brands.index',
        'create' => 'admin.brands.create',
        'store' => 'admin.brands.store',
        'show' => 'admin.brands.show',
        'edit' => 'admin.brands.edit',
        'update' => 'admin.brands.update',
        'destroy' => 'admin.brands.destroy'
    ]);
    
    // Materials Management
    Route::resource('materials', AdminMaterialController::class)->names([
        'index' => 'admin.materials.index',
        'create' => 'admin.materials.create',
        'store' => 'admin.materials.store',
        'show' => 'admin.materials.show',
        'edit' => 'admin.materials.edit',
        'update' => 'admin.materials.update',
        'destroy' => 'admin.materials.destroy'
    ]);
    
    // Offers Management
    Route::resource('offers', AdminOfferController::class)->names([
        'index' => 'admin.offers.index',
        'create' => 'admin.offers.create',
        'store' => 'admin.offers.store',
        'show' => 'admin.offers.show',
        'edit' => 'admin.offers.edit',
        'update' => 'admin.offers.update',
        'destroy' => 'admin.offers.destroy'
    ]);
    
    // Reviews Management
    Route::get('reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
    Route::patch('reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::delete('reviews/{review}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');
    
    // Gallery Management
    Route::get('gallery', [AdminGalleryController::class, 'index'])->name('admin.gallery.index');
    Route::post('gallery', [AdminGalleryController::class, 'store'])->name('admin.gallery.store');
    Route::delete('gallery/{image}', [AdminGalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    Route::patch('gallery/{image}/primary', [AdminGalleryController::class, 'setPrimary'])->name('admin.gallery.primary');
    
    // Contacts Management
    Route::get('contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
    Route::put('contacts/{contact}', [AdminContactController::class, 'update'])->name('admin.contacts.update');
    Route::patch('contacts/{contact}/read', [AdminContactController::class, 'markAsRead'])->name('admin.contacts.read');
    Route::patch('contacts/{contact}/replied', [AdminContactController::class, 'markAsReplied'])->name('admin.contacts.replied');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
    
    // Settings Management
    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('admin.settings.update');
});
