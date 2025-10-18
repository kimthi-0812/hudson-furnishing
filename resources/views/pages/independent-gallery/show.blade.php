@extends('layouts.guest')

@section('title', $gallery->title . ' - Thư Viện Hình Ảnh - Hudson Furnishing')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3 bg-light">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('independent-gallery.index') }}">Thư viện</a></li>
            <li class="breadcrumb-item active">{{ $gallery->title }}</li>
        </ol>
    </div>
</nav>

<!-- Gallery Detail -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Image -->
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-body p-0">
                        <div class="position-relative">
                            <img src="{{ asset('storage/gallery/' . $gallery->image) }}" 
                                 class="img-fluid w-100" 
                                 alt="{{ $gallery->title }}"
                                 style="max-height: 600px; object-fit: cover;">
                            
                            @if($gallery->is_primary)
                                <span class="position-absolute top-0 end-0 badge bg-warning m-3">
                                    <i class="fas fa-star"></i> Hình ảnh nổi bật
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Info -->
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>Thông tin hình ảnh
                        </h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $gallery->title }}</h4>
                        
                        @if($gallery->description)
                            <div class="mb-3">
                                <h6 class="text-muted">Mô tả:</h6>
                                <p class="card-text">{{ $gallery->description }}</p>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <h6 class="text-muted">Ngày tạo:</h6>
                            <p class="card-text">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $gallery->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <h6 class="text-muted">Cập nhật lần cuối:</h6>
                            <p class="card-text">
                                <i class="fas fa-clock me-1"></i>
                                {{ $gallery->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('contact.index') }}" class="btn btn-primary">
                                <i class="fas fa-envelope me-2"></i>Liên hệ để biết thêm
                            </a>
                            <a href="{{ route('independent-gallery.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Quay lại thư viện
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Galleries -->
        @if($relatedGalleries->count() > 0)
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="mb-4">
                        <i class="fas fa-images me-2"></i>Hình ảnh liên quan
                    </h4>
                </div>
                
                @foreach($relatedGalleries as $relatedGallery)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('storage/gallery/' . $relatedGallery->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $relatedGallery->title }}"
                                     style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                                
                                @if($relatedGallery->is_primary)
                                    <span class="position-absolute top-0 end-0 badge bg-warning m-2">
                                        <i class="fas fa-star"></i>
                                    </span>
                                @endif
                                
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                     style="background: rgba(0,0,0,0.7); opacity: 0; transition: opacity 0.3s ease;">
                                    <a href="{{ route('independent-gallery.show', $relatedGallery) }}" 
                                       class="btn btn-light btn-sm">
                                        <i class="fas fa-eye me-1"></i>Xem
                                    </a>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <h6 class="card-title">{{ $relatedGallery->title }}</h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $relatedGallery->created_at->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>
.card:hover img {
    transform: scale(1.05);
}

.card:hover .position-absolute[style*="opacity: 0"] {
    opacity: 1 !important;
}

.card {
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>
@endsection
