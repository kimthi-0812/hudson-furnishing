@extends('layouts.admin')

@section('title', 'Thêm Vật Liệu Mới')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Thêm Vật Liệu Mới</h6>
        <a href="{{ route('admin.materials.index') }}" class="btn btn-info btn-sm">
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

        {{-- Form Thêm Mới --}}
        {{-- Bắt buộc thêm enctype="multipart/form-data" để xử lý upload file --}}
        <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Trường Tên Vật Liệu (name) --}}
            <div class="form-group">
                <label for="name">Tên Vật Liệu (<span class="text-danger">*</span>)</label>
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

            {{-- Trường Mô Tả (description) --}}
            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-control @error('description') is-invalid @enderror" 
                    rows="4"
                >{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Trường Ảnh Đại Diện (image) --}}
            <div class="form-group">
                <label for="image">Ảnh Đại Diện</label>
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    class="form-control-file @error('image') is-invalid @enderror"
                >
                <small class="form-text text-muted">Tùy chọn. Định dạng: jpeg, png, jpg, gif | Kích thước tối đa 2MB.</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-save"></i> Lưu Vật Liệu
            </button>
        </form>

    </div>
</div>

@endsection