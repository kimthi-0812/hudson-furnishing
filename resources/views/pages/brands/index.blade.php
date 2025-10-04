@extends('layouts.guest')

@section('title', 'Thương Hiệu - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Thương Hiệu</h1>
        <p class="lead text-muted">Khám Phá Thương Hiệu Mà Chúng Tôi Tin Tưởng Và Yêu Thích</p>
    </div>
    
    <div class="row">
        @forelse($brands as $brand)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 text-center">
                    @if($brand->logo)
                        <div class="card-body">
                            <img src="{{ asset('uploads/brands/' . $brand->logo) }}" 
                                 alt="{{ $brand->name }}" 
                                 class="img-fluid mb-3"
                                 style="max-height: 100px;">
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $brand->name }}</h5>
                        @if($brand->description)
                            <p class="card-text text-muted">{{ Str::limit($brand->description, 100) }}</p>
                        @endif
                        <a href="{{ route('products.index', ['brand' => $brand->id]) }}" 
                           class="btn btn-outline-primary btn-sm">
                            Xem Sản Phẩm
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                    <h4>Không có thương hiệu nào</h4>
                    <p class="text-muted">Kiểm tra lại sau để xem thương hiệu của chúng tôi!</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
