<div class="product-card mb-4 fade-in d-flex flex-column" data-product-id="{{ $product->id }}">
    <div class="product-image position-relative">
        @if($product->images->count() > 0)
            <img src="{{ asset('uploads/' . $product->images->first()->url) }}" 
                 alt="{{ $product->name }}" class="img-fluid">
        @else
            @php
                $randomImage = $product->images->random();
            @endphp
            <img src="{{ asset('uploads/' . $randomImage->url) }}" 
                 alt="{{ $product->name }}" class="img-fluid">
        @endif
        @if($product->sale_price)
            <span class="position-absolute top-0 end-0 price-badge">Giảm Giá!</span>
        @endif
        @if($product->featured)
            <span class="position-absolute top-0 start-0 badge badge-secondary">Nổi Bật</span>
        @endif
    </div>
    <div class="product-info p-3 d-flex flex-column flex-grow-1">
        <h5 class="product-name mb-2">{{ $product->name }}</h5>
        <div class="card-badge-footer mt-auto">
            <div class="product-price m-0">
                @if($product->sale_price)
                    <span class="sale-price">{{ number_format($product->sale_price, 0, ',', ',') }} ₫</span>
                    <span class="original-price">{{ number_format($product->price, 0, ',', ',') }} ₫</span>
                @else
                    <span class="price">{{ number_format($product->price, 0, ',', ',') }} ₫</span>
                @endif
            </div>
            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm">
                Xem Chi Tiết
            </a>
        </div>
    </div>
</div>
