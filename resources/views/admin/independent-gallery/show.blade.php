@extends('layouts.admin')

@section('title', 'Chi Tiết Hình Ảnh Thư Viện - Hudson Furnishing')
@section('page-title', 'Chi Tiết Hình Ảnh Thư Viện')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-light">Thông Tin Hình Ảnh</h6>
                <div>
                    <a href="{{ route('admin.independent-gallery.edit', $gallery) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Sửa
                    </a>
                    <a href="{{ route('admin.independent-gallery.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Quay lại
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu đề:</label>
                            <p class="form-control-plaintext">{{ $gallery->title }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Trạng thái:</label>
                            <span class="badge bg-{{ $gallery->status === 'active' ? 'success' : 'secondary' }}">
                                {{ $gallery->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Loại hình:</label>
                            @if($gallery->is_primary)
                                <span class="badge bg-warning">
                                    <i class="fas fa-star"></i> Hình ảnh chính
                                </span>
                            @else
                                <span class="badge bg-info">Hình ảnh phụ</span>
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ngày tạo:</label>
                            <p class="form-control-plaintext">{{ $gallery->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cập nhật lần cuối:</label>
                            <p class="form-control-plaintext">{{ $gallery->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Hình ảnh:</label>
                            <div class="text-center">
                                <img src="{{ asset('storage/gallery/' . $gallery->image) }}" 
                                     alt="{{ $gallery->title }}"
                                     class="img-fluid rounded shadow"
                                     style="max-height: 300px;">
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($gallery->description)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả:</label>
                        <div class="border rounded p-3 bg-light">
                            {{ $gallery->description }}
                        </div>
                    </div>
                @endif
                
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-between">
                        @if(!$gallery->is_primary)
                            <form action="{{ route('admin.independent-gallery.set-primary', $gallery) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-star me-2"></i>Đặt làm hình ảnh chính
                                </button>
                            </form>
                        @else
                            <div></div>
                        @endif
                        
                        <div>
                            <form action="{{ route('admin.independent-gallery.destroy', $gallery) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa hình ảnh này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-2"></i>Xóa hình ảnh
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
