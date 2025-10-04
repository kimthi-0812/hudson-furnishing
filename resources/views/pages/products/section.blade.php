@extends('layouts.guest')

@section('title', $section->name . ' - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5>Bộ Lọc</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('products.section', $section->slug) }}">
                        <!-- Category Filter -->
                        <div class="mb-3">
                            <label class="form-label">Danh Mục</label>
                            <select name="category" class="form-select">
                                <option value="">Tất Cả Danh Mục</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Brand Filter -->
                        <div class="mb-3">
                            <label class="form-label">Thương Hiệu</label>
                            <select name="brand" class="form-select">
                                <option value="">Tất Cả Thương Hiệu</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Material Filter -->
                        <div class="mb-3">
                            <label class="form-label">Vật Liệu</label>
                            <select name="material" class="form-select">
                                <option value="">Tất Cả Vật Liệu</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" {{ request('material') == $material->id ? 'selected' : '' }}>
                                        {{ $material->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-3">
                            <label class="form-label">Khoảng Giá</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" name="min_price" class="form-control" placeholder="Từ" value="{{ request('min_price') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="max_price" class="form-control" placeholder="Đến" value="{{ request('max_price') }}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Áp Dụng Bộ Lọc</button>
                        <a href="{{ route('products.section', $section->slug) }}" class="btn btn-outline-secondary w-100 mt-2">Xóa Bộ Lọc</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2>{{ $section->name }} Sản Phẩm</h2>
                    <p class="text-muted">{{ $products->total() }} sản phẩm tìm thấy</p>
                </div>
                <div class="d-flex gap-2">
                    <select class="form-select" style="width: auto;">
                        <option value="name">Sắp Xếp Theo Tên</option>
                        <option value="price">Sắp Xếp Theo Giá</option>
                        <option value="created_at">Sắp Xếp Theo Ngày</option>
                    </select>
                </div>
            </div>

            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        @include('components.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h4>Không tìm thấy sản phẩm</h4>
                            <p>Kiểm tra lại bộ lọc của bạn</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <nav aria-label="Sản Phẩm Phân Trang">
                    {{ $products->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
