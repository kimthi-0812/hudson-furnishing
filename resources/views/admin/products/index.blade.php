@extends('layouts.admin')

@section('title', 'Quản Lý Sản Phẩm - Hudson Furnishing')
@section('page-title', 'Quản Lý Sản Phẩm')

@section('page-actions')
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm Sản Phẩm Mới
    </a>
@endsection

@section('content')

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tất Cả Sản Phẩm</h6>
    </div>
    <div class="card-body">
        <!-- Standalone Filter -->
        <x-standalone-filter 
            :formAction="route('admin.products.index')" 
            :filterConfig="[
                'filters' => [
                    ['type' => 'text', 'name' => 'search', 'placeholder' => 'Tìm tên sản phẩm...', 'label' => 'Tìm kiếm'],
                    ['type' => 'select', 'name' => 'section', 'placeholder' => 'Tất cả khu vực', 'label' => 'Khu vực', 'options' => $sections->pluck('name', 'id')->toArray()],
                    ['type' => 'select', 'name' => 'category', 'placeholder' => 'Tất cả danh mục', 'label' => 'Danh mục', 'options' => $categories->pluck('name', 'id')->toArray()],
                    ['type' => 'select', 'name' => 'brand', 'placeholder' => 'Tất cả thương hiệu', 'label' => 'Thương hiệu', 'options' => $brands->pluck('name', 'id')->toArray()],
                    ['type' => 'price_range', 'name' => 'price_range', 'label' => 'Khoảng giá'],
                    ['type' => 'stock_range', 'name' => 'stock_range', 'label' => 'Số lượng tồn'],
                    ['type' => 'select', 'name' => 'status', 'placeholder' => 'Tất cả trạng thái', 'label' => 'Trạng thái', 'options' => \App\Helpers\StatusHelper::getStatusOptions()]
                ]
            ]"
        />

        <!-- Products Table -->
        <div class="table-responsive">
            <table class="table table-bordered admin-table products-table" style="table-layout: fixed; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 14%; text-align: center;">Hình ảnh sản phẩm</th>
                        <th style="width: 14%; text-align: center;">Tên sản phẩm</th>
                        <th style="width: 12%; text-align: center;">Khu vực</th>
                        <th style="width: 12%; text-align: center;">Danh mục</th>
                        <th style="width: 10%; text-align: center;">Thương hiệu</th>
                        <th style="width: 15%; text-align: center;">Giá niêm yết<br>Giá giảm</th>
                        <th style="width: 8%; text-align: center;">Số lượng tồn</th>
                        <th style="width: 12%; text-align: center;">Trạng thái</th>
                        <th style="width: 15%; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="text-center" style="padding: 1rem 0.5rem !important;">
                                <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                                    @if($product->images->count() > 0)
                                        <img src="{{ asset('uploads/products/' . $product->images->first()->url) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-thumbnail admin-table-image"
                                             style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 80px; border-radius: 8px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td style="word-wrap: break-word; white-space: normal; word-break: break-word; overflow-wrap: break-word;">{{ $product->name }}</td>
                            <td class="text-center" style="word-wrap: break-word; white-space: normal; word-break: break-word; overflow-wrap: break-word;">{{ $product->section->name }}</td>
                            <td class="text-center" style="word-wrap: break-word; white-space: normal; word-break: break-word; overflow-wrap: break-word;">{{ $product->category->name }}</td>
                            <td class="text-center" style="word-wrap: break-word; white-space: normal; word-break: break-word; overflow-wrap: break-word;">{{ $product->brand->name }}</td>
                            <td class="text-center">
                                @if($product->sale_price)
                                    <div class="d-flex flex-column">
                                        <small class="text-muted text-decoration-line-through">{{ number_format($product->price, 0, ',', ',') }} ₫</small>
                                        <span class="text-success fw-bold">{{ number_format($product->sale_price, 0, ',', ',') }} ₫</span>
                                    </div>
                                @else
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ number_format($product->price, 0, ',', ',') }} ₫</span>
                                        <small class="text-muted">-</small>
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">{{ $product->stock }}</td>
                            <td class="text-center">
                                @php
                                    $options = \App\Helpers\StatusHelper::getStatusOptions();
                                    $status = $product->status;
                                @endphp
                                <span class="badge bg-{{ $options[$status]['class'] ?? 'warning' }}">
                                    {{ $options[$status]['label'] ?? ucfirst($status) }}
                                </span>
                            </td>
                            <td class="text-center">
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

<style>
/* Table styling with column width enforcement */
.products-table {
    table-layout: fixed;
    width: 100%;
}

.products-table th {
    text-align: center;
}

/* Column width enforcement with !important */
.products-table th:nth-child(1),
.products-table td:nth-child(1) {
    width: 14% !important;
}

.products-table th:nth-child(2),
.products-table td:nth-child(2) {
    width: 14% !important;
}

.products-table th:nth-child(3),
.products-table td:nth-child(3) {
    width: 12% !important;
}

.products-table th:nth-child(4),
.products-table td:nth-child(4) {
    width: 12% !important;
}

.products-table th:nth-child(5),
.products-table td:nth-child(5) {
    width: 10% !important;
}

.products-table th:nth-child(6),
.products-table td:nth-child(6) {
    width: 15% !important;
}

.products-table th:nth-child(7),
.products-table td:nth-child(7) {
    width: 8% !important;
}

.products-table th:nth-child(8),
.products-table td:nth-child(8) {
    width: 12% !important;
}

.products-table th:nth-child(9),
.products-table td:nth-child(9) {
    width: 15% !important;
}

/* Force table layout */
.products-table {
    table-layout: fixed !important;
    width: 100% !important;
}

/* Override any existing styles */
.products-table th[style],
.products-table td[style] {
    width: inherit !important;
}

/* Responsive badge status */
.products-table .badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    white-space: normal;
    word-wrap: break-word;
    word-break: break-word;
    max-width: 100%;
    display: inline-block;
    line-height: 1.2;
    text-align: center;
}

/* Ensure status column allows wrapping */
.products-table td:nth-child(8) {
    white-space: normal;
    word-wrap: break-word;
    vertical-align: middle;
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .products-table .badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
    }
}

@media (max-width: 576px) {
    .products-table .badge {
        font-size: 0.65rem;
        padding: 0.15rem 0.3rem;
    }
}
</style>

<script>
// Column width enforcement
document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('.products-table');
    if (table) {
        table.style.tableLayout = 'fixed';
        table.style.width = '100%';
        
        // Ensure column widths are applied
        const columns = [
            { width: '14%' },   // Hình ảnh sản phẩm
            { width: '14%' },   // Tên sản phẩm
            { width: '12%' },   // Khu vực
            { width: '12%' },   // Danh mục
            { width: '10%' },   // Thương hiệu
            { width: '15%' },   // Giá / Giá khuyến mãi
            { width: '8%' },    // Số lượng tồn
            { width: '12%' },   // Trạng thái
            { width: '15%' }    // Thao tác
        ];
        
        const allCells = table.querySelectorAll('th, td');
        allCells.forEach((cell, index) => {
            const columnIndex = index % 9;
            if (columns[columnIndex]) {
                cell.style.setProperty('width', columns[columnIndex].width, 'important');
            }
        });
        
        // Force reflow to ensure changes take effect
        table.style.display = 'none';
        table.offsetHeight;
        table.style.display = 'table';
    }
});

// Force column widths on window load
window.addEventListener('load', function() {
    const table = document.querySelector('.products-table');
    if (table) {
        table.style.setProperty('table-layout', 'fixed', 'important');
        table.style.setProperty('width', '100%', 'important');
        
        const columns = [
            { width: '14%' },   // Hình ảnh sản phẩm
            { width: '14%' },   // Tên sản phẩm
            { width: '12%' },   // Khu vực
            { width: '12%' },   // Danh mục
            { width: '10%' },   // Thương hiệu
            { width: '15%' },   // Giá / Giá khuyến mãi
            { width: '8%' },    // Số lượng tồn
            { width: '12%' },   // Trạng thái
            { width: '15%' }    // Thao tác
        ];
        
        const allCells = table.querySelectorAll('th, td');
        allCells.forEach((cell, index) => {
            const columnIndex = index % 9;
            if (columns[columnIndex]) {
                cell.style.setProperty('width', columns[columnIndex].width, 'important');
            }
        });
    }
});
</script>

@endsection
