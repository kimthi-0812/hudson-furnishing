@extends('layouts.app')

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
                                <img src="{{ asset('uploads/' . $image->url) }}" 
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
                    <span class="h3 text-danger">{{ number_format($product->sale_price, 0, ',', ',') }} ₫</span>
                    <span class="h5 text-muted text-decoration-line-through ms-2">{{ number_format($product->price, 0, ',', ',') }} ₫</span>
                @else
                    <span class="h3">{{ number_format($product->price, 0, ',', ',') }} ₫</span>
                @endif
            </div>
            
            <div class="product-description mb-4">
                <p>{{ $product->description }}</p>
            </div>
            
            <div class="product-stock mb-4">
                @if($product->stock > 0)
                    <span class="text-success">
                        <i class="fas fa-check-circle me-1"></i>
                        In Stock ({{ $product->stock }} available)
                    </span>
                @else
                    <span class="text-danger">
                        <i class="fas fa-times-circle me-1"></i>
                        Out of Stock
                    </span>
                @endif
            </div>
            
            <div class="product-actions mb-4">
                <button class="btn btn-primary btn-lg me-2" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="fas fa-shopping-cart me-1"></i>
                    Add to Cart
                </button>
                <button class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-heart me-1"></i>
                    Add to Wishlist
                </button>
            </div>
        </div>
    </div>
    
    <!-- Reviews Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h3>Customer Reviews</h3>
            
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
                                    <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No reviews yet. Be the first to review this product!</p>
            @endif
            
            <!-- Review Form -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5>Write a Review</h5>
                    <form id="reviewForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating *</label>
                            <select class="form-select" id="rating" name="rating" required>
                                <option value="">Select Rating</option>
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment *</label>
                            <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3>Related Products</h3>
                <div class="row">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="col-lg-3 col-md-6 mb-4">
                            @include('components.product-card', ['product' => $relatedProduct])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
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
