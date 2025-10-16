@extends('layouts.app')

@section('title', 'Chỉnh Sửa Thông Tin Cá Nhân - Hudson Furnishing')
@section('page-title', 'Chỉnh Sửa Thông Tin Cá Nhân')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0 font-weight-bold">
                        <i class="fas fa-user-edit me-2"></i>Thông Tin Cá Nhân
                    </h5>
                </div>
                <div class="card-body">
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Thành công!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('password_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-key me-2"></i>
                            <strong>Đổi mật khẩu thành công!</strong> {{ session('password_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Có lỗi xảy ra!</strong> Vui lòng kiểm tra lại thông tin.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Thông tin cá nhân -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-user me-2"></i>Thông Tin Cơ Bản
                        </h6>
                        
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold">Họ và Tên <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $user->name) }}"
                                               required
                                               placeholder="Nhập họ và tên">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $user->email) }}"
                                               required
                                               placeholder="Nhập địa chỉ email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label fw-bold">Tên Người Dùng</label>
                                        <input type="text" 
                                               class="form-control @error('username') is-invalid @enderror" 
                                               id="username" 
                                               name="username" 
                                               value="{{ old('username', $user->username) }}"
                                               placeholder="Nhập tên người dùng (tùy chọn)">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Vai Trò</label>
                                        <input type="text" 
                                               class="form-control" 
                                               value="{{ $user->role ? $user->role->display_name : 'Khách' }}" 
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" id="updateInfoBtn">
                                    <i class="fas fa-save me-2"></i>Cập Nhật Thông Tin
                                </button>
                            </div>
                        </form>
                    </div>

                    <hr class="my-4">

                    <!-- Đổi mật khẩu -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-key me-2"></i>Đổi Mật Khẩu
                        </h6>
                        
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label fw-bold">Mật Khẩu Hiện Tại <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control @error('current_password') is-invalid @enderror" 
                                               id="current_password" 
                                               name="current_password" 
                                               required
                                               placeholder="Nhập mật khẩu hiện tại">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label fw-bold">Mật Khẩu Mới <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control @error('new_password') is-invalid @enderror" 
                                               id="new_password" 
                                               name="new_password" 
                                               required
                                               placeholder="Nhập mật khẩu mới">
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label fw-bold">Xác Nhận Mật Khẩu Mới <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control" 
                                               id="new_password_confirmation" 
                                               name="new_password_confirmation" 
                                               required
                                               placeholder="Xác nhận mật khẩu mới">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-muted">Yêu Cầu Mật Khẩu</label>
                                        <div class="form-text">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Mật khẩu phải có ít nhất 8 ký tự
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-warning" id="updatePasswordBtn">
                                    <i class="fas fa-key me-2"></i>Đổi Mật Khẩu
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-header {
    background: linear-gradient(135deg, var(--primary-color), #4a7c8a) !important;
    color: white !important;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color), #4a7c8a);
    border: none;
    border-radius: 8px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #4a7c8a, var(--primary-color));
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(51, 92, 103, 0.3);
}

.btn-warning {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    border: none;
    border-radius: 8px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    color: white;
    transition: all 0.3s ease;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #e67e22, #d35400);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(230, 126, 34, 0.3);
    color: white;
}

.form-control:focus {
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 0.2rem rgba(224, 159, 62, 0.25);
}

.text-primary {
    color: var(--primary-color) !important;
}

.alert {
    border-radius: 10px;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.alert-success {
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    color: white;
}

.alert-danger {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}

.alert .btn-close {
    filter: invert(1);
}
</style>

<script>
// Ultra simple script - NO loading states, NO complex logic
document.addEventListener('DOMContentLoaded', function() {
    console.log('Simple profile page loaded');
    
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            if (alert && alert.classList.contains('show')) {
                alert.classList.remove('show');
                setTimeout(function() {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 150);
            }
        });
    }, 5000);

    // Ensure buttons are always enabled and have correct text
    const updateInfoBtn = document.getElementById('updateInfoBtn');
    const updatePasswordBtn = document.getElementById('updatePasswordBtn');

    if (updateInfoBtn) {
        updateInfoBtn.disabled = false;
        updateInfoBtn.innerHTML = '<i class="fas fa-save me-2"></i>Cập Nhật Thông Tin';
    }

    if (updatePasswordBtn) {
        updatePasswordBtn.disabled = false;
        updatePasswordBtn.innerHTML = '<i class="fas fa-key me-2"></i>Đổi Mật Khẩu';
    }
});

// Additional safety net
setTimeout(function() {
    const updateInfoBtn = document.getElementById('updateInfoBtn');
    const updatePasswordBtn = document.getElementById('updatePasswordBtn');
    
    if (updateInfoBtn) {
        updateInfoBtn.disabled = false;
        updateInfoBtn.innerHTML = '<i class="fas fa-save me-2"></i>Cập Nhật Thông Tin';
    }
    
    if (updatePasswordBtn) {
        updatePasswordBtn.disabled = false;
        updatePasswordBtn.innerHTML = '<i class="fas fa-key me-2"></i>Đổi Mật Khẩu';
    }
}, 1000);
</script>
@endsection
