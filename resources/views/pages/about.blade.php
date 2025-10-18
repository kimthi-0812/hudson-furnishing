@extends('layouts.guest')

@section('title', 'Về Chúng Tôi - Hudson Furnishing')

@section('content')
@php
    use App\Models\AboutPage;
    $aboutPage = AboutPage::getFirst();
@endphp

<!-- Hero Section -->
<section class="hero-section text-white py-5" style="background-color: #2f3e46 !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">{{ $aboutPage->hero_title ?: 'Về Hudson Furnishing' }}</h1>
                <p class="lead mb-4">{{ $aboutPage->hero_subtitle ?: 'Khám phá câu chuyện đằng sau thương hiệu nội thất hàng đầu Việt Nam' }}</p>
            </div>
            <div class="col-lg-6">
                @if($aboutPage->hero_image)
                    <img src="{{ Storage::url($aboutPage->hero_image) }}" alt="Hudson Furnishing Showroom" class="img-fluid rounded shadow-lg">
                @else
                    <img src="{{ asset('images/HF_About_1.jpg') }}" alt="Hudson Furnishing Showroom" class="img-fluid rounded shadow-lg">
                @endif
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
                <h2 class="display-5 fw-bold mb-4">{{ $aboutPage->story_title ?: 'Câu Chuyện Của Chúng Tôi' }}</h2>
                @if($aboutPage->story_content_1)
                    <p class="lead mb-4">{{ $aboutPage->story_content_1 }}</p>
                @else
                    <p class="lead mb-4">Hudson Furnishing được thành lập vào năm 2015 với tầm nhìn mang đến những sản phẩm nội thất cao cấp, kết hợp giữa truyền thống thủ công và thiết kế hiện đại.</p>
                @endif
                
                @if($aboutPage->story_content_2)
                    <p class="mb-4">{{ $aboutPage->story_content_2 }}</p>
                @else
                    <p class="mb-4">Từ một xưởng sản xuất nhỏ tại TP.HCM, chúng tôi đã phát triển thành một trong những thương hiệu nội thất được tin tưởng nhất tại Việt Nam, phục vụ hàng nghìn khách hàng trên toàn quốc.</p>
                @endif
                
                @if($aboutPage->story_content_3)
                    <p class="mb-4">{{ $aboutPage->story_content_3 }}</p>
                @else
                    <p class="mb-4">Chúng tôi tin rằng mỗi không gian sống đều có thể trở thành một tác phẩm nghệ thuật, nơi gia đình tạo nên những kỷ niệm đẹp và thể hiện cá tính riêng của mình.</p>
                @endif
            </div>
            <div class="col-lg-6">
                @if($aboutPage->story_image)
                    <img src="{{ Storage::url($aboutPage->story_image) }}" alt="Hudson Furnishing Workshop" class="img-fluid rounded shadow-lg">
                @else
                    <img src="{{ asset('images/about-1.jpg') }}" alt="Hudson Furnishing Workshop" class="img-fluid rounded shadow-lg">
                @endif
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    @if($aboutPage->mission_title || $aboutPage->vision_title || $aboutPage->values_title)
    <section class="mb-5 mission-vision-values">
        <div class="row">
            @if($aboutPage->mission_title || $aboutPage->mission_content)
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        @if($aboutPage->mission_icon)
                        <div class="mb-3">
                            <i class="{{ $aboutPage->mission_icon }} fa-3x text-primary"></i>
                        </div>
                        @endif
                        @if($aboutPage->mission_title)
                        <h4 class="fw-bold mb-3">{{ $aboutPage->mission_title }}</h4>
                        @endif
                        @if($aboutPage->mission_content)
                        <p class="text-muted">{{ $aboutPage->mission_content }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if($aboutPage->vision_title || $aboutPage->vision_content)
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        @if($aboutPage->vision_icon)
                        <div class="mb-3">
                            <i class="{{ $aboutPage->vision_icon }} fa-3x text-primary"></i>
                        </div>
                        @endif
                        @if($aboutPage->vision_title)
                        <h4 class="fw-bold mb-3">{{ $aboutPage->vision_title }}</h4>
                        @endif
                        @if($aboutPage->vision_content)
                        <p class="text-muted">{{ $aboutPage->vision_content }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if($aboutPage->values_title || $aboutPage->values_content)
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        @if($aboutPage->values_icon)
                        <div class="mb-3">
                            <i class="{{ $aboutPage->values_icon }} fa-3x text-primary"></i>
                        </div>
                        @endif
                        @if($aboutPage->values_title)
                        <h4 class="fw-bold mb-3">{{ $aboutPage->values_title }}</h4>
                        @endif
                        @if($aboutPage->values_content)
                        <p class="text-muted">{{ $aboutPage->values_content }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    <!-- Our Values -->
    <section class="mb-5 our-values-section">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">{{ $aboutPage->our_values_title ?: 'Giá Trị Của Chúng Tôi' }}</h2>
            <p class="lead text-muted">{{ $aboutPage->our_values_subtitle ?: 'Những nguyên tắc định hướng mọi hoạt động của Hudson Furnishing' }}</p>
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
                        <h5 class="fw-bold">{{ $aboutPage->value_1_title ?: 'Chất Lượng Cao Cấp' }}</h5>
                        <p class="text-muted mb-0">{{ $aboutPage->value_1_content ?: 'Mỗi sản phẩm đều được chế tác từ những nguyên liệu tốt nhất, đảm bảo độ bền và vẻ đẹp theo thời gian.' }}</p>
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
                        <h5 class="fw-bold">{{ $aboutPage->value_2_title ?: 'Thiết Kế Sáng Tạo' }}</h5>
                        <p class="text-muted mb-0">{{ $aboutPage->value_2_content ?: 'Đội ngũ thiết kế giàu kinh nghiệm luôn tạo ra những sản phẩm độc đáo, phù hợp với xu hướng hiện đại.' }}</p>
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
                        <h5 class="fw-bold">{{ $aboutPage->value_3_title ?: 'Dịch Vụ Tận Tâm' }}</h5>
                        <p class="text-muted mb-0">{{ $aboutPage->value_3_content ?: 'Từ tư vấn thiết kế đến lắp đặt và bảo hành, chúng tôi luôn đồng hành cùng khách hàng.' }}</p>
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
                        <h5 class="fw-bold">{{ $aboutPage->value_4_title ?: 'Bền Vững Môi Trường' }}</h5>
                        <p class="text-muted mb-0">{{ $aboutPage->value_4_content ?: 'Sử dụng nguyên liệu thân thiện với môi trường và quy trình sản xuất bền vững.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="mb-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">{{ $aboutPage->team_title ?: 'Đội Ngũ Của Chúng Tôi' }}</h2>
            <p class="lead text-muted">{{ $aboutPage->team_subtitle ?: 'Những con người tài năng đằng sau thành công của Hudson Furnishing' }}</p>
        </div>
        
        <div class="row">
            @if($aboutPage->member_1_name)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            @if($aboutPage->member_1_image)
                                <img src="{{ Storage::url($aboutPage->member_1_image) }}" 
                                     alt="{{ $aboutPage->member_1_name }}" 
                                     class="rounded-circle mx-auto" 
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                    <i class="fas fa-user fa-3x text-primary"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="fw-bold">{{ $aboutPage->member_1_name }}</h5>
                        <p class="text-primary mb-2">{{ $aboutPage->member_1_position }}</p>
                        <p class="text-muted small">{{ $aboutPage->member_1_description }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            @if($aboutPage->member_2_name)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            @if($aboutPage->member_2_image)
                                <img src="{{ Storage::url($aboutPage->member_2_image) }}" 
                                     alt="{{ $aboutPage->member_2_name }}" 
                                     class="rounded-circle mx-auto" 
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                    <i class="fas fa-user fa-3x text-primary"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="fw-bold">{{ $aboutPage->member_2_name }}</h5>
                        <p class="text-primary mb-2">{{ $aboutPage->member_2_position }}</p>
                        <p class="text-muted small">{{ $aboutPage->member_2_description }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            @if($aboutPage->member_3_name)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            @if($aboutPage->member_3_image)
                                <img src="{{ Storage::url($aboutPage->member_3_image) }}" 
                                     alt="{{ $aboutPage->member_3_name }}" 
                                     class="rounded-circle mx-auto" 
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                    <i class="fas fa-user fa-3x text-primary"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="fw-bold">{{ $aboutPage->member_3_name }}</h5>
                        <p class="text-primary mb-2">{{ $aboutPage->member_3_position }}</p>
                        <p class="text-muted small">{{ $aboutPage->member_3_description }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- Statistics -->
    <section class="mb-5">
        <div class="bg-light rounded-3 p-5">
            <div class="text-center mb-4">
                <h2 class="display-5 fw-bold">{{ $aboutPage->stats_title ?: 'Thành Tựu Của Chúng Tôi' }}</h2>
                <p class="lead text-muted">{{ $aboutPage->stats_subtitle ?: 'Những con số ấn tượng phản ánh sự tin tưởng của khách hàng' }}</p>
            </div>
            
            <div class="row text-center">
                @if($aboutPage->stat_1_number)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="mb-3">
                        <i class="{{ $aboutPage->stat_1_icon ?: 'fas fa-home' }} fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $aboutPage->stat_1_number }}</h3>
                    <p class="text-muted mb-0">{{ $aboutPage->stat_1_label ?: 'Dự Án Hoàn Thành' }}</p>
                </div>
                @endif
                
                @if($aboutPage->stat_2_number)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="mb-3">
                        <i class="{{ $aboutPage->stat_2_icon ?: 'fas fa-users' }} fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $aboutPage->stat_2_number }}</h3>
                    <p class="text-muted mb-0">{{ $aboutPage->stat_2_label ?: 'Khách Hàng Hài Lòng' }}</p>
                </div>
                @endif
                
                @if($aboutPage->stat_3_number)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="mb-3">
                        <i class="{{ $aboutPage->stat_3_icon ?: 'fas fa-award' }} fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $aboutPage->stat_3_number }}</h3>
                    <p class="text-muted mb-0">{{ $aboutPage->stat_3_label ?: 'Giải Thưởng' }}</p>
                </div>
                @endif
                
                @if($aboutPage->stat_4_number)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="mb-3">
                        <i class="{{ $aboutPage->stat_4_icon ?: 'fas fa-calendar' }} fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $aboutPage->stat_4_number }}</h3>
                    <p class="text-muted mb-0">{{ $aboutPage->stat_4_label ?: 'Năm Kinh Nghiệm' }}</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="text-center">
        <div class="cta-section">
            <h2 class="display-5 fw-bold mb-4">{{ $aboutPage->cta_title ?: 'Sẵn Sàng Tạo Nên Không Gian Mơ Ước?' }}</h2>
            <p class="lead mb-4">{{ $aboutPage->cta_subtitle ?: 'Hãy để chúng tôi giúp bạn biến ý tưởng thành hiện thực' }}</p>
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
