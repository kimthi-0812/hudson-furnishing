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
        <h6 class="m-0 font-weight-bold text-primary">Tất Cả Khuyến Mãi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered admin-table offers-table">
                <thead>
                    <tr>
                        <th>Hình Ảnh</th>
                        <th>Tiêu Đề</th>
                        <th>Giảm Giá</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Bắt Đầu</th>
                        <th>Ngày Kết Thúc</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offers as $offer)
                        <tr>
                            <td>
                                @if($offer->image)
                                    <img src="{{ asset('uploads/offers/' . $offer->image) }}" 
                                         alt="{{ $offer->title }}" class="img-thumbnail admin-table-image">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center admin-table-image">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $offer->title }}</td>
                            <td>
                                @if($offer->discount_type == 'percentage')
                                    {{ $offer->discount_value }}%
                                @else
                                    ${{ number_format($offer->discount_value, 2) }}
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $offer->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($offer->status) }}
                                </span>
                            </td>
                            <td>{{ $offer->start_date->format('M d, Y') }}</td>
                            <td>{{ $offer->end_date->format('M d, Y') }}</td>
                            <td>
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
                                          class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khuyến mãi này không?')">
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
                            <td colspan="7" class="text-center py-4">
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
@endsection
