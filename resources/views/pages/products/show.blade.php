@extends('layouts.guest')

@section('title', $product->name . ' - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6">
            @if($product->images->count() > 0)
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($product->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/uploads/' . $image->url) }}" 
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

        <!-- Product Info -->
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
                    <div class="sale-price-display d-flex flex-column gap-1">
                        <div class="sale-price-large text-danger fw-semibold fs-3">{{ number_format($product->sale_price, 0, ',', ',') }}₫</div>
                        <div class="original-price-small text-muted text-decoration-line-through fs-5">{{ number_format($product->price, 0, ',', ',') }}₫</div>
                    </div>
                @else
                    <div class="price-display d-flex flex-column">
                        <div class="price-large text-danger fw-semibold fs-3">{{ number_format($product->price, 0, ',', ',') }}₫</div>
                    </div>
                @endif
            </div>
            <div class="product-description mb-4">
                <p>{{ $product->description }}</p>
            </div>
            <div class="product-stock mb-4">
                @if($product->stock > 0)
                    <span class="text-success"><i class="fas fa-check-circle me-1"></i>Có Sẵn ({{ $product->stock }} sản phẩm)</span>
                @else
                    <span class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>Sản phẩm tạm thời hết hàng</span>
                @endif
            </div>
            <div class="product-actions mb-4">                
                <button class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-heart me-1"></i>Thêm Vào Danh Sách Yêu Thích
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
                    <form id="reviewForm" method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Tên *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Nội dung *</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3">{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(session('status'))
                                <div class="alert alert-success">{{ session('status') }}</div>
                            @endif

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Đánh Giá *</label>
                            <div class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star star" data-value="{{ $i }}"></i>
                                @endfor
                                <input type="hidden" id="rating-value" name="rating" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi Đánh Giá</button>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.star-rating .star {
    font-size: 1rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
}

.star-rating .star.hover,
.star-rating .star.selected {
    color: #ffc107;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-rating .star');
    const ratingInput = document.getElementById('rating-value');

    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            const val = parseInt(star.getAttribute('data-value'));
            stars.forEach(s => s.classList.remove('hover'));
            stars.forEach(s => {
                if (parseInt(s.getAttribute('data-value')) <= val) s.classList.add('hover');
            });
        });

        star.addEventListener('mouseout', () => {
            stars.forEach(s => s.classList.remove('hover'));
        });

        star.addEventListener('click', () => {
            const val = parseInt(star.getAttribute('data-value'));
            ratingInput.value = val;
            stars.forEach(s => s.classList.remove('selected'));
            stars.forEach(s => {
                if (parseInt(s.getAttribute('data-value')) <= val) s.classList.add('selected');
            });
        });
    });
});
</script>
@endpush
