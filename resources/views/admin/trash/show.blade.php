@extends('layouts.admin')

@section('title', 'Thùng Rác - ' . ucfirst($model) . ' - Hudson Furnishing')
@section('page-title', 'Đã Xóa - ' . ucfirst($model))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-light">
                    Đã Xóa {{ $modelNames[$model] ?? ucfirst($model) }} ({{ $items->total() }} mục)
                </h6>
                <div>
                    <a href="{{ route('admin.trash.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Quay Lại Thùng Rác
                    </a>
                    @if($items->count() > 0)
                        <button type="button" class="btn btn-success btn-sm" onclick="bulkRestore()">
                            <i class="fas fa-undo me-1"></i>Khôi Phục Tất Cả
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="bulkDelete()">
                            <i class="fas fa-trash me-1"></i>Xóa Tất Cả
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if($items->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">
                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                    </th>
                                    <th width="8%">Mã số</th>
                                    <th>Tên</th>
                                    @if($model === 'products')
                                        <th>Giá</th>
                                        <th>Trạng thái</th>
                                        <th>Danh mục</th>
                                    @elseif($model === 'categories')
                                        <th>Khu vực</th>
                                        <th>Số sản phẩm</th>
                                    @elseif($model === 'offers')
                                        <th>Giảm giá</th>
                                        <th>Có hiệu lực đến</th>
                                    @endif
                                    <th>Thời gian xóa</th>
                                    <th width="15%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="item-checkbox" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            @if(isset($item->name))
                                                {{ $item->name }}
                                            @elseif(isset($item->title))
                                                {{ $item->title }}
                                            @else
                                                Mục #{{ $item->id }}
                                            @endif
                                        </td>
                                        @if($model === 'products')
                                            <td>
                                                @if($item->price)
                                                    {{ number_format($item->price) }} ₫
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $item->status === 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->category)
                                                    {{ $item->category->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        @elseif($model === 'categories')
                                            <td>
                                                @if($item->section)
                                                    {{ $item->section->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->products)
                                                    {{ $item->products->count() }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        @elseif($model === 'offers')
                                            <td>
                                                @if($item->discount_type === 'percent')
                                                    {{ $item->discount_value }}%
                                                @else
                                                    {{ number_format($item->discount_value) }} ₫
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->valid_until)
                                                    {{ \Carbon\Carbon::parse($item->valid_until)->format('d/m/Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            <small class="text-muted">
                                                {{ $item->deleted_at->format('d/m/Y H:i:s') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <form method="POST" action="{{ route('admin.trash.restore') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="model" value="{{ $model }}">
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-success btn-sm" 
                                                            onclick="return confirm('Khôi phục {{ $model }} này?')" 
                                                            title="Khôi phục">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.trash.force-delete') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="model" value="{{ $model }}">
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Xóa vĩnh viễn {{ $model }} này? Hành động này không thể hoàn tác!')" 
                                                            title="Xóa vĩnh viễn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($items->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $items->links() }}
                        </div>
                    @endif

                    <!-- Bulk Actions Forms -->
                    <form id="bulkRestoreForm" method="POST" action="{{ route('admin.trash.bulk-restore') }}" style="display: none;">
                        @csrf
                        <input type="hidden" name="model" value="{{ $model }}">
                        <div id="bulkRestoreIds"></div>
                    </form>

                    <form id="bulkDeleteForm" method="POST" action="{{ route('admin.trash.bulk-force-delete') }}" style="display: none;">
                        @csrf
                        <input type="hidden" name="model" value="{{ $model }}">
                        <div id="bulkDeleteIds"></div>
                    </form>

                @else
                    <div class="text-center py-5">
                        <i class="fas fa-trash fa-3x text-muted mb-3"></i>
                        <h4>Không Có {{ $modelNames[$model] ?? ucfirst($model) }} Đã Xóa</h4>
                        <p class="text-muted">Không tìm thấy {{ $modelNames[$model] ?? $model }} nào đã xóa mềm.</p>
                        <a href="{{ route('admin.trash.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-1"></i>Quay Lại Thùng Rác
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

function bulkRestore() {
    const selectedIds = getSelectedIds();
    
    if (selectedIds.length === 0) {
        alert('Vui lòng chọn các mục để khôi phục.');
        return;
    }
    
    if (confirm(`Khôi phục ${selectedIds.length} mục?`)) {
        const form = document.getElementById('bulkRestoreForm');
        const container = document.getElementById('bulkRestoreIds');
        
        container.innerHTML = '';
        selectedIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = id;
            container.appendChild(input);
        });
        
        form.submit();
    }
}

function bulkDelete() {
    const selectedIds = getSelectedIds();
    
    if (selectedIds.length === 0) {
        alert('Vui lòng chọn các mục để xóa.');
        return;
    }
    
    if (confirm(`Xóa vĩnh viễn ${selectedIds.length} mục? Hành động này không thể hoàn tác!`)) {
        const form = document.getElementById('bulkDeleteForm');
        const container = document.getElementById('bulkDeleteIds');
        
        container.innerHTML = '';
        selectedIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = id;
            container.appendChild(input);
        });
        
        form.submit();
    }
}

function getSelectedIds() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    return Array.from(checkboxes).map(checkbox => checkbox.value);
}
</script>
@endsection
