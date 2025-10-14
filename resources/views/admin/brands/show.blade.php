@extends('layouts.admin')

@section('title', 'Chi Tiết Thương Hiệu: ' . $brand->name)

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Chi Tiết Thương Hiệu: {{ $brand->name }}</h6>
        <div>
            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Chỉnh Sửa
            </a>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-info btn-sm">
                <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                @if ($brand->logo)
                    <img src="{{ asset('storage/uploads/' . $brand->logo) }}" alt="{{ $brand->name }} Logo" class="img-fluid rounded" style="max-height: 150px; border: 1px solid #ccc;">
                @else
                    <p class="text-muted">Không có Logo</p>
                @endif
            </div>
            <div class="col-md-9">
                <p><strong>ID Thương Hiệu:</strong> {{ $brand->id }}</p>
                <p><strong>Tên Thương Hiệu:</strong> {{ $brand->name }}</p>
                <p><strong>Slug:</strong> {{ $brand->slug }}</p>
                <p><strong>Ngày Tạo:</strong> {{ $brand->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Ngày Cập Nhật:</strong> {{ $brand->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

---

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Sản Phẩm Thuộc Thương Hiệu Này ({{ $products->total() ?? 0 }})</h6>
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
                            <td>{{ number_format($product->price) }} VNĐ</td>
                            <td>
                                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info">Xem</a>
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
                <i class="fas fa-info-circle"></i> Không có sản phẩm nào thuộc thương hiệu này.
            </div>
        @endif

    </div>
</div>

@endsection


Hai file này sẽ hoàn thiện chức năng xem chi tiết thương hiệu, giúp bạn dễ dàng quản lý sản phẩm liên quan!