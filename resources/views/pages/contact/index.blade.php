@extends('layouts.guest')

@section('title', $product ? 'Liên Hệ Về ' . $product->name . ' - Hudson Furnishing' : 'Liên Hệ - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto border rounded p-4">
            <div class="text-center mb-5 ">
                <h1 class="display-4 fw-bold">
                    @if($product)
                        Liên Hệ Về {{ $product->name }}
                    @else
                        Liên Hệ
                    @endif
                </h1>
                <p class="lead text-muted">Chúng tôi sẵn sàng hỗ trợ bạn</p>
                @if($product)
                    <p>Quan tâm đến sản phẩm này? <span class="fw-bold">Liên hệ ngay để được tư vấn!</span></p>
                @else
                    <p>Tư vấn về nội thất và yêu cầu hướng dẫn đặt hàng? <span class="fw-bold">Liên hệ ngay!</span></p>
                @endif
            </div>
            
            @if($product)
                <!-- Product Info Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                @if($product->images->count() > 0)
                                    <img src="{{ asset('storage/uploads/' . $product->images->first()->url) }}" 
                                         alt="{{ $product->name }}"
                                         class="img-fluid rounded"
                                         style="height: 120px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                         style="height: 120px;">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted mb-1">
                                    <strong>Danh mục:</strong> {{ $product->category->name ?? 'N/A' }} | 
                                    <strong>Thương hiệu:</strong> {{ $product->brand->name ?? 'N/A' }}
                                </p>
                                <p class="card-text text-muted mb-1">
                                    <strong>Giá:</strong> 
                                    @if($product->sale_price && $product->sale_price < $product->price)
                                        <span class="text-decoration-line-through">{{ number_format($product->price) }} ₫</span>
                                        <span class="text-danger fw-bold">{{ number_format($product->sale_price) }} ₫</span>
                                    @else
                                        <span class="fw-bold">{{ number_format($product->price) }} ₫</span>
                                    @endif
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        {{ Str::limit($product->description, 150) }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    
                    <!--map-->
                    <div class="contact-map">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <strong>Bản đồ</strong>
                        @if(!empty($siteSettings['google_map']))
                        <div class="map-responsive">
                            <iframe src="{{ $siteSettings['google_map'] }}" width="800" height="800" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        @endif
                    </div>
                    <!--info-->
                    <div class="contact-info">
                        <!--address-->
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-3"></i>
                            <div>
                                <strong>Địa chỉ</strong><br>
                                {!! nl2br(e($siteSettings['contact_address'] ?? '36/5 Đường D5, Quận Bình Thạnh, TP.HCM')) !!}
                            </div>
                        </div>
                        <!--phone-->
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-phone text-primary me-3"></i>
                            <div>
                                <strong>Số Điện Thoại / Zalo</strong><br>
                                {{ $siteSettings['contact_phone'] ?? '+84 909 090 909' }}<br>
                            </div>
                        </div>
                        
                        <!--email-->
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <div>
                                <strong>Email</strong><br>
                                {{ $siteSettings['contact_email'] ?? 'info@hudsonfurnishing.com' }}
                            </div>
                        </div>
                        <!--time-->
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-clock text-primary me-3"></i>
                            <div>
                                <strong>Giờ Hoạt Động</strong><br>
                                {!! nl2br(e($siteSettings['business_hours'] ?? 'T2 - T7: 8:00 - 18:00')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--contact form-->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Phản Hồi Đến Chúng Tôi:</h4>
                            <form id="contactForm">
                                @csrf
                                @if($product)
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @endif
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ Tên *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số Điện Thoại</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Thông điệp *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required 
                                              placeholder="@if($product)Tôi đang quan tâm đến sản phẩm {{ $product->name }}...@else">Nhập thông điệp của bạn...@endif</textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100">
                                    @if($product)
                                        Gửi Yêu Cầu Tư Vấn
                                    @else
                                        Gửi Phản Hồi
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ route("contact.store") }}', {
    method: 'POST',
    body: formData,
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
        })
        .then(response => {
            if (response.status === 401) { // 401 = chưa đăng nhập
                alert('Vui lòng đăng nhập trước khi gửi phản hồi.');
                window.location.href = '{{ route("login") }}';
                return;
            }
            return response.json();
        })
        .then(data => {
            if (data && data.success) {
                alert(data.message);
                document.getElementById('contactForm').reset();
            } else if (data) {
                alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã có lỗi. Vui lòng thử lại.');
        });

});
</script>

<style>
    .map-responsive {
    overflow:hidden;
    padding-bottom:56.25%;
    position:relative;
    height:0;
}
.map-responsive iframe {
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
}

</style>
@endpush
