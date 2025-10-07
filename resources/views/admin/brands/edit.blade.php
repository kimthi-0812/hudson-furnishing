@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Thương Hiệu: ' . $brand->name)

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Chỉnh Sửa Thương Hiệu: {{ $brand->name }}</h6>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-info btn-sm">
            <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách
        </a>
    </div>
    <div class="card-body">

        {{-- Hiển thị thông báo lỗi Validation nếu có --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                Vui lòng kiểm tra lại các lỗi sau:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Chỉnh Sửa. Giả định route là admin.brands.update --}}
        <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Bắt buộc phải có để Laravel hiểu đây là phương thức PUT/PATCH --}}
            @method('PUT') 

            {{-- Trường Tên Thương Hiệu (name) --}}
            <div class="form-group">
                <label for="name">Tên Thương Hiệu (<span class="text-danger">*</span>)</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name', $brand->name) }}" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Trường Logo (logo) --}}
            <div class="form-group">
                <label>Logo Hiện Tại</label>
                <div class="mb-2">
                    @if ($brand->logo)
                        {{-- Giả định logo được lưu trong thư mục storage/app/public/brands --}}
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }} Logo" style="max-width: 150px; border: 1px solid #ccc;">
                        <small class="d-block text-muted mt-1">File: {{ $brand->logo }}</small>
                    @else
                        <p class="text-muted">Chưa có logo.</p>
                    @endif
                </div>
                
                <label for="logo">Thay Đổi Logo</label>
                <input 
                    type="file" 
                    name="logo" 
                    id="logo" 
                    class="form-control-file @error('logo') is-invalid @enderror"
                >
                <small class="form-text text-muted">Chọn file mới để thay đổi logo. Để trống nếu không muốn thay đổi.</small>
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-sync-alt"></i> Cập Nhật Thương Hiệu
            </button>
        </form>

    </div>
</div>

@endsection