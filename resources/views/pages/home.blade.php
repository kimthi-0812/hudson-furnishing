@extends('layouts.app')

@section('title', 'Hudson Furnishing - Cửa hàng nội thất cao cấp')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-white py-5 fade-in">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4 bounce-in">Biến Đổi Không Gian Của Bạn</h1>
                <p class="lead mb-4 slide-in">Khám phá bộ sưu tập nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn. Chất lượng thủ công gặp gỡ thiết kế hiện đại.</p>
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg bounce-in">Mua Ngay</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/HF_Home_1.jpg') }}" alt="Premium Furniture" class="img-fluid rounded shadow-lg fade-in">
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 section-title">Sản Phẩm Nổi Bật</h2>
        <div class="row">
            @forelse($featuredProducts as $product)
                <div class="col-lg-3 col-md-6 mb-4 fade-in">
                    @include('components.product-card', ['product' => $product])
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <h4 class="text-primary">Chưa có sản phẩm nổi bật</h4>
                        <p class="text-muted">Hãy quay lại sớm để xem bộ sưu tập mới nhất của chúng tôi!</p>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="text-center">
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Xem Tất Cả Sản Phẩm</a>
        </div>
    </div>
</section>

<!-- Active Offers -->
@if($activeOffers->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Special Offers</h2>
        <div class="row">
            @foreach($activeOffers as $offer)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        @if($offer->image)
                            <img src="{{ asset('uploads/offers/' . $offer->image) }}" class="card-img-top" alt="{{ $offer->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-danger">{{ $offer->title }}</h5>
                            <p class="card-text">{{ $offer->description }}</p>
                            <small class="text-muted">
                                Valid until: {{ $offer->end_date->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Visitor Counter -->
<div class="visitor-counter bg-dark text-white py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <small>Total Visitors: <span id="visitor-count">0</span></small>
            </div>
            <div class="col-md-6 text-end">
                <small id="current-time"></small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Update visitor counter
document.addEventListener('DOMContentLoaded', function() {
    fetch('/visitor-stats', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update visitor count in footer as well
            const footerVisitorCount = document.querySelector('footer #visitor-count');
            if (footerVisitorCount) {
                footerVisitorCount.textContent = data.total_visits;
            }
        }
    });

    // Update time
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = now.toLocaleString();
    }
    updateTime();
    setInterval(updateTime, 1000);
});
</script>
@endpush
