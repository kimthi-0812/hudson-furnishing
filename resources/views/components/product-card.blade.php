<div class="product-card mb-4 fade-in d-flex flex-column" data-product-id="{{ $product->id }}">
    <div class="product-image position-relative">
        @if($product->images->count() > 0)
    @php
        $image = $product->images->count() > 1 
            ? $product->images->random() 
            : $product->images->first();
    @endphp
    <img src="{{ asset('uploads/' . $image->url) }}" 
         alt="{{ $product->name }}" class="img-fluid">
@else
    <img src="{{ asset('images/default.jpg') }}" 
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
        <h5 class="product-name mb-2" title="{{ $product->name }}">
            {{ $product->name }}
        </h5>
        
        <!-- Price section moved to bottom -->
        <div class="product-price-section mt-auto mb-3">
            @if($product->sale_price)
                <div class="sale-price-large">{{ number_format($product->sale_price, 0, ',', ',') }}<span class="currency">₫</span></div>
                <div class="original-price-small">{{ number_format($product->price, 0, ',', ',') }}<span class="currency">₫</span></div>
            @else
                <div class="price-large">{{ number_format($product->price, 0, ',', ',') }}<span class="currency">₫</span></div>
            @endif
        </div>
        
        <!-- Button at the very bottom -->
        <div class="d-grid gap-2">
            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary">
                Xem Chi Tiết
            </a>
        </div>
    </div>
</div>
