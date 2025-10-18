@extends('layouts.guest')

@section('title', 'Trang Chủ - Hudson Furnishing')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative text-white d-flex align-items-center justify-content-center" style="min-height: 65vh; overflow: hidden;">
    <!-- Carousel nền -->
    <div id="heroCarousel" class="carousel slide carousel-fade position-absolute top-0 start-0 w-100 h-100" data-bs-ride="carousel" data-bs-pause="hover">
        <div class="carousel-inner h-100">
            @if($carousels->count() > 0)
                @foreach($carousels as $index => $carousel)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img 
                            src="{{ asset('storage/carousels/' . $carousel->image) }}" 
                            class="d-block w-100 h-100" 
                            alt="{{ $carousel->title }}"
                            style="object-fit: cover; max-height: 65vh; object-position: center;"
                        >
                        
                        <!-- Carousel Content Overlay -->
                        @if($carousel->title || $carousel->description || $carousel->button_text)
                            <div class="carousel-caption d-none d-md-block">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 text-center">
                                            @if($carousel->title)
                                                <h1 class="display-4 fw-bold mb-4 bounce-in">{{ $carousel->title }}</h1>
                                            @endif
                                            @if($carousel->description)
                                                <p class="lead mb-4 slide-in">{{ $carousel->description }}</p>
                                            @endif
                                            @if($carousel->button_text && $carousel->button_url)
                                                <a href="{{ $carousel->button_url }}" class="btn btn-secondary btn-lg bounce-in">
                                                    {{ $carousel->button_text }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <!-- Fallback to default content if no carousels -->
                <div class="carousel-item active">
                    <img 
                        src="{{ asset('images/HF_Home_1.jpg') }}" 
                        class="d-block w-100 h-100" 
                        alt="Hudson Furnishing"
                        style="object-fit: cover; max-height: 65vh; object-position: center;"
                    >
                    <div class="carousel-caption d-none d-md-block">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <h1 class="display-4 fw-bold mb-4 bounce-in">Biến Đổi Không Gian Của Bạn!</h1>
                                    <p class="lead mb-4 slide-in">
                                        Khám phá bộ sưu tập nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn.
                                        Chất lượng thủ công gặp gỡ thiết kế hiện đại.
                                    </p>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg bounce-in">Khám Phá Ngay!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Nút điều hướng -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

    <!-- Dấu chấm dưới -->
    @if($carousels->count() > 1)
        <div class="carousel-indicators">
            @foreach($carousels as $index => $carousel)
                <button type="button" 
                        data-bs-target="#heroCarousel" 
                        data-bs-slide-to="{{ $index }}" 
                        aria-label="Slide {{ $index + 1 }}"
                        {{ $index === 0 ? 'class="active" aria-current="true"' : '' }}>
                </button>
            @endforeach
        </div>
    @endif

    <!-- Lớp phủ mờ (overlay để chữ nổi bật hơn) -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(47, 62, 70, 0.1);"></div>
</section>


<!-- Featured Products Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Sản Phẩm Nổi Bật</h2>
            <p class="lead text-muted">Khám phá những mẫu thiết kế được yêu thích nhất</p>
        </div>
        
        <div class="row justify-content-center">
            @forelse($featuredProducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4 d-flex">
                    <div class="card h-100 w-100">
                        @if($product->images->count() > 0)
                            <img src="{{ asset('uploads/' . $product->images->first()->url) }}" 
                                 class="card-img-top" 
                                 alt="{{ $product->name }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/placeholder.jpg') }}" 
                                 class="card-img-top" 
                                 alt="{{ $product->name }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h6 class="card-title product-name-home">
                                <a href="{{ route('product.show', $product->slug) }}" 
                                   style="color: #8B0000 !important; text-decoration: none !important; background: none !important; border: none !important; outline: none !important; box-shadow: none !important; font-weight: 600 !important; font-size: 1rem !important; display: inline !important; cursor: pointer !important;">
                                    {{ $product->name }}
                                </a>
                            </h6>
                            <p class="card-text text-muted">{{ $product->section->name }}</p>
                            <div class="d-flex justify-content-between align-items-end">
                                <span class="fw-bold text-primary fs-5">@price($product->price)</span>
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-xs btn-outline-primary">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <h4>Không có sản phẩm nổi bật</h4>
                        <p class="text-muted">Quay lại sau để xem các sản phẩm mới!</p>
                    </div>
                </div>
            @endforelse
        </div>
                
        <div class="col-12 text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Xem Tất Cả Sản Phẩm</a>
        </div>
    </div>
</section>

<!-- Products by Category Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Sản Phẩm Theo Danh Mục</h2>
            <p class="lead text-muted">Khám phá sản phẩm theo danh mục yêu thích</p>
        </div>
        
        <!-- Category Filter -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="category-filter">
                    <form method="GET" action="{{ route('home') }}" id="categoryFilterForm">
                        <div class="input-group input-group-lg">
                            <label class="input-group-text" for="categorySelect">
                                <i class="fas fa-filter me-2"></i>Chọn danh mục:
                            </label>
                            <select class="form-select" id="categorySelect" name="category_id" onchange="document.getElementById('categoryFilterForm').submit();">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($allCategories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ $selectedCategory && $selectedCategory->id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->products_count ?? $category->products()->where('status', 'active')->count() }} sản phẩm)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        @if($selectedCategory && $categoryProducts->count() > 0)
            <div class="mb-4">
                <div class="category-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="h2 fw-bold mb-1">{{ $selectedCategory->name }}</h3>
                            <p class="mb-0">{{ $selectedCategory->section->name }} • {{ $categoryProducts->count() }} sản phẩm</p>
                        </div>
                        <a href="{{ route('products.index', ['category' => $selectedCategory->id]) }}" class="btn btn-outline-primary btn-lg">
                            Xem Tất Cả <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                
                <div class="row">
                    @foreach($categoryProducts as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 product-card">
                                @if($product->primary_image)
                                    <img src="{{ asset('uploads/' . $product->primary_image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @elseif($product->images->count() > 0)
                                    <img src="{{ asset('uploads/' . $product->images->first()->url) }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @endif
                                
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title product-name-home mb-2">
                                        <a href="{{ route('product.show', $product->slug) }}" 
                                           style="color: #8B0000 !important; text-decoration: none !important;">
                                            {{ $product->name }}
                                        </a>
                                    </h6>
                                    <p class="card-text text-muted small mb-2">{{ $product->section->name }}</p>
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold text-primary fs-5">@price($product->price)</span>
                                            @if($product->sale_price && $product->sale_price < $product->price)
                                                <span class="badge bg-danger">Sale</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('product.show', $product->slug) }}" 
                                           class="btn btn-outline-primary btn-sm w-100">
                                            Xem Chi Tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @elseif($selectedCategory)
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4>Không có sản phẩm nào</h4>
                <p class="text-muted">Danh mục "{{ $selectedCategory->name }}" hiện tại chưa có sản phẩm nào.</p>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-filter fa-3x text-muted mb-3"></i>
                <h4>Chọn danh mục để xem sản phẩm</h4>
                <p class="text-muted">Vui lòng chọn một danh mục từ dropdown bên trên để xem sản phẩm.</p>
            </div>
        @endif
    </div>
</section>

<!-- Offers Section -->
@if($activeOffers->count() > 0)
<section class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Khuyến Mãi Đặc Biệt</h2>
            <p class="lead text-muted">Đừng bỏ lỡ những ưu đãi hấp dẫn</p>
        </div>
        
        <div class="row">
            @foreach($activeOffers as $offer)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        @if($offer->image)
                            <img src="{{ asset('uploads/offers/' . $offer->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $offer->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h5 class="card-title">{{ $offer->title }}</h5>
                            <p class="card-text">{{ $offer->description }}</p>
                            <div class="card-badge-footer mt-auto">
                                <span class="badge bg-danger fs-6">
                                    @if($offer->discount_type == 'percentage')
                                        {{ \App\Helpers\PriceHelper::formatPercentage($offer->discount_value) }} OFF
                                    @else
                                        {{ number_format($offer->discount_value, 0, ',', ',') }} ₫ OFF
                                    @endif
                                </span>
                                <small class="text-muted text-end">
                                    Còn lại: {{ $offer->end_date->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- About Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="{{ asset('images/HF_About_1.jpg') }}" alt="About Hudson Furnishing" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">Về Hudson Furnishing</h2>
                <p class="lead mb-4">Với hơn 10 năm kinh nghiệm trong lĩnh vực nội thất, chúng tôi cam kết mang đến những sản phẩm chất lượng cao với thiết kế tinh tế và hiện đại.</p>
                <p class="mb-4">Từ phòng khách sang trọng đến phòng ngủ ấm cúng, từ văn phòng chuyên nghiệp đến không gian ngoài trời thoải mái - chúng tôi có tất cả những gì bạn cần để tạo nên không gian sống hoàn hảo.</p>
                <a href="{{ route('about') }}" class="btn btn-outline-primary btn-lg">Tìm Hiểu Thêm</a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Force override styling cho tất cả product name links
    const productNameLinks = document.querySelectorAll('.product-name a, .product-name-home a');
    productNameLinks.forEach(function(link) {
        link.style.setProperty('color', '#8B0000', 'important');
        link.style.setProperty('text-decoration', 'none', 'important');
        link.style.setProperty('background', 'none', 'important');
        link.style.setProperty('border', 'none', 'important');
        link.style.setProperty('outline', 'none', 'important');
        link.style.setProperty('box-shadow', 'none', 'important');
        link.style.setProperty('font-weight', '600', 'important');
        link.style.setProperty('display', 'inline', 'important');
        link.style.setProperty('cursor', 'pointer', 'important');
    });
});
</script>
@endsection

@push('styles')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 60vh;
}

.fade-in {
    animation: fadeIn 1s ease-in;
}

.bounce-in {
    animation: bounceIn 1s ease-out;
}

.slide-in {
    animation: slideIn 1s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes bounceIn {
    0% { transform: scale(0.3); opacity: 0; }
    50% { transform: scale(1.05); }
    70% { transform: scale(0.9); }
    100% { transform: scale(1); opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateX(-100px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

/* Products by Category Styles */
.product-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 15px;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.product-card .card-img-top {
    transition: all 0.3s ease;
}

.product-card:hover .card-img-top {
    transform: scale(1.05);
}

.product-card .card-body {
    padding: 1.25rem;
}

.product-card .btn {
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.product-card .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,123,255,0.3);
}

.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.75em;
    border-radius: 20px;
}

.category-section {
    margin-bottom: 4rem;
}

.category-title {
    position: relative;
    padding-bottom: 1rem;
    margin-bottom: 2rem;
}

.category-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 2px;
}

/* Category Filter Styles */
.category-filter {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.input-group-text {
    background: linear-gradient(135deg, var(--primary-color), #4a7c8a);
    color: white;
    border: none;
    font-weight: 600;
    border-radius: 10px 0 0 10px;
}

.form-select {
    border: 2px solid #e9ecef;
    border-left: none;
    border-radius: 0 10px 10px 0;
    font-weight: 500;
    transition: all 0.3s ease;
}

.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(51, 92, 103, 0.25);
}

.category-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border-left: 5px solid var(--primary-color);
}

.category-header h3 {
    margin-bottom: 0.5rem;
    color: var(--primary-color);
}

.category-header p {
    color: #6c757d;
    margin-bottom: 0;
}
</style>
@endpush