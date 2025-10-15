@extends('layouts.admin')

@section('title', 'Quản Lý Vật Liệu - Hudson Furnishing')
@section('page-title', 'Quản Lý Vật Liệu')

@section('page-actions')
    <a href="{{ route('admin.materials.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm Vật Liệu Mới
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tất Cả Vật Liệu</h6>
    </div>
    <div class="card-body">
        <!-- Standalone Filter -->
        <x-standalone-filter 
            :formAction="route('admin.materials.index')" 
            :filterConfig="[
                'filters' => [
                    ['type' => 'text', 'name' => 'search', 'placeholder' => 'Tìm tên vật liệu...', 'label' => 'Tìm kiếm'],
                    ['type' => 'select', 'name' => 'product_count', 'placeholder' => 'Tất cả', 'label' => 'Số sản phẩm', 'options' => ['0' => 'Không có sản phẩm', '1-10' => '1-10 sản phẩm', '11-50' => '11-50 sản phẩm', '51+' => 'Trên 50 sản phẩm']],
                    ['type' => 'date', 'name' => 'created_from', 'label' => 'Từ ngày']
                ]
            ]"
        />

        <!-- Materials Table -->
        <div class="table-responsive">
            <table class="table table-bordered admin-table materials-table">
                <thead>
                    <tr>
                        <th>Hình Ảnh</th>
                        <th>Tên</th>
                        <th>Số Lượng</th>
                        <th>Ngày Tạo</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materials as $material)
                        <tr>
                            <td>
                                @if($material->image)
                                    <img src="{{ asset('storage/' . $material->image) }}" 
                                         alt="{{ $material->name }}" class="img-thumbnail admin-table-image">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center admin-table-image">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $material->name }}</td>
                            <td>{{ $material->products_count }}</td>
                            <td>{{ $material->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.materials.show', $material) }}" 
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.materials.edit', $material) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.materials.destroy', $material) }}" 
                                        class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vật liệu này không?')">
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
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-cube fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Không tìm thấy vật liệu nào</p>
                                <a href="{{ route('admin.materials.create') }}" class="btn btn-primary">
                                    Thêm Vật Liệu Đầu Tiên
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $materials->links() }}
        </div>
    </div>
</div>
@endsection
