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
                        <p class="text-muted">Đăng nhập để có trải nghiệm tốt nhất</p>
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
                                required
                                autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="input-group gap-1">
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Nhập mật khẩu"
                                    required>
                                <button type="button" 
                                    class="btn btn-outline-secondary" 
                                    id="togglePassword">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                class="form-check-input" 
                                id="remember" 
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Nhớ thông tin đăng nhập</label>
                        </div>
                                
                        <button type="submit" class="btn btn-primary w-100 mb-3">Đăng Nhập</button>

                        <div class="text-center">
                            <a href="{{ route('home') }}" class="text-decoration-none">
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
@endsection
