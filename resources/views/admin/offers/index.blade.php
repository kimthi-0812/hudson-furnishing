@extends('layouts.admin')

@section('title', 'Quản Lý Khuyến Mãi - Hudson Furnishing')
@section('page-title', 'Quản Lý Khuyến Mãi')

@section('page-actions')
    <a href="{{ route('admin.offers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm Khuyến Mãi Mới
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tất Cả Khuyến Mãi</h6>
    </div>
    <div class="card-body">
        <!-- Standalone Filter -->
        <x-standalone-filter 
            :formAction="route('admin.offers.index')" 
            :filterConfig="[
                'filters' => [
                    ['type' => 'text', 'name' => 'search', 'placeholder' => 'Tìm tiêu đề khuyến mãi...', 'label' => 'Tìm kiếm'],
                    ['type' => 'select', 'name' => 'discount_type', 'placeholder' => 'Tất cả', 'label' => 'Loại giảm giá', 'options' => ['percentage' => 'Phần trăm', 'fixed' => 'Cố định']],
                    ['type' => 'select', 'name' => 'status', 'placeholder' => 'Tất cả', 'label' => 'Trạng thái', 'options' => ['active' => 'Hoạt động', 'inactive' => 'Không hoạt động']],
                    ['type' => 'date', 'name' => 'start_date', 'label' => 'Từ ngày'],
                    ['type' => 'date', 'name' => 'end_date', 'label' => 'Đến ngày']
                ]
            ]"
        />

        <!-- Offers Table -->
        <div class="table-responsive">
            <table class="table table-bordered admin-table offers-table" style="table-layout: fixed; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 14%; text-align: center !important;">Hình Ảnh</th>
                        <th style="width: 15%; text-align: left !important;">Tiêu Đề</th>
                        <th style="width: 12%; text-align: center !important;">Giảm Giá</th>
                        <th style="width: 10%; text-align: center !important;">Trạng Thái</th>
                        <th style="width: 15%; text-align: center !important;">Ngày Bắt Đầu</th>
                        <th style="width: 15%; text-align: center !important;">Ngày Kết Thúc</th>
                        <th style="width: 19%; text-align: center !important;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offers as $offer)
                        <tr>
                            <td style="text-align: center !important;">
                                @if($offer->image)
                                    <img src="{{ asset('storage/' . $offer->image) }}" 
                                         alt="{{ $offer->title }}" class="img-thumbnail admin-table-image">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center admin-table-image">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="text-align: left !important;">{{ $offer->title }}</td>
                            <td style="text-align: center !important;">
                                @if($offer->discount_type == 'percentage')
                                    {{ \App\Helpers\PriceHelper::formatPercentage($offer->discount_value) }}
                                @else
                                    {{ number_format($offer->discount_value, 0, ',', ',') }} ₫
                                @endif
                            </td>
                            <td style="text-align: center !important;">
                                <span class="badge bg-{{ $offer->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($offer->status) }}
                                </span>
                            </td>
                            <td style="text-align: center !important;">{{ $offer->start_date->format('d/m/Y') }}</td>
                            <td style="text-align: center !important;">{{ $offer->end_date->format('d/m/Y') }}</td>
                            <td style="text-align: center !important;">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.offers.show', $offer) }}" 
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.offers.edit', $offer) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.offers.destroy', $offer) }}" 
                                          class="d-inline form-confirm">
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
                            <td colspan="7" class="text-center py-4" style="text-align: center !important;">
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Không tìm thấy khuyến mãi nào</p>
                                <a href="{{ route('admin.offers.create') }}" class="btn btn-primary">
                                    Thêm Khuyến Mãi Đầu Tiên
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $offers->links() }}
        </div>
    </div>
</div>

<style>
/* NUCLEAR OPTION - MAXIMUM SPECIFICITY CSS */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table {
    table-layout: fixed !important;
    width: 100% !important;
    border-collapse: collapse !important;
    border-spacing: 0 !important;
    empty-cells: show !important;
}

/* Override ALL possible CSS that could interfere */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table th,
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table td {
    box-sizing: border-box !important;
    padding: 8px !important;
    margin: 0 !important;
    border: 1px solid #dee2e6 !important;
    vertical-align: middle !important;
    text-align: center !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    white-space: normal !important;
    flex: none !important;
    flex-basis: auto !important;
    flex-grow: 0 !important;
    flex-shrink: 0 !important;
    max-width: none !important;
    min-width: 0 !important;
    width: auto !important;
}

/* FORCE COLUMN 1 - Hình Ảnh */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table th:nth-child(1),
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table td:nth-child(1) {
    width: 14% !important;
    min-width: 60px !important;
    max-width: 120px !important;
    text-align: center !important;
}

/* FORCE COLUMN 2 - Tiêu Đề */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table th:nth-child(2),
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table td:nth-child(2) {
    width: 15% !important;
    text-align: left !important;
}

/* FORCE COLUMN 3 - Giảm Giá */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table th:nth-child(3),
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table td:nth-child(3) {
    width: 12% !important;
    text-align: center !important;
}

/* FORCE COLUMN 4 - Trạng Thái */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table th:nth-child(4),
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table td:nth-child(4) {
    width: 10% !important;
    text-align: center !important;
}

/* FORCE COLUMN 5 - Ngày Bắt Đầu */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table th:nth-child(5),
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table td:nth-child(5) {
    width: 15% !important;
    text-align: center !important;
}

/* FORCE COLUMN 6 - Ngày Kết Thúc */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table th:nth-child(6),
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table td:nth-child(6) {
    width: 15% !important;
    text-align: center !important;
}

/* FORCE COLUMN 7 - Hành Động */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table th:nth-child(7),
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table td:nth-child(7) {
    width: 19% !important;
    text-align: center !important;
}

/* OVERRIDE ANY INLINE STYLES */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table th[style],
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table td[style] {
    width: inherit !important;
}

/* DISABLE ALL FLEX PROPERTIES */
html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table * {
    box-sizing: border-box !important;
    flex: none !important;
    flex-basis: auto !important;
    flex-grow: 0 !important;
    flex-shrink: 0 !important;
}

/* FORCE TABLE RESPONSIVE TO NOT INTERFERE */
@media (max-width: 768px) {
    html body div.card div.card-body div.table-responsive {
        overflow-x: auto !important;
    }
    
    html body div.card div.card-body div.table-responsive table.table.table-bordered.admin-table.offers-table {
        min-width: 800px !important;
    }
}

/* NUCLEAR OVERRIDE - DISABLE ALL BOOTSTRAP TABLE CLASSES */
.table.table-bordered.admin-table.offers-table {
    table-layout: fixed !important;
    width: 100% !important;
}

.table.table-bordered.admin-table.offers-table th,
.table.table-bordered.admin-table.offers-table td {
    width: inherit !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FORCE TABLE COLUMN WIDTHS WITH JAVASCRIPT
    const table = document.querySelector('.offers-table');
    if (table) {
        // Force table layout
        table.style.setProperty('table-layout', 'fixed', 'important');
        table.style.setProperty('width', '100%', 'important');
        
        // Force column widths
        const columns = [
            { width: '14%', align: 'center' },   // Hình Ảnh
            { width: '15%', align: 'left' },     // Tiêu Đề
            { width: '12%', align: 'center' },   // Giảm Giá
            { width: '10%', align: 'center' },   // Trạng Thái
            { width: '15%', align: 'center' },   // Ngày Bắt Đầu
            { width: '15%', align: 'center' },   // Ngày Kết Thúc
            { width: '19%', align: 'center' }    // Hành Động
        ];
        
        // Apply to all th and td elements
        const allCells = table.querySelectorAll('th, td');
        allCells.forEach((cell, index) => {
            const columnIndex = index % 7; // 7 columns
            if (columns[columnIndex]) {
                cell.style.setProperty('width', columns[columnIndex].width, 'important');
                cell.style.setProperty('text-align', columns[columnIndex].align, 'important');
                cell.style.setProperty('box-sizing', 'border-box', 'important');
                cell.style.setProperty('flex', 'none', 'important');
                cell.style.setProperty('flex-basis', 'auto', 'important');
            }
        });
        
        // Force table to recalculate
        table.style.display = 'none';
        table.offsetHeight; // Trigger reflow
        table.style.display = 'table';
    }
});

// Also run on window load as backup
window.addEventListener('load', function() {
    const table = document.querySelector('.offers-table');
    if (table) {
        table.style.setProperty('table-layout', 'fixed', 'important');
        table.style.setProperty('width', '100%', 'important');
    }
});
</script>
@endsection
