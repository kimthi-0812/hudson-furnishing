@extends('layouts.guest')

@section('title', 'Về Chúng Tôi - Hudson Furnishing')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-white py-5" style="background-color: #2f3e46 !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Về Hudson Furnishing</h1>
                <p class="lead mb-4">Khám phá câu chuyện đằng sau thương hiệu nội thất hàng đầu Việt Nam</p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/HF_About_1.jpg') }}" alt="Hudson Furnishing Showroom" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container py-5">
    <!-- Company Story -->
    <section class="mb-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">Câu Chuyện Của Chúng Tôi</h2>
                <p class="lead mb-4">Hudson Furnishing được thành lập vào năm 2015 với tầm nhìn mang đến những sản phẩm nội thất cao cấp, kết hợp giữa truyền thống thủ công và thiết kế hiện đại.</p>
                <p class="mb-4">Từ một xưởng sản xuất nhỏ tại TP.HCM, chúng tôi đã phát triển thành một trong những thương hiệu nội thất được tin tưởng nhất tại Việt Nam, phục vụ hàng nghìn khách hàng trên toàn quốc.</p>
                <p class="mb-4">Chúng tôi tin rằng mỗi không gian sống đều có thể trở thành một tác phẩm nghệ thuật, nơi gia đình tạo nên những kỷ niệm đẹp và thể hiện cá tính riêng của mình.</p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/about-1.jpg') }}" alt="Hudson Furnishing Workshop" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mb-5">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-bullseye fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Sứ Mệnh</h4>
                        <p class="text-muted">Mang đến những sản phẩm nội thất chất lượng cao, kết hợp giữa nghệ thuật thủ công truyền thống và thiết kế hiện đại, tạo nên không gian sống hoàn hảo cho mọi gia đình Việt Nam.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-eye fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Tầm Nhìn</h4>
                        <p class="text-muted">Trở thành thương hiệu nội thất hàng đầu Việt NamNam, được công nhận về chất lượng sản phẩm, dịch vụ khách hàng và đóng góp tích cực cho cộng đồng.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-heart fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Giá Trị Cốt Lõi</h4>
                        <p class="text-muted">Chất lượng, Sáng tạo, Chân thành và Bền vững. Chúng tôi cam kết mang đến những sản phẩm tốt nhất với giá trị lâu dài cho khách hàng.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="mb-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Giá Trị Của Chúng Tôi</h2>
            <p class="lead text-muted">Những nguyên tắc định hướng mọi hoạt động của Hudson Furnishing</p>
        </div>
        
    <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-gem fa-lg"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold">Chất Lượng Cao Cấp</h5>
                        <p class="text-muted mb-0">Mỗi sản phẩm đều được chế tác từ những nguyên liệu tốt nhất, đảm bảo độ bền và vẻ đẹp theo thời gian.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-palette fa-lg"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold">Thiết Kế Sáng Tạo</h5>
                        <p class="text-muted mb-0">Đội ngũ thiết kế giàu kinh nghiệm luôn tạo ra những sản phẩm độc đáo, phù hợp với xu hướng hiện đại.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-handshake fa-lg"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold">Dịch Vụ Tận Tâm</h5>
                        <p class="text-muted mb-0">Từ tư vấn thiết kế đến lắp đặt và bảo hành, chúng tôi luôn đồng hành cùng khách hàng.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-leaf fa-lg"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold">Bền Vững Môi Trường</h5>
                        <p class="text-muted mb-0">Sử dụng nguyên liệu thân thiện với môi trường và quy trình sản xuất bền vững.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="mb-5">
            <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Đội Ngũ Của Chúng Tôi</h2>
            <p class="lead text-muted">Những con người tài năng đằng sau thành công của Hudson Furnishing</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                <i class="fas fa-user fa-3x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold">Lê Tấn Bửu</h5>
                        <p class="text-primary mb-2">Giám Đốc Điều Hành</p>
                        <p class="text-muted small">Với hơn 15 năm kinh nghiệm trong ngành nội thất, anh Bửu đã dẫn dắt công ty từ những ngày đầu thành lập.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                <i class="fas fa-user fa-3x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold">Audrey Nguyễn</h5>
                        <p class="text-primary mb-2">Giám Đốc Thiết Kế</p>
                        <p class="text-muted small">Chị Audrey là người tạo ra những thiết kế độc đáo, kết hợp hài hòa giữa truyền thống và hiện đại.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                <i class="fas fa-user fa-3x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold">Nguyễn Phúc Duy Anh</h5>
                        <p class="text-primary mb-2">Trưởng Phòng Sản Xuất</p>
                        <p class="text-muted small">Anh Duy Anh đảm bảo mỗi sản phẩm đều đạt tiêu chuẩn chất lượng cao nhất trước khi đến tay khách hàng.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="mb-5">
        <div class="bg-light rounded-3 p-5">
            <div class="text-center mb-4">
                <h2 class="display-5 fw-bold">Thành Tựu Của Chúng Tôi</h2>
                <p class="lead text-muted">Những con số ấn tượng phản ánh sự tin tưởng của khách hàng</p>
            </div>
            
            <div class="row text-center">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="mb-3">
                        <i class="fas fa-home fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary">100+</h3>
                    <p class="text-muted mb-0">Dự Án Hoàn Thành</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="mb-3">
                        <i class="fas fa-users fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary">99+</h3>
                    <p class="text-muted mb-0">Khách Hàng Hài Lòng</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="mb-3">
                        <i class="fas fa-award fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary">5+</h3>
                    <p class="text-muted mb-0">Giải Thưởng</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="mb-3">
                        <i class="fas fa-calendar fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary">8</h3>
                    <p class="text-muted mb-0">Năm Kinh Nghiệm</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="text-center">
        <div class="cta-section">
            <h2 class="display-5 fw-bold mb-4">Sẵn Sàng Tạo Nên Không Gian Mơ Ước?</h2>
            <p class="lead mb-4">Hãy để chúng tôi giúp bạn biến ý tưởng thành hiện thực</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-phone me-2"></i>Liên Hệ Ngay
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-eye me-2"></i>Xem Sản Phẩm
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
