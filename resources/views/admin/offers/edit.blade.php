@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Ưu Đãi: ' . $offer->title)

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Chỉnh Sửa Ưu Đãi: {{ $offer->title }}</h6>
        <a href="{{ route('admin.offers.index') }}" class="btn btn-info btn-sm">
            <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách
        </a>
    </div>
    <div class="card-body">
        
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

        <form action="{{ route('admin.offers.update', $offer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    {{-- Trường Title --}}
                    <div class="form-group">
                        <label for="title">Tiêu Đề Ưu Đãi (<span class="text-danger">*</span>)</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $offer->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường Type --}}
                    <div class="form-group">
                        <label for="type">Loại Ưu Đãi (<span class="text-danger">*</span>)</label>
                        <select name="discount_type" id="type" class="form-control @error('discount_type') is-invalid @enderror" required>
                            <option value="">-- Chọn Loại --</option>
                            <option value="percentage" {{ old('type', $offer->type) == 'percentage' ? 'selected' : '' }}>Phần Trăm (%)</option>
                            <option value="fixed" {{ old('type', $offer->type) == 'fixed' ? 'selected' : '' }}>Giá Trị Cố Định</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    {{-- Trường Value --}}
                    <div class="form-group">
                        <label for="value">Giá Trị Ưu Đãi (<span class="text-danger">*</span>)</label>
                        <input type="number" name="discount_value" id="value" class="form-control @error('discount_value') is-invalid @enderror" value="{{ old('value', $offer->value) }}" min="0" step="0.01" required>
                        @error('value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    {{-- Trường Start Date --}}
                    <div class="form-group">
                        <label for="start_date">Ngày Bắt Đầu (<span class="text-danger">*</span>)</label>
                        {{-- Định dạng ngày giờ cho input datetime-local --}}
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', \Carbon\Carbon::parse($offer->start_date)->format('Y-m-d\TH:i')) }}" required>
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường End Date --}}
                    <div class="form-group">
                        <label for="end_date">Ngày Kết Thúc (<span class="text-danger">*</span>)</label>
                        <input type="datetime-local" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', \Carbon\Carbon::parse($offer->end_date)->format('Y-m-d\TH:i')) }}" required>
                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    {{-- Trường Image --}}
                    <div class="form-group">
                        <label>Ảnh Hiện Tại</label>
                        <div class="mb-2">
                            @if ($offer->image)
                                <img src="{{ asset('storage/' . $offer->image) }}" alt="Offer Image" style="max-width: 150px; border: 1px solid #ccc;">
                            @else
                                <p class="text-muted">Chưa có ảnh.</p>
                            @endif
                        </div>
                        <label for="image">Thay Đổi Ảnh Đại Diện</label>
                        <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng Thái (<span class="text-danger">*</span>)</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ngừng Hoạt Động</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Trường Description --}}
            <div class="form-group">
                <label for="description">Mô Tả Chi Tiết</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $offer->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Trường Product IDs (Sản phẩm áp dụng) --}}
            
            
            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-sync-alt"></i> Cập Nhật Ưu Đãi
            </button>
        </form>

    </div>
</div>

@endsection