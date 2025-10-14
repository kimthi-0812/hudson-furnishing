<div class="product-card mb-4 fade-in d-flex flex-column" data-product-id="{{ $product->id }}">
    <div class="product-image position-relative">
        @if($product->images->count() > 0)
    @php
        $image = $product->images->count() > 1 
            ? $product->images->random() 
            : $product->images->first();
    @endphp
    <img src="{{ asset('storage/uploads/' . $product->images->first()->url) }}" 
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
            <a href="{{ route('product.show', $product->slug) }}" 
               style="color: #8B0000 !important; text-decoration: none !important; background: none !important; border: none !important; outline: none !important; box-shadow: none !important; font-weight: 600 !important; font-size: 1.1rem !important; display: inline !important; cursor: pointer !important;">
                {{ $product->name }}
            </a>
        </h5>
        
        <!-- Stock status -->
        <div class="product-stock mb-2">
            @if($product->stock > 0)
                <span class="text-success small">
                    <i class="fas fa-check-circle me-1"></i>
                    Còn Hàng ({{ $product->stock }})
                </span>
            @else
                <span class="text-warning small">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Tạm thời hết hàng
                </span>
            @endif
        </div>
        
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
            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary">
                Xem Chi Tiết
            </a>
        </div>
    </div>
</div>

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
