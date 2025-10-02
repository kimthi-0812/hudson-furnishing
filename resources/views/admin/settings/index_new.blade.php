@extends('layouts.admin')

@section('title', 'Settings Management - Hudson Furnishing')
@section('page-title', 'Settings Management')

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
                        <h5 class="m-0 font-weight-bold text-white">Site Settings</h5>
                        <small class="text-white-50">Configure your website settings and preferences</small>
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
                                <i class="fas fa-home me-2"></i>General
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact" type="button" role="tab">
                                <i class="fas fa-address-book me-2"></i>Contact
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="social-tab" data-bs-toggle="pill" data-bs-target="#social" type="button" role="tab">
                                <i class="fas fa-share-alt me-2"></i>Social Media
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seo-tab" data-bs-toggle="pill" data-bs-target="#seo" type="button" role="tab">
                                <i class="fas fa-search me-2"></i>SEO
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="advanced-tab" data-bs-toggle="pill" data-bs-target="#advanced" type="button" role="tab">
                                <i class="fas fa-sliders-h me-2"></i>Advanced
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
                                                <i class="fas fa-info-circle me-2"></i>Basic Information
                                            </h6>
                                            <small class="text-muted">Configure your website's basic information</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="site_name" class="form-label">
                                                <i class="fas fa-tag text-primary me-1"></i>Site Name
                                            </label>
                                            <input type="text" class="form-control" id="site_name" name="site_name" 
                                                   value="{{ $settings['site_name'] ?? 'Hudson Furnishing' }}"
                                                   placeholder="Enter your website name">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="site_tagline" class="form-label">
                                                <i class="fas fa-quote-right text-primary me-1"></i>Site Tagline
                                            </label>
                                            <input type="text" class="form-control" id="site_tagline" name="site_tagline" 
                                                   value="{{ $settings['site_tagline'] ?? 'Nội thất cao cấp cho mọi không gian' }}"
                                                   placeholder="Enter your website tagline">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="site_description" class="form-label">
                                                <i class="fas fa-align-left text-primary me-1"></i>Site Description
                                            </label>
                                            <textarea class="form-control" id="site_description" name="site_description" rows="3" 
                                                      placeholder="Enter your website description">{{ $settings['site_description'] ?? 'Hudson Furnishing cung cấp nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn. Chất lượng thủ công gặp gỡ thiết kế hiện đại.' }}</textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="site_keywords" class="form-label">
                                                <i class="fas fa-tags text-primary me-1"></i>Site Keywords
                                            </label>
                                            <input type="text" class="form-control" id="site_keywords" name="site_keywords" 
                                                   value="{{ $settings['site_keywords'] ?? 'nội thất, furniture, cao cấp, phòng ngủ, phòng khách, phòng ăn, văn phòng' }}"
                                                   placeholder="Enter keywords separated by commas">
                                            <small class="form-text text-muted">Separate keywords with commas</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="settings-preview">
                                        <div class="section-header mb-3">
                                            <h6 class="text-primary mb-1">
                                                <i class="fas fa-eye me-2"></i>Preview
                                            </h6>
                                            <small class="text-muted">How your site information will appear</small>
                                        </div>
                                        
                                        <div class="preview-card p-3 bg-light rounded">
                                            <div class="d-flex align-items-center mb-2">
                                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" style="height: 32px;" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                                <div>
                                                    <h6 class="mb-0" id="preview-name">{{ $settings['site_name'] ?? 'Hudson Furnishing' }}</h6>
                                                    <small class="text-muted" id="preview-tagline">{{ $settings['site_tagline'] ?? 'Nội thất cao cấp cho mọi không gian' }}</small>
                                                </div>
                                            </div>
                                            <p class="small mb-0" id="preview-description">{{ Str::limit($settings['site_description'] ?? 'Hudson Furnishing cung cấp nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn...', 100) }}</p>
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
                                                <i class="fas fa-address-book me-2"></i>Contact Information
                                            </h6>
                                            <small class="text-muted">Configure your contact details</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="contact_email" class="form-label">
                                                <i class="fas fa-envelope text-primary me-1"></i>Contact Email
                                            </label>
                                            <input type="email" class="form-control" id="contact_email" name="contact_email" 
                                                   value="{{ $settings['contact_email'] ?? 'info@hudsonfurnishing.vn' }}"
                                                   placeholder="Enter your contact email">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="contact_phone" class="form-label">
                                                <i class="fas fa-phone text-primary me-1"></i>Contact Phone
                                            </label>
                                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" 
                                                   value="{{ $settings['contact_phone'] ?? '+84 (0) 123 45 67 89' }}" 
                                                   placeholder="+84 (0) 123 45 67 89">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="contact_address" class="form-label">
                                                <i class="fas fa-map-marker-alt text-primary me-1"></i>Contact Address
                                            </label>
                                            <textarea class="form-control" id="contact_address" name="contact_address" rows="3" 
                                                      placeholder="Enter your business address">{{ $settings['contact_address'] ?? "123 Đường Nội Thất\nQuận Thiết Kế, TP.HCM 700000" }}</textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="business_hours" class="form-label">
                                                <i class="fas fa-clock text-primary me-1"></i>Business Hours
                                            </label>
                                            <textarea class="form-control" id="business_hours" name="business_hours" rows="3" 
                                                      placeholder="Enter your business hours">{{ $settings['business_hours'] ?? "T2 - T6: 8:00 - 18:00\nT7: 9:00 - 17:00\nCN: Nghỉ" }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="contact-preview">
                                        <div class="section-header mb-3">
                                            <h6 class="text-primary mb-1">
                                                <i class="fas fa-address-card me-2"></i>Contact Preview
                                            </h6>
                                            <small class="text-muted">How your contact info will appear</small>
                                        </div>
                                        
                                        <div class="contact-card p-3 bg-light rounded">
                                            <h6 class="mb-3">Get in Touch</h6>
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
                                                <span id="preview-address">{{ Str::limit($settings['contact_address'] ?? '123 Đường Nội Thất, Quận Thiết Kế, TP.HCM', 50) }}</span>
                                            </div>
                                            <div class="contact-item">
                                                <i class="fas fa-clock text-primary me-2"></i>
                                                <span id="preview-hours">{{ Str::limit($settings['business_hours'] ?? 'T2 - T6: 8:00 - 18:00', 30) }}</span>
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
                                                <i class="fas fa-share-alt me-2"></i>Social Media Links
                                            </h6>
                                            <small class="text-muted">Configure your social media presence</small>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="facebook_url" class="form-label">
                                                        <i class="fab fa-facebook text-primary me-1"></i>Facebook URL
                                                    </label>
                                                    <input type="url" class="form-control" id="facebook_url" name="facebook_url" 
                                                           value="{{ $settings['facebook_url'] ?? 'https://facebook.com/hudsonfurnishing' }}"
                                                           placeholder="https://facebook.com/yourpage">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="instagram_url" class="form-label">
                                                        <i class="fab fa-instagram text-primary me-1"></i>Instagram URL
                                                    </label>
                                                    <input type="url" class="form-control" id="instagram_url" name="instagram_url" 
                                                           value="{{ $settings['instagram_url'] ?? 'https://instagram.com/hudsonfurnishing' }}"
                                                           placeholder="https://instagram.com/yourpage">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="twitter_url" class="form-label">
                                                        <i class="fab fa-twitter text-primary me-1"></i>Twitter URL
                                                    </label>
                                                    <input type="url" class="form-control" id="twitter_url" name="twitter_url" 
                                                           value="{{ $settings['twitter_url'] ?? 'https://twitter.com/hudsonfurnishing' }}"
                                                           placeholder="https://twitter.com/yourpage">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="linkedin_url" class="form-label">
                                                        <i class="fab fa-linkedin text-primary me-1"></i>LinkedIn URL
                                                    </label>
                                                    <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" 
                                                           value="{{ $settings['linkedin_url'] ?? 'https://linkedin.com/company/hudsonfurnishing' }}"
                                                           placeholder="https://linkedin.com/company/yourcompany">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="social-preview">
                                        <div class="section-header mb-3">
                                            <h6 class="text-primary mb-1">
                                                <i class="fas fa-thumbs-up me-2"></i>Social Preview
                                            </h6>
                                            <small class="text-muted">Your social media links</small>
                                        </div>
                                        
                                        <div class="social-links p-3 bg-light rounded">
                                            <h6 class="mb-3">Follow Us</h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="#" class="btn btn-outline-primary btn-sm">
                                                    <i class="fab fa-facebook me-1"></i>Facebook
                                                </a>
                                                <a href="#" class="btn btn-outline-info btn-sm">
                                                    <i class="fab fa-twitter me-1"></i>Twitter
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-sm">
                                                    <i class="fab fa-instagram me-1"></i>Instagram
                                                </a>
                                                <a href="#" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fab fa-linkedin me-1"></i>LinkedIn
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- SEO Settings Tab -->
                        <div class="tab-pane fade" id="seo" role="tabpanel">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="settings-section">
                                        <div class="section-header mb-3">
                                            <h6 class="text-primary mb-1">
                                                <i class="fas fa-search me-2"></i>SEO Configuration
                                            </h6>
                                            <small class="text-muted">Optimize your website for search engines</small>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="google_analytics" class="form-label">
                                                        <i class="fab fa-google text-primary me-1"></i>Google Analytics ID
                                                    </label>
                                                    <input type="text" class="form-control" id="google_analytics" name="google_analytics" 
                                                           value="{{ $settings['google_analytics'] ?? '' }}"
                                                           placeholder="G-XXXXXXXXXX">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="meta_author" class="form-label">
                                                        <i class="fas fa-user text-primary me-1"></i>Meta Author
                                                    </label>
                                                    <input type="text" class="form-control" id="meta_author" name="meta_author" 
                                                           value="{{ $settings['meta_author'] ?? 'Hudson Furnishing' }}"
                                                           placeholder="Enter author name">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="google_maps_api" class="form-label">
                                                        <i class="fas fa-map text-primary me-1"></i>Google Maps API Key
                                                    </label>
                                                    <input type="text" class="form-control" id="google_maps_api" name="google_maps_api" 
                                                           value="{{ $settings['google_maps_api'] ?? '' }}"
                                                           placeholder="Enter Google Maps API key">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="meta_robots" class="form-label">
                                                        <i class="fas fa-robot text-primary me-1"></i>Meta Robots
                                                    </label>
                                                    <select class="form-select" id="meta_robots" name="meta_robots">
                                                        <option value="index,follow" {{ ($settings['meta_robots'] ?? 'index,follow') == 'index,follow' ? 'selected' : '' }}>Index, Follow</option>
                                                        <option value="noindex,nofollow" {{ ($settings['meta_robots'] ?? '') == 'noindex,nofollow' ? 'selected' : '' }}>No Index, No Follow</option>
                                                        <option value="index,nofollow" {{ ($settings['meta_robots'] ?? '') == 'index,nofollow' ? 'selected' : '' }}>Index, No Follow</option>
                                                        <option value="noindex,follow" {{ ($settings['meta_robots'] ?? '') == 'noindex,follow' ? 'selected' : '' }}>No Index, Follow</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="seo-preview">
                                        <div class="section-header mb-3">
                                            <h6 class="text-primary mb-1">
                                                <i class="fas fa-chart-line me-2"></i>SEO Status
                                            </h6>
                                            <small class="text-muted">Your SEO configuration status</small>
                                        </div>
                                        
                                        <div class="seo-status p-3 bg-light rounded">
                                            <div class="status-item mb-2">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                <small>Meta tags configured</small>
                                            </div>
                                            <div class="status-item mb-2">
                                                <i class="fas fa-{{ $settings['google_analytics'] ?? '' ? 'check-circle text-success' : 'times-circle text-warning' }} me-2"></i>
                                                <small>Google Analytics {{ $settings['google_analytics'] ?? '' ? 'enabled' : 'not configured' }}</small>
                                            </div>
                                            <div class="status-item">
                                                <i class="fas fa-{{ $settings['google_maps_api'] ?? '' ? 'check-circle text-success' : 'times-circle text-warning' }} me-2"></i>
                                                <small>Google Maps {{ $settings['google_maps_api'] ?? '' ? 'enabled' : 'not configured' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Advanced Settings Tab -->
                        <div class="tab-pane fade" id="advanced" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="settings-section">
                                        <div class="section-header mb-3">
                                            <h6 class="text-primary mb-1">
                                                <i class="fas fa-sliders-h me-2"></i>Advanced Configuration
                                            </h6>
                                            <small class="text-muted">Configure advanced website settings</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="items_per_page" class="form-label">
                                                <i class="fas fa-list text-primary me-1"></i>Items Per Page
                                            </label>
                                            <input type="number" class="form-control" id="items_per_page" name="items_per_page" 
                                                   value="{{ $settings['items_per_page'] ?? 12 }}" min="1" max="100"
                                                   placeholder="12">
                                            <small class="form-text text-muted">Number of items to display per page</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="maintenance_mode" class="form-label">
                                                <i class="fas fa-tools text-primary me-1"></i>Maintenance Mode
                                            </label>
                                            <select class="form-select" id="maintenance_mode" name="maintenance_mode">
                                                <option value="0" {{ ($settings['maintenance_mode'] ?? '0') == '0' ? 'selected' : '' }}>Disabled</option>
                                                <option value="1" {{ ($settings['maintenance_mode'] ?? '0') == '1' ? 'selected' : '' }}>Enabled</option>
                                            </select>
                                            <small class="form-text text-muted">Enable to show maintenance page to visitors</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="system-info">
                                        <div class="section-header mb-3">
                                            <h6 class="text-primary mb-1">
                                                <i class="fas fa-info-circle me-2"></i>System Information
                                            </h6>
                                            <small class="text-muted">Current system status and information</small>
                                        </div>
                                        
                                        <div class="system-card p-3 bg-light rounded">
                                            <div class="info-item mb-2">
                                                <strong>Laravel Version:</strong> {{ app()->version() }}
                                            </div>
                                            <div class="info-item mb-2">
                                                <strong>PHP Version:</strong> {{ PHP_VERSION }}
                                            </div>
                                            <div class="info-item mb-2">
                                                <strong>Environment:</strong> 
                                                <span class="badge bg-{{ app()->environment() === 'production' ? 'success' : 'warning' }}">
                                                    {{ ucfirst(app()->environment()) }}
                                                </span>
                                            </div>
                                            <div class="info-item">
                                                <strong>Debug Mode:</strong> 
                                                <span class="badge bg-{{ config('app.debug') ? 'warning' : 'success' }}">
                                                    {{ config('app.debug') ? 'Enabled' : 'Disabled' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Save Button -->
                    <div class="text-end mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Save All Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add CSS for icon circles and enhanced styling -->
<style>
.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.settings-section, .settings-preview, .contact-preview, .social-preview, .seo-preview, .system-info {
    height: 100%;
}

.preview-card, .contact-card, .social-links, .seo-status, .system-card {
    border: 1px solid #e3e6f0;
    transition: all 0.3s ease;
}

.preview-card:hover, .contact-card:hover, .social-links:hover, .seo-status:hover, .system-card:hover {
    box-shadow: 0 4px 15px rgba(51, 92, 103, 0.1);
}

.nav-pills .nav-link {
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.nav-pills .nav-link.active {
    background: linear-gradient(135deg, var(--admin-primary), #4a7c8a);
}

.contact-item, .status-item, .info-item {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

.section-header {
    border-bottom: 1px solid #e3e6f0;
    padding-bottom: 0.5rem;
}
</style>

<!-- Add JavaScript for real-time preview updates -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update previews in real-time
    document.getElementById('site_name').addEventListener('input', function() {
        document.getElementById('preview-name').textContent = this.value || 'Hudson Furnishing';
    });
    
    document.getElementById('site_tagline').addEventListener('input', function() {
        document.getElementById('preview-tagline').textContent = this.value || 'Nội thất cao cấp cho mọi không gian';
    });
    
    document.getElementById('site_description').addEventListener('input', function() {
        const text = this.value || 'Hudson Furnishing cung cấp nội thất cao cấp cho mọi phòng trong ngôi nhà của bạn...';
        document.getElementById('preview-description').textContent = text.substring(0, 100) + (text.length > 100 ? '...' : '');
    });
    
    // Contact preview updates
    document.getElementById('contact_email').addEventListener('input', function() {
        document.getElementById('preview-email').textContent = this.value || 'info@hudsonfurnishing.vn';
    });
    
    document.getElementById('contact_phone').addEventListener('input', function() {
        document.getElementById('preview-phone').textContent = this.value || '+84 (0) 123 45 67 89';
    });
    
    document.getElementById('contact_address').addEventListener('input', function() {
        const text = this.value || '123 Đường Nội Thất, Quận Thiết Kế, TP.HCM';
        document.getElementById('preview-address').textContent = text.substring(0, 50) + (text.length > 50 ? '...' : '');
    });
    
    document.getElementById('business_hours').addEventListener('input', function() {
        const text = this.value || 'T2 - T6: 8:00 - 18:00';
        document.getElementById('preview-hours').textContent = text.substring(0, 30) + (text.length > 30 ? '...' : '');
    });
});
</script>
@endsection
