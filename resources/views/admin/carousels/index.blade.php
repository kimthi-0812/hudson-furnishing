@extends('layouts.admin')

@section('title', 'Quản Lý Carousel - Hudson Furnishing')
@section('page-title', 'Quản Lý Carousel')

@section('page-actions')
    <a href="{{ route('admin.carousels.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm Slide Mới
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tất Cả Slides</h6>
    </div>
    <div class="card-body">
        <!-- Standalone Filter -->
        <x-standalone-filter 
            :formAction="route('admin.carousels.index')" 
            :filterConfig="[
                'filters' => [
                    ['type' => 'text', 'name' => 'search', 'placeholder' => 'Tìm tiêu đề...', 'label' => 'Tìm kiếm'],
                    ['type' => 'select', 'name' => 'is_active', 'placeholder' => 'Tất cả trạng thái', 'label' => 'Trạng thái', 'options' => ['1' => 'Hoạt động', '0' => 'Không hoạt động']],
                    ['type' => 'date', 'name' => 'created_from', 'label' => 'Từ ngày']
                ]
            ]"
        />

        <!-- Carousels Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="50">#</th>
                        <th width="150">Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th width="100">Thứ tự</th>
                        <th width="100">Trạng thái</th>
                        <th width="150">Ngày tạo</th>
                        <th width="200">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carousels as $index => $carousel)
                        <tr>
                            <td>{{ $carousels->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ asset('storage/carousels/' . $carousel->image) }}" 
                                     alt="{{ $carousel->title }}"
                                     class="img-thumbnail"
                                     style="width: 80px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $carousel->title }}</strong>
                                    @if($carousel->description)
                                        <br><small class="text-muted">{{ Str::limit($carousel->description, 50) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $carousel->sort_order }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $carousel->is_active ? 'success' : 'secondary' }}">
                                    {{ $carousel->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                </span>
                            </td>
                            <td>
                                <small>{{ $carousel->created_at->format('d/m/Y') }}</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.carousels.show', $carousel) }}" 
                                       class="btn btn-outline-info" title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.carousels.edit', $carousel) }}" 
                                       class="btn btn-outline-primary" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.carousels.toggle-status', $carousel) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-outline-{{ $carousel->is_active ? 'warning' : 'success' }}" 
                                                title="{{ $carousel->is_active ? 'Vô hiệu hóa' : 'Kích hoạt' }}">
                                            <i class="fas fa-{{ $carousel->is_active ? 'pause' : 'play' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.carousels.destroy', $carousel) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa slide này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Chưa có slide nào</h5>
                                <p class="text-muted">Hãy thêm slide đầu tiên cho carousel.</p>
                                <a href="{{ route('admin.carousels.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Thêm Slide
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        {{ $carousels->links() }}
    </div>
</div>
@endsection
