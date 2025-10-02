@extends('layouts.app')

@section('title', 'About Us - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold">Hudson Furnishing</h1>
                <p class="lead text-muted">Sáng tạo không gian - Khẳng định đẳng cấp</p>
            </div>
            
            <div class="row mb-5">
                <div class="col-md-6">
                    <img src="{{ asset('images/HF_About_1.jpg') }}" alt="About Hudson Furnishing" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h3>Câu Chuyện Thương Hiệu</h3>
                    <p>Được thành lập vào năm 2025, Hudson Furnishing cam kết mang đến các giải pháp nội thất cao cấp cho nhà ở và doanh nghiệp. Chúng tôi tin rằng mọi không gian đều xứng đáng được đẹp, tiện nghi và truyền cảm hứng.</p>
                    <p>Với sự tận tâm trong từng chi tiết và thiết kế sáng tạo, Hudson Furnishing đã trở thành cái tên đáng tin cậy trong ngành nội thất.</p>
                </div>
            </div>
            
            <div class="row mb-5">
                <div class="col-md-4 text-center">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-award fa-3x text-primary mb-3"></i>
                        <h4>Chất lượng</h4>
                        <p>Chúng tôi sử dụng nguyên liệu cao cấp và đội ngũ thợ thủ công lành nghề để đảm bảo từng sản phẩm đạt tiêu chuẩn  nhất.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-palette fa-3x text-primary mb-3"></i>
                        <h4>Thiết kế</h4>
                        <p>Đội ngũ thiết kế của chúng tôi sáng tạo nên những sản phẩm tinh tế, vượt thời gian, phù hợp với mọi phong cách và không gian.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="bg-light p-4 rounded">
                        <i class="fas fa-heart fa-3x text-primary mb-3"></i>
                        <h4>Dịch vụ</h4>
                        <p>Chúng tôi luôn đồng hành cùng khách hàng, mang đến trải nghiệm dịch vụ tận tâm từ lúc chọn lựa đến khi hoàn thiện không gian sống.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <h3>Ghé thăm showroom</h3>
                <p class="text-muted mb-4">Trải nghiệm trực tiếp các sản phẩm nội thất tại showroom của chúng tôi:</p>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Địa chỉ:</strong><br>
                        35/6 Đường D5, Phường 25<br>
                        Quận Bình Thạnh, TP.HCM</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Giờ Hoạt Động</strong><br>
                        T2 - T6: 9AM-6PM<br>
                        T7: 10AM-4PM<br>
                        CN: Không hoạt động</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
