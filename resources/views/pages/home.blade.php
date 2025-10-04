@extends('layouts.guest')

@section('title', 'Trang Chủ - Hudson Furnishing')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-white py-5 fade-in" style="background-color: #2f3e46 !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4 bounce-in">Biến Đổi Không Gian Của Bạn!</h1>
                <p class="lead mb-4 slide-in">Khám phá bộ sưu tập nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn. Chất lượng thủ công gặp gỡ thiết kế hiện đại.</p>
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg bounce-in">Mua Ngay!</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/HF_Home_1.jpg') }}" alt="Premium Furniture" class="img-fluid rounded shadow-lg fade-in">
            </div>
        </div>
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
                            <h6 class="card-title">{{ $product->name }}</h6>
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
        
        <div class="text-center mt-4">
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
                    <div class="card h-100">
                        @if($offer->image)
                            <img src="{{ asset('uploads/offers/' . $offer->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $offer->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $offer->title }}</h5>
                            <p class="card-text">{{ $offer->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-danger fs-6">
                                    @if($offer->discount_type == 'percentage')
                                        {{ $offer->discount_value }}% OFF
                                    @else
                                        ${{ number_format($offer->discount_value, 2) }} OFF
                                    @endif
                                </span>
                                <small class="text-muted">
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