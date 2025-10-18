@extends('layouts.guest')

@section('title', 'Thư Viện Hình Ảnh - Hudson Furnishing')

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-5 fw-bold mb-3">Thư Viện Hình Ảnh</h1>
                <p class="lead text-muted">Khám phá bộ sưu tập hình ảnh nội thất đẹp mắt</p>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-4 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="{{ route('independent-gallery.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" 
                               class="form-control" 
                               name="search" 
                               placeholder="Tìm kiếm hình ảnh..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-5">
    <div class="container">
        @if($galleries->count() > 0)
            <div class="row">
                @foreach($galleries as $gallery)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm gallery-item">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('storage/gallery/' . $gallery->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $gallery->title }}"
                                     style="height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                                
                                @if($gallery->is_primary)
                                    <span class="position-absolute top-0 end-0 badge bg-warning m-2">
                                        <i class="fas fa-star"></i>
                                    </span>
                                @endif
                                
                                <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                     style="background: rgba(0,0,0,0.7); opacity: 0; transition: opacity 0.3s ease;">
                                    <a href="{{ route('independent-gallery.show', $gallery) }}" 
                                       class="btn btn-light btn-sm">
                                        <i class="fas fa-eye me-1"></i>Xem chi tiết
                                    </a>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <h6 class="card-title">{{ $gallery->title }}</h6>
                                @if($gallery->description)
                                    <p class="card-text text-muted small">
                                        {{ Str::limit($gallery->description, 100) }}
                                    </p>
                                @endif
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $gallery->created_at->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="row">
                <div class="col-12">
                    {{ $galleries->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Không tìm thấy hình ảnh nào</h5>
                <p class="text-muted">
                    @if(request('search'))
                        Không có hình ảnh nào phù hợp với từ khóa "{{ request('search') }}".
                    @else
                        Chưa có hình ảnh nào trong thư viện.
                    @endif
                </p>
                @if(request('search'))
                    <a href="{{ route('independent-gallery.index') }}" class="btn btn-primary">
                        Xem tất cả hình ảnh
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

<style>
.gallery-item:hover img {
    transform: scale(1.05);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1 !important;
}

.gallery-item .card {
    transition: box-shadow 0.3s ease;
}

.gallery-item:hover .card {
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>
@endsection
