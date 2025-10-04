@extends('layouts.admin')

@section('title', 'Quản Lý Cài Đặt - Hudson Furnishing')
@section('page-title', 'Quản Lý Cài Đặt')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0">
            <div class="card-header py-4 bg-gradient-primary">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-white text-primary me-3">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div>
                        <h5 class="m-0 font-weight-bold text-white">Cài Đặt Website</h5>
                        <small class="text-white-50">Cấu hình cài đặt website và thiết lập</small>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')
            
            <!-- Settings Tabs Navigation -->
            <ul class="nav nav-pills nav-fill mb-4" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button" role="tab">
                        <i class="fas fa-home me-2"></i>Cơ Bản
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact" type="button" role="tab">
                        <i class="fas fa-address-book me-2"></i>Liên Hệ
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="social-tab" data-bs-toggle="pill" data-bs-target="#social" type="button" role="tab">
                        <i class="fas fa-share-alt me-2"></i>Mạng Xã Hội
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seo-tab" data-bs-toggle="pill" data-bs-target="#seo" type="button" role="tab">
                        <i class="fas fa-search me-2"></i>SEO Cơ Bản
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="advanced-tab" data-bs-toggle="pill" data-bs-target="#advanced" type="button" role="tab">
                        <i class="fas fa-sliders-h me-2"></i>Nâng Cao
                    </button>
                </li>
            </ul>

            <!-- Settings Tabs Content -->
            <div class="tab-content" id="settingsTabContent">
                <!-- General Settings Tab -->
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="settings-section">
                                <div class="section-header mb-3">
                                    <h6 class="text-primary mb-1">
                                        <i class="fas fa-info-circle me-2"></i>Thông Tin Cơ Bản
                                    </h6>
                                    <small class="text-muted">Cấu hình thông tin cơ bản của website</small>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="site_name" class="form-label">
                                        <i class="fas fa-tag text-primary me-1"></i>Tên Website
                                    </label>
                                    <input type="text" class="form-control" id="site_name" name="site_name" 
                                           value="{{ $settings['site_name'] ?? 'Hudson Furnishing' }}"
                                           placeholder="Nhập tên website">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="site_tagline" class="form-label">
                                        <i class="fas fa-quote-right text-primary me-1"></i>Tagline Website
                                    </label>
                                    <input type="text" class="form-control" id="site_tagline" name="site_tagline" 
                                           value="{{ $settings['site_tagline'] ?? 'Nội thất cao cấp cho mọi không gian' }}"
                                           placeholder="Nhập tagline website">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="site_description" class="form-label">
                                        <i class="fas fa-align-left text-primary me-1"></i>Mô Tả Website
                                    </label>
                                    <textarea class="form-control" id="site_description" name="site_description" rows="3" 
                                              placeholder="Nhập mô tả website">{{ $settings['site_description'] ?? 'Hudson Furnishing cung cấp nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn. Chất lượng thủ công gặp gỡ thiết kế hiện đại.' }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="site_keywords" class="form-label">
                                        <i class="fas fa-tags text-primary me-1"></i>Từ Khóa Website
                                    </label>
                                    <input type="text" class="form-control" id="site_keywords" name="site_keywords" 
                                           value="{{ $settings['site_keywords'] ?? 'nội thất, furniture, cao cấp, phòng ngủ, phòng khách, phòng ăn, văn phòng' }}"
                                           placeholder="Nhập từ khóa website">
                                    <small class="form-text text-muted">Separate keywords with commas</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="settings-preview">
                                <div class="section-header mb-3">
                                    <h6 class="text-primary mb-1">
                                        <i class="fas fa-eye me-2"></i>Xem Trước
                                    </h6>
                                    <small class="text-muted">Cách thức hiển thị thông tin website</small>
                                </div>
                                
                                <div class="preview-card p-3 bg-light rounded">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" style="height: 32px;">
                                        <div>
                                            <h6 class="mb-0" id="preview-name">{{ $settings['site_name'] ?? 'Hudson Furnishing' }}</h6>
                                            <small class="text-muted" id="preview-tagline">{{ $settings['site_tagline'] ?? 'Nội thất cao cấp cho mọi không gian' }}</small>
                                        </div>
                                    </div>
                                    <p class="small mb-0" id="preview-description">{{ $settings['site_description'] ?? 'Hudson Furnishing cung cấp nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn...' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Settings Tab -->
                <div class="tab-pane fade" id="contact" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="settings-section">
                                <div class="section-header mb-3">
                                    <h6 class="text-primary mb-1">
                                        <i class="fas fa-address-book me-2"></i>Thông Tin Liên Hệ
                                    </h6>
                                    <small class="text-muted">Cấu hình thông tin liên hệ</small>
                                
                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">
                                        <i class="fas fa-envelope text-primary me-1"></i>Email Liên Hệ
                                    </label>
                                    <input type="email" class="form-control" id="contact_email" name="contact_email" 
                                           value="{{ $settings['contact_email'] ?? 'info@hudsonfurnishing.vn' }}"
                                           placeholder="Nhập email liên hệ">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="contact_phone" class="form-label">
                                        <i class="fas fa-phone text-primary me-1"></i>Số Điện Thoại Liên Hệ
                                    </label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" 
                                           value="{{ $settings['contact_phone'] ?? '+84 (0) 123 45 67 89' }}" 
                                           placeholder="Nhập số điện thoại liên hệ">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="contact_address" class="form-label">
                                        <i class="fas fa-map-marker-alt text-primary me-1"></i>Địa Chỉ Liên Hệ
                                    </label>
                                    <textarea class="form-control" id="contact_address" name="contact_address" rows="3" 
                                              placeholder="Nhập địa chỉ liên hệ">{{ $settings['contact_address'] ?? "123 Đường Nội Thất\nQuận Thiết Kế, TP.HCM 700000" }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="business_hours" class="form-label">
                                        <i class="fas fa-clock text-primary me-1"></i>Giờ Làm Việc
                                    </label>
                                    <textarea class="form-control" id="business_hours" name="business_hours" rows="3" 
                                              placeholder="Nhập giờ làm việc">{{ $settings['business_hours'] ?? "T2 - T6: 8:00 - 18:00\nT7: 9:00 - 17:00\nCN: Nghỉ" }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="contact-preview">
                                <div class="section-header mb-3">
                                    <h6 class="text-primary mb-1">
                                        <i class="fas fa-address-card me-2"></i>Xem Trước Liên Hệ
                                    </h6>
                                    <small class="text-muted">Cách thức hiển thị thông tin liên hệ</small>
                                </div>
                                
                                <div class="contact-card p-3 bg-light rounded">
                                    <h6 class="mb-3">Liên Hệ</h6>
                                    <div class="contact-item mb-2">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <span id="preview-email">{{ $settings['contact_email'] ?? 'info@hudsonfurnishing.vn' }}</span>
                                    </div>
                                    <div class="contact-item mb-2">
                                        <i class="fas fa-phone text-primary me-2"></i>
                                        <span id="preview-phone">{{ $settings['contact_phone'] ?? '+84 (0) 123 45 67 89' }}</span>
                                    </div>
                                    <div class="contact-item mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <span id="preview-address">{{ $settings['contact_address'] ?? '36/5 Đường D5, Quận Bình Thạnh, TP.HCM' }}</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-clock text-primary me-2"></i>
                                        <span id="preview-hours">{{ $settings['business_hours'] ?? 'T2 - T7: 8:00 - 18:00' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                
                <!-- Social Media Settings Tab -->
                <div class="tab-pane fade" id="social" role="tabpanel">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="settings-section">
                                <div class="section-header mb-3">
                                    <h6 class="text-primary mb-1">
                                        <i class="fas fa-share-alt me-2"></i>Liên Kết Mạng Xã Hội
                                    </h6>
                                    <small class="text-muted">Cấu hình liên kết mạng xã hội</small>
                                </div>
                    
                    <div class="mb-3">
                        <label for="facebook_url" class="form-label">Facebook URL</label>
                        <input type="url" class="form-control" id="facebook_url" name="facebook_url" 
                               value="{{ $settings['facebook_url'] ?? '' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="twitter_url" class="form-label">Twitter URL</label>
                        <input type="url" class="form-control" id="twitter_url" name="twitter_url" 
                               value="{{ $settings['twitter_url'] ?? '' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="instagram_url" class="form-label">Instagram URL</label>
                        <input type="url" class="form-control" id="instagram_url" name="instagram_url" 
                               value="{{ $settings['instagram_url'] ?? '' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                        <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" 
                               value="{{ $settings['linkedin_url'] ?? '' }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5>Cài Đặt SEO</h5>
                    
                    <div class="mb-3">
                        <label for="google_analytics" class="form-label">Google Analytics ID</label>
                        <input type="text" class="form-control" id="google_analytics" name="google_analytics" 
                               value="{{ $settings['google_analytics'] ?? '' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="google_maps_api" class="form-label">Google Maps API Key</label>
                        <input type="text" class="form-control" id="google_maps_api" name="google_maps_api" 
                               value="{{ $settings['google_maps_api'] ?? '' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_author" class="form-label">Meta Author</label>
                        <input type="text" class="form-control" id="meta_author" name="meta_author" 
                               value="{{ $settings['meta_author'] ?? '' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_robots" class="form-label">Meta Robots</label>
                        <select class="form-select" id="meta_robots" name="meta_robots">
                            <option value="index,follow" {{ ($settings['meta_robots'] ?? '') == 'index,follow' ? 'selected' : '' }}>Index, Follow</option>
                            <option value="noindex,nofollow" {{ ($settings['meta_robots'] ?? '') == 'noindex,nofollow' ? 'selected' : '' }}>No Index, No Follow</option>
                            <option value="index,nofollow" {{ ($settings['meta_robots'] ?? '') == 'index,nofollow' ? 'selected' : '' }}>Index, No Follow</option>
                            <option value="noindex,follow" {{ ($settings['meta_robots'] ?? '') == 'noindex,follow' ? 'selected' : '' }}>No Index, Follow</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <h5>Cài Đặt Khác</h5>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="items_per_page" class="form-label">Số Lượng Sản Phẩm Trên Trang</label>
                                <input type="number" class="form-control" id="items_per_page" name="items_per_page" 
                                       value="{{ $settings['items_per_page'] ?? 12 }}" min="1" max="100">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="maintenance_mode" class="form-label">Trạng Thái Bảo Trì</label>
                                <select class="form-select" id="maintenance_mode" name="maintenance_mode">
                                    <option value="0" {{ ($settings['maintenance_mode'] ?? '0') == '0' ? 'selected' : '' }}>Vô Hiệu Hóa</option>
                                    <option value="1" {{ ($settings['maintenance_mode'] ?? '0') == '1' ? 'selected' : '' }}>Kích Hoạt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Lưu Cài Đặt
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
