@extends('layouts.admin')

@section('title', 'Quản Lý Thư Viện - Hudson Furnishing')
@section('page-title', 'Quản Lý Thư Viện')

@section('page-actions')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
        <i class="fas fa-upload me-2"></i>Đăng Tải Hình Ảnh
    </button>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tất Cả Hình Ảnh</h6>
    </div>
    <div class="card-body">
        <!-- Standalone Filter -->
        <x-standalone-filter 
            :formAction="route('admin.gallery.index')" 
            :filterConfig="[
                'filters' => [
                    ['type' => 'text', 'name' => 'search', 'placeholder' => 'Tìm tên sản phẩm...', 'label' => 'Tìm kiếm'],
                    ['type' => 'select', 'name' => 'product', 'placeholder' => 'Tất cả sản phẩm', 'label' => 'Sản phẩm', 'options' => $products->pluck('name', 'id')->toArray()],
                    ['type' => 'select', 'name' => 'is_primary', 'placeholder' => 'Tất cả', 'label' => 'Loại hình', 'options' => ['1' => 'Hình chính', '0' => 'Hình phụ']],
                    ['type' => 'date', 'name' => 'created_from', 'label' => 'Từ ngày']
                ]
            ]"
        />

        <!-- Gallery Grid -->
        <div class="row">
            @forelse($images as $image)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/uploads/' . $image->url) }}" 
                             class="card-img-top" 
                             alt="{{ $image->alt_text }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">{{ $image->product->name }}</h6>
                            <p class="card-text text-muted">{{ $image->alt_text }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if($image->is_primary)
                                    <span class="badge bg-primary">Hình Chính</span>
                                @else
                                    <form method="POST" action="{{ route('admin.gallery.primary', $image) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" 
                                      class="d-inline form-confirm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-images fa-3x text-muted mb-3"></i>
                        <h4>Không tìm thấy hình ảnh nào</h4>
                        <p class="text-muted">Đăng tải một số hình ảnh để bắt đầu!</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                            Đăng Tải Hình Ảnh
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $images->links() }}
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đăng Tải Hình Ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Sản Phẩm</label>
                        <select class="form-select" id="product_id" name="product_id" required>
                            <option value="">Chọn Sản Phẩm</option>
                            @foreach(\App\Models\Product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="images" class="form-label">Hình Ảnh</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" required>
                        <div class="form-text">Bạn có thể chọn nhiều hình ảnh cùng lúc.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="alt_text" class="form-label">Alt Text Hình Ảnh</label>
                        <input type="text" class="form-control" id="alt_text" name="alt_text" placeholder="Mô tả hình ảnh">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Đăng Tải</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
