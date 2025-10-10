@extends('layouts.admin')

@section('title', 'Tạo Ưu Đãi Mới')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Tạo Ưu Đãi Mới</h6>
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

        <form action="{{ route('admin.offers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    {{-- Trường Title --}}
                    <div class="form-group">
                        <label for="title">Tiêu Đề Ưu Đãi (<span class="text-danger">*</span>)</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường Description --}}
                    <div class="form-group">
                        <label for="description">Mô Tả</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường Start Date --}}
                    <div class="form-group">
                        <label for="start_date">Ngày Bắt Đầu (<span class="text-danger">*</span>)</label>
                        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" required>
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường End Date --}}
                    <div class="form-group">
                        <label for="end_date">Ngày Kết Thúc (<span class="text-danger">*</span>)</label>
                        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" required>
                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    {{-- Trường Discount Type --}}
                    <div class="form-group">
                        <label for="discount_type">Loại Giảm Giá (<span class="text-danger">*</span>)</label>
                        <select name="discount_type" id="discount_type" class="form-control @error('discount_type') is-invalid @enderror" required>
                            <option value="">-- Chọn Loại --</option>
                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Phần Trăm (%)</option>
                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Giá Trị Cố Định (VNĐ)</option>
                        </select>
                        @error('discount_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường Discount Value --}}
                    <div class="form-group">
                        <label for="discount_value">Giá Trị Giảm (<span class="text-danger">*</span>)</label>
                        <input type="number" step="0.01" name="discount_value" id="discount_value" class="form-control @error('discount_value') is-invalid @enderror" value="{{ old('discount_value') }}" required>
                        @error('discount_value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường Status --}}
                    <div class="form-group">
                        <label for="status">Trạng Thái (<span class="text-danger">*</span>)</label>
                        <select name="status" class="form-select">
                            @foreach(StatusHelper::getStatusOptions() as $key => $option)
                                <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                    {{ $option['label'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường Image --}}
                    <div class="form-group">
                        <label for="image">Hình Ảnh (Tùy chọn)</label>
                        <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-icon-split mt-3">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text">Tạo Ưu Đãi</span>
            </button>
        </form>
    </div>
</div>

@endsection
