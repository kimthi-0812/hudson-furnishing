@extends('layouts.admin')

@section('title', 'Quản Lý Danh Mục  - Hudson Furnishing')
@section('page-title', 'Quản Lý Danh Mục')

@section('page-actions')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm Danh Mục
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light"> Tất Cả Danh Mục</h6>
    </div>
    <div class="card-body">
        <!-- Standalone Filter -->
        <x-standalone-filter 
            :formAction="route('admin.categories.index')" 
            :filterConfig="[
                'filters' => [
                    ['type' => 'text', 'name' => 'search', 'placeholder' => 'Tìm tên danh mục...', 'label' => 'Tìm kiếm'],
                    ['type' => 'select', 'name' => 'section', 'placeholder' => 'Tất cả khu vực', 'label' => 'Khu vực', 'options' => $sections->pluck('name', 'id')->toArray()],
                    ['type' => 'select', 'name' => 'product_count', 'placeholder' => 'Tất cả', 'label' => 'Số sản phẩm', 'options' => ['0' => 'Không có sản phẩm', '1-10' => '1-10 sản phẩm', '11-50' => '11-50 sản phẩm', '51+' => 'Trên 50 sản phẩm']],
                    ['type' => 'date', 'name' => 'created_from', 'label' => 'Từ ngày']
                ]
            ]"
        />

        <!-- Categories Table -->
        <div class="table-responsive">
            <table class="table table-bordered admin-table categories-table">
                <thead>
                    <tr>
                        <th>Tên Danh Mục</th>
                        <th>Khu Vực</th>
                        <th>Số Lượng Sản Phẩm</th>
                        <th>Ngày Tạo</th>
                        <th>Hành Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->section->name }}</td>
                            <td>{{ $category->products()->count() }}</td>
                            <td>{{ $category->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.categories.show', $category) }}" 
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" 
                                          class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Không tìm thấy danh mục nào</p>
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                    Thêm danh mục sản phẩm đầu tiên của bạn
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
