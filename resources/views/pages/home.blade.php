@extends('layouts.guest')

@section('title', 'Trang Chủ - Hudson Furnishing')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative text-white d-flex align-items-center justify-content-center" style="min-height: 65vh; overflow: hidden;">
    <!-- Carousel nền -->
    <div id="heroCarousel" class="carousel slide carousel-fade position-absolute top-0 start-0 w-100 h-100" data-bs-ride="carousel" data-bs-pause="hover">
        <div class="carousel-inner h-100">            
           @foreach (['hero_image_1', 'hero_image_2', 'hero_image_3'] as $index => $key)
                @if (!empty($siteSettings[$key]))
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img 
                            src="{{ Storage::url($siteSettings[$key]) }}" 
                            class="d-block w-100 h-100" 
                            alt="Hero Image {{ $index + 1 }}"
                            style="object-fit: cover; max-height: 65vh; object-position: center ;"
                        >
                    </div>
                @endif
            @endforeach           
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
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <!-- Lớp phủ mờ (overlay để chữ nổi bật hơn) -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(47, 62, 70, 0.1);"></div>

    <!-- Nội dung chữ -->
    <div class="container position-absolute bottom-0 start-50 translate-middle-x text-center z-2 mb-5">
        <h1 class="display-4 fw-bold mb-4 bounce-in">Biến Đổi Không Gian Của Bạn!</h1>
        <p class="lead mb-4 slide-in">
            Khám phá bộ sưu tập nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn.
            Chất lượng thủ công gặp gỡ thiết kế hiện đại.
        </p>
        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg bounce-in">Khám Phá Ngay!</a>
    </div>
</section>


<!-- Featured Products Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Sản Phẩm Nổi Bật</h2>
            <p class="lead text-muted">Khám phá những mẫu thiết kế được yêu thích nhất</p>
        </div>
        
        <div class="row">
            @forelse($featuredProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
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
                
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex align-content-center text-center mt-4 ">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Xem Tất Cả Sản Phẩm</a>
        </div>
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
</style>
@endpush