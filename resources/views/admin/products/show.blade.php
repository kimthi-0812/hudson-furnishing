@extends('layouts.admin')

@section('title', 'Chi Tiết Sản Phẩm - Hudson Furnishing')
@section('page-title', 'Chi Tiết Sản Phẩm')

@section('page-actions')
    <a href="{{ route('admin.products.index', $product) }}" class="btn btn-primary">
        <i class="fas fa-arrow-left me-2"></i>Quay Lại Sản Phẩm
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-light">Thông Tin Sản Phẩm</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ $product->name }}</h5>
                        <p class="text-muted">{{ $product->description }}</p>
                        
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
                        
                        <div class="product-stock mb-3">
                            @if($product->stock > 0)
                                <span class="text-success">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Còn Hàng ({{ $product->stock }} còn lại)
                                </span>
                            @else
                                <span class="text-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Sản phẩm tạm thời hết hàng
                                </span>
                            @endif
                        </div>
                        
                        <div class="product-status mb-3">
                            @php
                                    $options = \App\Helpers\StatusHelper::getStatusOptions();
                                    $status = $product->status;
                                @endphp
                                <span class="badge bg-{{ $options[$status]['class'] ?? 'warning' }}">
                                    {{ $options[$status]['label'] ?? ucfirst($status) }}
                                </span>
                            @if($product->featured)
                                <span class="badge bg-warning ms-2">Nổi Bật</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        @if($product->images->count() > 0)
                            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($product->images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/uploads/' . $image->url) }}" 
                                                 class="d-block w-100" 
                                                 alt="{{ $image->alt_text }}"
                                                 style="height: 300px; object-fit: cover;">
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
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reviews Section -->
        @if($product->reviews->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-light">Đánh Giá Khách Hàng ({{ $product->reviews->count() }})</h6>
                </div>
                <div class="card-body">
                    @foreach($product->reviews as $review)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0">{{ $review->name }}</h6>
                                <div class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="mb-2">{{ $review->comment }}</p>
                            <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                            <div class="mt-2">
                                <span class="badge bg-{{ $review->approved ? 'success' : 'warning' }}">
                                    {{ $review->approved ? 'Đã Duyệt' : 'Đang Chờ' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-light">Thống Kê Sản Phẩm</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border-end">
                            <h4 class="text-primary">{{ $product->reviews->count() }}</h4>
                            <small class="text-muted">Đánh Giá</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <h4 class="text-success">{{ number_format($product->average_rating, 1) }}</h4>
                        <small class="text-muted">Đánh Giá Trung Bình</small>
                    </div>
                </div>
                
                <div class="mt-3">
                    <small class="text-muted">Tạo: {{ $product->created_at->format('d/m/Y') }}</small><br>
                    <small class="text-muted">Cập Nhật: {{ $product->updated_at->format('d/m/Y') }}</small>
                </div>
            </div>
        </div>
        
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-light">Hành Động Nhanh</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Chỉnh Sửa Sản Phẩm
                    </a>
                    <a href="{{ route('product.show', $product) }}" class="btn btn-info" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Xem Trên Website
                    </a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                          class="d-inline form-confirm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Xóa Sản Phẩm
                        </button>                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
