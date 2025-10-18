@extends('layouts.admin')

@section('title', 'Quản Lý Thư Viện Độc Lập - Hudson Furnishing')
@section('page-title', 'Quản Lý Thư Viện Độc Lập')

@section('page-actions')
    <a href="{{ route('admin.independent-gallery.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm Hình Ảnh Mới
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tất Cả Hình Ảnh Thư Viện</h6>
    </div>
    <div class="card-body">
        <!-- Standalone Filter -->
        <x-standalone-filter 
            :formAction="route('admin.independent-gallery.index')" 
            :filterConfig="[
                'filters' => [
                    ['type' => 'text', 'name' => 'search', 'placeholder' => 'Tìm tiêu đề...', 'label' => 'Tìm kiếm'],
                    ['type' => 'select', 'name' => 'status', 'placeholder' => 'Tất cả trạng thái', 'label' => 'Trạng thái', 'options' => ['active' => 'Hoạt động', 'inactive' => 'Không hoạt động']],
                    ['type' => 'select', 'name' => 'is_primary', 'placeholder' => 'Tất cả', 'label' => 'Loại hình', 'options' => ['1' => 'Hình chính', '0' => 'Hình phụ']],
                    ['type' => 'date', 'name' => 'created_from', 'label' => 'Từ ngày']
                ]
            ]"
        />

        <!-- Gallery Grid -->
        <div class="row">
            @forelse($galleries as $gallery)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            <img src="{{ asset('storage/gallery/' . $gallery->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $gallery->title }}"
                                 style="height: 200px; object-fit: cover;">
                            
                            @if($gallery->is_primary)
                                <span class="position-absolute top-0 end-0 badge bg-warning m-2">
                                    <i class="fas fa-star"></i> Chính
                                </span>
                            @endif
                            
                            <span class="position-absolute top-0 start-0 badge bg-{{ $gallery->status === 'active' ? 'success' : 'secondary' }} m-2">
                                {{ $gallery->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                            </span>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title">{{ Str::limit($gallery->title, 30) }}</h6>
                            @if($gallery->description)
                                <p class="card-text text-muted small flex-grow-1">
                                    {{ Str::limit($gallery->description, 80) }}
                                </p>
                            @endif
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        {{ $gallery->created_at->format('d/m/Y') }}
                                    </small>
                                    
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.independent-gallery.show', $gallery) }}" 
                                           class="btn btn-outline-info" title="Xem">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.independent-gallery.edit', $gallery) }}" 
                                           class="btn btn-outline-primary" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if(!$gallery->is_primary)
                                            <form action="{{ route('admin.independent-gallery.set-primary', $gallery) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-warning" title="Đặt làm chính">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.independent-gallery.destroy', $gallery) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa hình ảnh này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-images fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Chưa có hình ảnh nào</h5>
                        <p class="text-muted">Hãy thêm hình ảnh đầu tiên vào thư viện.</p>
                        <a href="{{ route('admin.independent-gallery.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Thêm Hình Ảnh
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        {{ $galleries->links() }}
    </div>
</div>
@endsection
