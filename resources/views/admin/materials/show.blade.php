@extends('layouts.admin')

@section('title', 'Chi Tiết Vật Liệu: ' . $material->name)

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Chi Tiết Vật Liệu: {{ $material->name }}</h6>
        <div>
            <a href="{{ route('admin.materials.edit', $material) }}" class="btn btn-secondary btn-sm text-light">
                <i class="fas fa-edit"></i> Chỉnh Sửa
            </a>
            <a href="{{ route('admin.materials.index') }}" class="btn btn-secondary btn-sm text-light">
                <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                @if ($material->image)
                    <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->name }}" class="img-fluid rounded" style="max-height: 250px;">
                @else
                    <p class="text-muted">Không có ảnh đại diện</p>
                @endif
            </div>
            <div class="col-md-8">
                <p><strong>ID Vật Liệu:</strong> {{ $material->id }}</p>
                <p><strong>Tên Vật Liệu:</strong> {{ $material->name }}</p>
                <p><strong>Slug:</strong> {{ $material->slug }}</p>
                <p><strong>Mô Tả:</strong> {{ $material->description ?? 'Không có mô tả' }}</p>
                <p><strong>Ngày Tạo:</strong> {{ $material->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Ngày Cập Nhật:</strong> {{ $material->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

---

<div class="card shadow mb-4">
    <div class="card-header py-3">
        {{-- Sử dụng $products để lấy tổng số mục --}}
        <h6 class="m-0 font-weight-bold text-light">Sản Phẩm Sử Dụng Vật Liệu Này ({{ $products->total() ?? 0 }})</h6>
    </div>
    <div class="card-body">
        
        @if ($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Danh Mục</th>
                            <th>Thương Hiệu</th>
                            <th>Giá</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Lặp qua biến $products đã được phân trang --}}
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>{{ $product->brand->name ?? 'N/A' }}</td>
                            <td>{{ number_format($product->price) }} VNĐ</td>
                            <td>
                                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-secondary text-light">Xem</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Đã sửa lỗi: Gọi links() trên đối tượng $products (Paginator) --}}
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Không có sản phẩm nào sử dụng vật liệu này.
            </div>
        @endif

    </div>
</div>

@endsection