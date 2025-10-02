<footer class="footer text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">Hudson Furnishing</h5>
                <p class="text-light mb-4">Nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn. Chất lượng thủ công gặp gỡ thiết kế hiện đại để tạo ra những không gian truyền cảm hứng.</p>
                <div class="social-links">
                    <a href="#" class="btn btn-outline-light btn-sm me-2 mb-2">Facebook</a>
                    <a href="#" class="btn btn-outline-light btn-sm me-2 mb-2">Twitter</a>
                    <a href="#" class="btn btn-outline-light btn-sm me-2 mb-2">Instagram</a>
                    <a href="#" class="btn btn-outline-light btn-sm mb-2">LinkedIn</a>
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
                    <p class="text-light mb-3">
                        {{ $siteSettings['contact_address'] ?? '123 Đường Nội Thất, Quận Thiết Kế, TP.HCM 700000' }}
                    </p>
                    <p class="text-light mb-3">
                        {{ $siteSettings['contact_phone'] ?? '+84 (0) 123 45 67 89' }}
                    </p>
                    <p class="text-light mb-3">
                        {{ $siteSettings['contact_email'] ?? 'info@hudsonfurnishing.vn' }}
                    </p>
                    <p class="text-light mb-3">
                        {{ $siteSettings['business_hours'] ?? 'T2 - T6: 8:00 - 18:00' }}
                    </p>
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
