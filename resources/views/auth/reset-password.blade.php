@extends('layouts.app')

@section('title', 'Đặt Lại Mật Khẩu - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3>Đặt Lại Mật Khẩu</h3>
                        <p class="text-muted">Nhập mật khẩu mới để đăng nhập</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ request('email') }}">

                        {{-- Mật khẩu mới --}}
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input type="password"
                                class="form-control pe-5 @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="Nhập mật khẩu mới"
                            >
                            <button type="button"
                                class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent px-3 mt-1"
                                id="togglePassword" tabindex="-1">
                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Tối thiểu 8 ký tự, phải có chữ cái, không được toàn là số</div>
                        </div>

                        {{-- Xác nhận mật khẩu --}}
                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password"
                                class="form-control pe-5"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Nhập lại mật khẩu mới"
                            >
                            <button type="button"
                                class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent px-3 mt-3"
                                id="togglePasswordConfirm" tabindex="-1">
                                <i class="fas fa-eye" id="togglePasswordConfirmIcon"></i>
                            </button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
                            <a href="{{ route('login') }}" class="text-decoration-none text-light btn btn-secondary">Quay Lại Đăng nhập</a>
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
    function setupTogglePassword(toggleId, inputId, iconId) {
        const toggle = document.getElementById(toggleId);
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        toggle.addEventListener('click', function () {
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    }

    setupTogglePassword('togglePassword', 'password', 'togglePasswordIcon');
    setupTogglePassword('togglePasswordConfirm', 'password_confirmation', 'togglePasswordConfirmIcon');
});
</script>

{{-- CSS riêng --}}
<style>
#password, #password_confirmation {
    padding-right: 3rem; /* chừa chỗ cho icon */
}
.btn.bg-transparent {
    color: #6c757d;
    cursor: pointer;
}
.btn.bg-transparent:hover {
    color: #43727F;
}
</style>
@endsection
