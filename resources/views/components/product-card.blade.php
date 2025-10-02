<div class="product-card mb-4 fade-in d-flex flex-column" data-product-id="{{ $product->id }}">
    <div class="product-image position-relative">
        @if($product->images->count() > 0)
            <img src="{{ asset('uploads/' . $product->images->first()->url) }}" 
                 alt="{{ $product->name }}" class="img-fluid">
        @else
            @php
                // Tạo danh sách hình ảnh mẫu từ thư mục images
                $sampleImages = [
                    'HF_Home_1.jpg',
                    'HF_About_1.jpg',
                    'HF_Home_ProductCard_1.jpg',
                    'placeholder.jpg'
                ];
                // Sử dụng ID sản phẩm để chọn hình ảnh nhất quán
                $imageIndex = $product->id % count($sampleImages);
                $selectedImage = $sampleImages[$imageIndex];
            @endphp
            <img src="{{ asset('images/' . $selectedImage) }}" 
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
        <div class="product-price mb-3">
            @if($product->sale_price)
                <span class="sale-price">{{ number_format($product->sale_price, 0, ',', ',') }} ₫</span>
                <span class="original-price">{{ number_format($product->price, 0, ',', ',') }} ₫</span>
            @else
                <span class="price">{{ number_format($product->price, 0, ',', ',') }} ₫</span>
            @endif
        </div>
        <div class="d-grid gap-2 mt-auto">
            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary">
                Xem Chi Tiết
            </a>
            <button class="btn btn-outline-secondary btn-sm" 
                    onclick="addToWishlist({{ $product->id }})">
                Thêm Yêu Thích
            </button>
        </div>
    </div>
</div>
