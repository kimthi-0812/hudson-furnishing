@extends('layouts.admin')

@section('title', 'Chi Tiết Slide Carousel - Hudson Furnishing')
@section('page-title', 'Chi Tiết Slide Carousel')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-light">Thông Tin Slide</h6>
                <div>
                    <a href="{{ route('admin.carousels.edit', $carousel) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Sửa
                    </a>
                    <a href="{{ route('admin.carousels.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Quay lại
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu đề:</label>
                            <h4 class="text-primary">{{ $carousel->title }}</h4>
                        </div>
                        
                        @if($carousel->description)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Mô tả:</label>
                                <p class="border rounded p-3 bg-light">{{ $carousel->description }}</p>
                            </div>
                        @endif
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Văn bản nút:</label>
                                    <p class="form-control-plaintext">
                                        @if($carousel->button_text)
                                            <span class="badge bg-primary">{{ $carousel->button_text }}</span>
                                        @else
                                            <span class="text-muted">Không có</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">URL nút:</label>
                                    <p class="form-control-plaintext">
                                        @if($carousel->button_url)
                                            <a href="{{ $carousel->button_url }}" target="_blank" class="text-decoration-none">
                                                {{ Str::limit($carousel->button_url, 50) }}
                                                <i class="fas fa-external-link-alt ms-1"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">Không có</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Thứ tự:</label>
                                    <p class="form-control-plaintext">
                                        <span class="badge bg-secondary">{{ $carousel->sort_order }}</span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Trạng thái:</label>
                                    <p class="form-control-plaintext">
                                        <span class="badge bg-{{ $carousel->is_active ? 'success' : 'secondary' }}">
                                            {{ $carousel->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Ngày tạo:</label>
                                    <p class="form-control-plaintext">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $carousel->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Cập nhật lần cuối:</label>
                                    <p class="form-control-plaintext">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $carousel->updated_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Hình ảnh:</label>
                            <div class="text-center">
                                <img src="{{ asset('storage/carousels/' . $carousel->image) }}" 
                                     alt="{{ $carousel->title }}"
                                     class="img-fluid rounded shadow"
                                     style="max-height: 300px;">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('admin.carousels.toggle-status', $carousel) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="btn btn-{{ $carousel->is_active ? 'warning' : 'success' }}">
                                <i class="fas fa-{{ $carousel->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $carousel->is_active ? 'Vô hiệu hóa' : 'Kích hoạt' }}
                            </button>
                        </form>
                        
                        <div>
                            <form action="{{ route('admin.carousels.destroy', $carousel) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa slide này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-2"></i>Xóa slide
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
