<footer class="footer text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="footer-brand">
                    @php use Illuminate\Support\Facades\Storage; @endphp
                    <img src="{{ isset($siteSettings['logo']) && $siteSettings['logo']
                        ? Storage::url($siteSettings['logo']) 
                        : asset('images/logo.png') }}"
                    alt="{{ $siteSettings['site_name'] ?? 'Hudson Furnishing' }}" height="40">
                    <h5 class="fw-bold mb-3">{{ $siteSettings['site_name'] ?? 'Hudson Furnishing' }}</h5>
                    <p class="text-light mb-4">{{ $siteSettings['site_tagline'] ?? 'Nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn. Chất lượng thủ công gặp gỡ thiết kế hiện đại để tạo ra những không gian truyền cảm hứng.'}}</p>
                    <div class="social-links">
                        <a href="{{ $siteSettings['facebook_url'] ?? '#' }}" class="social-link me-3" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{ $siteSettings['instagram_url'] ?? '#' }}" class="social-link me-3" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ $siteSettings['twitter_url'] ?? '#' }}" class="social-link me-3" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="{{ $siteSettings['youtube_url'] ?? '#' }}" class="social-link me-3" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="{{ $siteSettings['tiktok_url'] ?? '#' }}" class="social-link" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold mb-3">Liên Kết Nhanh</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-light text-decoration-none">
                        Trang Chủ
                    </a></li>
                    <li class="mb-2"><a href="{{ route('products.index') }}" class="text-light text-decoration-none">
                        Sản Phẩm
                    </a></li>
                    <li class="mb-2"><a href="{{ route('gallery.index') }}" class="text-light text-decoration-none">
                        Thư Viện
                    </a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-light text-decoration-none">
                        Giới Thiệu
                    </a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold mb-3">Danh Mục</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('products.section', 'phong-ngu') }}" class="text-light text-decoration-none">
                        Phòng Ngủ
                    </a></li>
                    <li class="mb-2"><a href="{{ route('products.section', 'phong-khach') }}" class="text-light text-decoration-none">
                        Phòng Khách
                    </a></li>
                    <li class="mb-2"><a href="{{ route('products.section', 'phong-an') }}" class="text-light text-decoration-none">
                        Phòng Ăn
                    </a></li>
                    <li class="mb-2"><a href="{{ route('products.section', 'van-phong') }}" class="text-light text-decoration-none">
                        Văn Phòng
                    </a></li>
                </ul>
            </div>
            
            <div class="col-lg-4 mb-4">
                <h6 class="fw-bold mb-3">Thông Tin Liên Hệ</h6>
                <div class="contact-info">
                    <div class="contact-item mb-3">
                        <i class="fas fa-map-marker-alt text-secondary me-2"></i>
                        <span class="text-light">{{ $siteSettings['contact_address'] ?? '36/5 Đường D5, Quận Bình Thạnh, TP.HCM 700000' }}</span>
                    </div>
                    <div class="contact-item mb-3">
                        <i class="fas fa-phone text-secondary me-2"></i>
                        <span class="text-light">{{ $siteSettings['contact_phone'] ?? '+84 909 090 909' }}</span>
                    </div>
                    <div class="contact-item mb-3">
                        <i class="fas fa-envelope text-secondary me-2"></i>
                        <span class="text-light">{{ $siteSettings['contact_email'] ?? 'info@hudsonfurnishing.com' }}</span>
                    </div>
                    <div class="contact-item mb-3">
                        <i class="fas fa-clock text-secondary me-2"></i>
                        <span class="text-light">{{ $siteSettings['business_hours'] ?? 'T2 - T7: 8:00 - 18:00' }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="my-4 border-light">
        
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0 text-light">
                    {{ date('Y') }} Hudson Furnishing. Tất cả quyền được bảo lưu.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 text-light">
                    <span id="visitor-count">0</span> lượt truy cập hôm nay
                </p>
            </div>
        </div>
    </div>
</footer>
