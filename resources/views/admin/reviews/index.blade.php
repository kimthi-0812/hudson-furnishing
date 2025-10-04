@extends('layouts.admin')

@section('title', 'Quản Lý Đánh Giá - Hudson Furnishing')
@section('page-title', 'Quản Lý Đánh Giá')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tất Cả Đánh Giá</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered admin-table reviews-table">
                <thead>
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Khách Hàng</th>
                        <th>Đánh Giá</th>
                        <th>Bình Luận</th>
                        <th>Trạng Thái</th>
                        <th>Ngày</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>
                                <a href="{{ route('product.show', $review->product) }}" target="_blank">
                                    {{ $review->product->name }}
                                </a>
                            </td>
                            <td>
                                <strong>{{ $review->name }}</strong><br>
                                <small class="text-muted">{{ $review->email }}</small>
                            </td>
                            <td>
                                <div class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td>{{ Str::limit($review->comment, 100) }}</td>
                            <td>
                                <span class="badge bg-{{ $review->approved ? 'success' : 'warning' }}">
                                    {{ $review->approved ? 'Đã Duyệt' : 'Đang Chờ' }}
                                </span>
                            </td>
                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @if(!$review->approved)
                                        <form method="POST" action="{{ route('admin.reviews.approve', $review) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" 
                                          class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này không?')">
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
                                <i class="fas fa-star fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Không tìm thấy đánh giá nào</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection
