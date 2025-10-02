@extends('layouts.app')

@section('title', 'Contact Us - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold">LIÊN HỆ VỚI CHÚNG TÔI</h1>
                <p class="lead text-muted">Chúng tôi sẵn sàng hỗ trợ</p>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <h3>Liên hệ</h3>
                    <p>Tư vấn về nội thất và yêu cầu hướng dẫn đặt hàng? Liên hệ ngay!</p>
                    
                    <div class="contact-info">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-3"></i>
                            <div>
                                <strong>Địa chỉ</strong><br>
                                {!! nl2br(e($siteSettings['contact_address'] ?? '35/6 Đường D5, Phường 25<br>Quận Bình Thạnh, TP.HCM')) !!}
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-phone text-primary me-3"></i>
                            <div>
                                <strong>Số Điện Thoại / Zalo</strong><br>
                                {{ $siteSettings['contact_phone'] ?? '+84 (0) 123 45 67 89' }}<br>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <div>
                                <strong>Email</strong><br>
                                {{ $siteSettings['contact_email'] ?? 'info@hudsonfurnishing.vn' }}
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-clock text-primary me-3"></i>
                            <div>
                                <strong>Giờ Hoạt Động</strong><br>
                                {!! nl2br(e($siteSettings['business_hours'] ?? 'T2 - T6: 9AM-6PM<br>T7: 10AM-4PM<br>CN: Không hoạt động')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Phản hồi đến chúng tôi:</h4>
                            <form id="contactForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ Tên *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Thông điệp *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100">Gửi</button>
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
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            this.reset();
        } else {
            alert('Error sending message. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error sending message. Please try again.');
    });
});
</script>
@endpush
