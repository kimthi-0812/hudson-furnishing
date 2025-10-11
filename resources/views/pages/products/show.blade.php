@extends('layouts.guest')

@section('title', $product->name . ' - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            @if($product->images->count() > 0)
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($product->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('uploads/products/' . $image->url) }}" 
                                     class="d-block w-100" 
                                     alt="{{ $image->alt_text }}"
                                     style="height: 400px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    @if($product->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            @else
                <img src="{{ asset('images/HF_Product_1.jpg') }}" 
                     alt="{{ $product->name }}" 
                     class="img-fluid"
                     style="height: 400px; object-fit: cover;">
            @endif
        </div>
        
        <div class="col-lg-6">
            <h1 class="h2 mb-3">{{ $product->name }}</h1>
            
            <div class="product-meta mb-3">
                <span class="badge bg-secondary me-2">{{ $product->section->name }}</span>
                <span class="badge bg-info me-2">{{ $product->category->name }}</span>
                <span class="badge bg-warning me-2">{{ $product->brand->name }}</span>
                <span class="badge bg-success">{{ $product->material->name }}</span>
            </div>
            
            <div class="product-price mb-3">
                @if($product->sale_price)
                    <div class="sale-price-display" style="display: flex; flex-direction: column; gap: 0.25rem;">
                        <div class="sale-price-large" style="color: #8B0000; font-weight: 600; font-size: 2rem; line-height: 1.2; white-space: nowrap; display: block;">{{ number_format($product->sale_price, 0, ',', ',') }}<span class="currency" style="font-size: 0.9em; margin-left: 2px; white-space: nowrap;">₫</span></div>
                        <div class="original-price-small" style="color: #6c757d; font-size: 1.2rem; text-decoration: line-through; white-space: nowrap; line-height: 1.2; display: block;">{{ number_format($product->price, 0, ',', ',') }}<span class="currency" style="font-size: 0.9em; margin-left: 2px; white-space: nowrap;">₫</span></div>
                    </div>
                @else
                    <div class="price-display" style="display: flex; flex-direction: column;">
                        <div class="price-large" style="color: #8B0000; font-weight: 600; font-size: 2rem; line-height: 1.2; white-space: nowrap; display: block;">{{ number_format($product->price, 0, ',', ',') }}<span class="currency" style="font-size: 0.9em; margin-left: 2px; white-space: nowrap;">₫</span></div>
                    </div>
                @endif
            </div>
            
            <div class="product-description mb-4">
                <p>{{ $product->description }}</p>
            </div>
            
            <div class="product-stock mb-4">
                @if($product->stock > 0)
                    <span class="text-success">
                        <i class="fas fa-check-circle me-1"></i>
                        Có Sẵn ({{ $product->stock }} sản phẩm)
                    </span>
                @else
                    <span class="text-warning">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        Sản phẩm tạm thời hết hàng
                    </span>
                @endif
            </div>
            
            <div class="product-actions mb-4">
                <button class="btn btn-primary btn-lg me-2" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="fas fa-shopping-cart me-1"></i>
                    Thêm Vào Giỏ Hàng
                </button>
                <button class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-heart me-1"></i>
                    Thêm Vào Danh Sách Yêu Thích
                </button>
            </div>
        </div>
    </div>
    
    <!-- Reviews Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h3>Đánh Giá Khách Hàng</h3>
            
            @if($product->reviews->count() > 0)
                <div class="row">
                    @foreach($product->reviews as $review)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="card-title">{{ $review->name }}</h6>
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $review->comment }}</p>
                                    <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Không có đánh giá nào. Hãy là người đầu tiên đánh giá sản phẩm này!</p>
            @endif
            
            <!-- Review Form -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5>Viết Đánh Giá</h5>
                    <form id="reviewForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Tên *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi Đánh Giá</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ route("reviews.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            this.reset();
        } else {
            alert('Error submitting review. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error submitting review. Please try again.');
    });
});
</script>
@endpush
