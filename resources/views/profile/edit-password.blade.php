@extends('layouts.app')

@section('title', 'Đổi Mật Khẩu - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3>Đổi Mật Khẩu</h3>
                        <p class="text-muted">Đảm bảo mật khẩu mới an toàn và dễ nhớ</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        {{-- Mật khẩu hiện tại --}}
                        <div class="mb-3 position-relative">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password"
                                class="form-control pe-5 @error('current_password') is-invalid @enderror"
                                id="current_password"
                                name="current_password"
                                placeholder="Nhập mật khẩu hiện tại"
                            >
                            <button type="button"
                                class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent px-3 mt-3"
                                id="toggleCurrentPassword" tabindex="-1">
                                <i class="fas fa-eye" id="toggleCurrentPasswordIcon"></i>
                            </button>
                            @error('current_password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mật khẩu mới --}}
                        <div class="mb-3 position-relative">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <input type="password"
                                class="form-control pe-5 @error('new_password') is-invalid @enderror"
                                id="new_password"
                                name="new_password"
                                placeholder="Nhập mật khẩu mới"
                            >
                            <button type="button"
                                class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent px-3 mt-3"
                                id="togglePassword" tabindex="-1">
                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                            </button>
                            @error('new_password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Tối thiểu 8 ký tự, phải có chữ cái, không được toàn là số</div>
                        </div>

                        {{-- Xác nhận mật khẩu --}}
                        <div class="mb-3 position-relative">
                            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password"
                                class="form-control pe-5"
                                id="new_password_confirmation"
                                name="new_password_confirmation"
                                placeholder="Nhập lại mật khẩu mới"
                            >
                            <button type="button"
                                class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent px-3 mt-3"
                                id="togglePasswordConfirm" tabindex="-1">
                                <i class="fas fa-eye" id="togglePasswordConfirmIcon"></i>
                            </button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                            
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

    setupTogglePassword('toggleCurrentPassword', 'current_password', 'toggleCurrentPasswordIcon');
    setupTogglePassword('togglePassword', 'new_password', 'togglePasswordIcon');
    setupTogglePassword('togglePasswordConfirm', 'new_password_confirmation', 'togglePasswordConfirmIcon');
});
</script>

{{-- CSS riêng --}}
<style>
#current_password, #new_password, #new_password_confirmation {
    padding-right: 3rem; /* chừa chỗ cho icon bên trong */
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
