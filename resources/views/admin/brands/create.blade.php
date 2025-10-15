@extends('layouts.admin')

@section('title', 'Thêm Thương Hiệu Mới')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Thêm Thương Hiệu Mới</h6>
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

        {{-- Form Thêm Mới. Giả định route là admin.brands.store --}}
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Trường Tên Thương Hiệu (name) --}}
            <div class="form-group">
                <label for="name">Tên Thương Hiệu (<span class="text-danger">*</span>)</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name') }}" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Trường Logo (logo) --}}
            <div class="form-group">
                <div class="mb-3">
                    <x-image-upload 
                        name="logo"
                        label="Hình Ảnh Logo Thương Hiệu"
                        :multiple="false"
                        :required="false"
                        :existingImages="[]"  {{-- chưa có ảnh nào --}}
                        acceptedTypes="logo"
                        maxSize="2MB"
                    />
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="text-end">
                <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-save"></i> Lưu Thương Hiệu
            </button>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary btn-sm"> Hủy</a>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection