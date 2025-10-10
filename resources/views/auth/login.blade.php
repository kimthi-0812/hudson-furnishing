@extends('layouts.app')

@section('title', 'Đăng Nhập - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img src="{{ isset($siteSettings['logo']) && $siteSettings['logo']
                                ? Storage::url($siteSettings['logo']) 
                                : asset('images/logo.png') }}" 
                        alt="Hudson Furnishing" height="40" class="mb-3">
                        <h3>Đăng Nhập</h3>
                        <p class="text-muted">Đăng nhập để có trải nghiệm tốt hơn</p>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf
                    
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Nhập email của bạn" 
                                autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password"
                                class="form-control pe-5 @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="Nhập mật khẩu"
                                >
                                
                            <button type="button"
                                class="btn position-absolute end-0 me-3 border-0 bg-transparent toggle-password-btn-fixed"
                                id="togglePassword" tabindex="-1">
                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                            </button>
                            
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 d-flex justify-content-between">
                            <a href= "{{ route('register') }}"
                                class="text-decoration-none text-primary">Đăng Ký
                            </a>
                            
                            {{-- <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">Quên mật khẩu?</a> --}}
                            
                        </div>
                                
                        <button type="submit" class="btn btn-primary w-100 mb-3">Đăng Nhập</button>

                        <div class="text-center">
                            <a href="{{ route('home') }}" class="text-decoration-none text-primary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Quay Lại Trang Chủ
                            </a>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script toggle password --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Đổi icon
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>
<style>
/* Điều chỉnh padding-right cho input để chừa chỗ cho icon */
#password {
    padding-right: 2.5rem; 
}

/* Quy tắc căn chỉnh vị trí cố định cho nút toggle */
.toggle-password-btn-fixed {
    /* Quan trọng: Bù trừ cho label. 38px là giá trị tối ưu */
    top: 38px !important; 
    /* Đảm bảo không có bất kỳ transform nào (từ translate-middle-y) ảnh hưởng */
    transform: none !important; 

    /* Giữ nguyên các thuộc tính kiểu dáng khác */
    border: none;
    background: none;
    color: #6c757d;
    cursor: pointer;
    /* Đặt z-index cao hơn input để nút luôn click được */
    z-index: 10; 
}

.toggle-password-btn-fixed:hover {
    color: #43727F; /* màu primary khi hover */
}

/* Responsive điều chỉnh nhỏ cho icon */
@media (max-width: 576px) {
    .toggle-password-btn-fixed {
        padding: 0.4rem 0.6rem;
    }
}
</style>
@endsection