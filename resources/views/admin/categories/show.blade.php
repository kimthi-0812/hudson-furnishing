@extends('layouts.admin')

@section('title', 'Chi Tiết Danh Mục: ' . $category->name)

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Chi Tiết Danh Mục: {{ $category->name }}</h6>
        <div>
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-secondary btn-sm text-light">
                <i class="fas fa-edit"></i> Chỉnh Sửa
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm text-light">
                <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p><strong>ID Danh Mục:</strong> {{ $category->id }}</p>
                <p><strong>Tên Danh Mục:</strong> {{ $category->name }}</p>
                <p><strong>Slug:</strong> {{ $category->slug }}</p>
                {{-- Giả định có mối quan hệ category->section --}}
                <p><strong>Thuộc Section:</strong> 
                    {{ $category->section->name ?? 'Không xác định' }}
                    @if ($category->section)
                        <small class="text-muted">(ID: {{ $category->section_id }})</small>
                    @endif
                </p>
                <p><strong>Mô Tả:</strong> {{ $category->description ?? 'Không có mô tả' }}</p>
                <p><strong>Ngày Tạo:</strong> {{ $category->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

---

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Sản Phẩm Thuộc Danh Mục Này ({{ $products->total() ?? 0 }})</h6>
    </div>
    <div class="card-body">
        
        @if ($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Section</th>
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
                            <td>{{ $product->section->name ?? 'N/A' }}</td>
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
            
            {{-- Hiển thị phân trang --}}
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Không có sản phẩm nào thuộc danh mục này.
            </div>
        @endif

    </div>
</div>

@endsection