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
        <div class="product-price mb-3">
            @if($product->sale_price)
                <span class="sale-price">{{ number_format($product->sale_price, 0, ',', ',') }} ₫</span>
                <span class="original-price">{{ number_format($product->price, 0, ',', ',') }} ₫</span>
            @else
                <span class="price">{{ number_format($product->price, 0, ',', ',') }} ₫</span>
            @endif
        </div>
        <div class="d-grid gap-2 mt-auto">
            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary">
                Xem Chi Tiết
            </a>
        </div>
    </div>
</div>
