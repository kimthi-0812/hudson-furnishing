@extends('layouts.admin')

@section('title', 'Quản Lý Sản Phẩm - Hudson Furnishing')
@section('page-title', 'Quản Lý Sản Phẩm')

@section('page-actions')
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm Sản Phẩm Mới
    </a>
@endsection

@section('content')
@php use App\Helpers\StatusHelper; @endphp

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tất Cả Sản Phẩm</h6>
    </div>
    <div class="card-body">
        <!-- Search and Filter -->
        <div class="row mb-3">
            <div class="col-md-6 ">
                <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" 
                           placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        {{ request('status') 
                            ? (StatusHelper::getStatusOptions()[request('status')]['label'] ?? 'Không xác định') 
                            : 'Tất Cả Trạng Thái' }}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ request('status') === null || request('status') === '' ? 'active' : '' }}"
                            href="{{ request()->fullUrlWithQuery(['status' => '', 'page' => 1]) }}">
                                Tất Cả
                            </a>
                        </li>
                        @foreach(StatusHelper::getStatusOptions() as $key => $option)
                            <li>
                                <a class="dropdown-item {{ request('status') === $key ? 'active' : '' }}"
                                href="{{ request()->fullUrlWithQuery(['status' => $key, 'page' => 1]) }}">
                                    {{ $option['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="table-responsive">
            <table class="table table-bordered admin-table products-table">
                <thead>
                    <tr>
                        <th>Hình ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Khu vực</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Giá / Giá khuyến mãi</th>
                        <th>Số lượng tồn</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->images->count() > 0)
                                    <img src="{{ asset('uploads/' . $product->images->first()->url) }}" 
                                         alt="{{ $product->name }}" class="img-thumbnail admin-table-image">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center admin-table-image">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->section->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>
                                @if($product->sale_price)
                                    <small class="text-muted">{{ number_format($product->price, 0, ',', ',') }} ₫</small>/
                                    <span class="text-success">{{ number_format($product->sale_price, 0, ',', ',') }} ₫</span>                                    
                                @else
                                    {{ number_format($product->price, 0, ',', ',') }} ₫
                                @endif
                            </td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                @php
                                    $options = StatusHelper::getStatusOptions();
                                    $status = $product->status;
                                @endphp
                                <span class="badge bg-{{ $options[$status]['class'] ?? 'warning' }}">
                                    {{ $options[$status]['label'] ?? ucfirst($status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.show', $product) }}" 
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                                        class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <i class="fas fa-box fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Không tìm thấy sản phẩm nào</p>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                                    Thêm Sản Phẩm Đầu Tiên
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
