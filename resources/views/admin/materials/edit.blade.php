@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Vật Liệu: ' . $material->name)

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Chỉnh Sửa Vật Liệu: {{ $material->name }}</h6>
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

        {{-- Form Chỉnh Sửa --}}
        <form action="{{ route('admin.materials.update', $material) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Bắt buộc phải có để Laravel hiểu đây là phương thức PUT/PATCH cho việc UPDATE --}}
            @method('PUT') 

            {{-- Trường Tên Vật Liệu (name) --}}
            <div class="form-group">
                <label for="name">Tên Vật Liệu (<span class="text-danger">*</span>)</label>
                {{-- Dùng old() ưu tiên, nếu không có thì lấy giá trị từ $material->name --}}
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name', $material->name) }}" 
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
                >{{ old('description', $material->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Trường Ảnh Đại Diện (image) --}}
            <div class="form-group">
                <label>Ảnh Hiện Tại</label>
                <div class="mb-2">
                    @if ($material->image)
                        <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->name }}" style="max-width: 150px; border: 1px solid #ccc;">
                        <small class="d-block text-muted mt-1">File: {{ $material->image }}</small>
                    @else
                        <p class="text-muted">Chưa có ảnh đại diện.</p>
                    @endif
                </div>
                
                <label for="image">Thay Đổi Ảnh Đại Diện</label>
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    class="form-control-file @error('image') is-invalid @enderror"
                >
                <small class="form-text text-muted">Chọn file mới để thay đổi ảnh. Để trống nếu không muốn thay đổi.</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-sync-alt"></i> Cập Nhật Vật Liệu
            </button>
        </form>

    </div>
</div>

@endsection