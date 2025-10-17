@extends('layouts.admin')

@section('title', 'Quản Lý Đánh Giá - Hudson Furnishing')
@section('page-title', 'Quản Lý Đánh Giá')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tất Cả Đánh Giá</h6>
    </div>
    <div class="card-body">
        <!-- Standalone Filter -->
        <x-standalone-filter 
            :formAction="route('admin.reviews.index')" 
            :filterConfig="[
                'filters' => [
                    ['type' => 'text', 'name' => 'product', 'placeholder' => 'Tìm sản phẩm...', 'label' => 'Sản phẩm'],
                    ['type' => 'text', 'name' => 'customer', 'placeholder' => 'Tìm khách hàng...', 'label' => 'Khách hàng'],
                    ['type' => 'select', 'name' => 'rating', 'placeholder' => 'Tất cả', 'label' => 'Đánh giá', 'options' => ['1' => '1 sao', '2' => '2 sao', '3' => '3 sao', '4' => '4 sao', '5' => '5 sao']],
                    ['type' => 'text', 'name' => 'comment', 'placeholder' => 'Tìm bình luận...', 'label' => 'Bình luận'],
                    ['type' => 'select', 'name' => 'status', 'placeholder' => 'Tất cả', 'label' => 'Trạng thái', 'options' => ['approved' => 'Đã duyệt', 'pending' => 'Chờ duyệt']],
                    ['type' => 'date', 'name' => 'created_from', 'label' => 'Từ ngày']
                ]
            ]"
        />

        <!-- Reviews Table -->
        <div class="table-responsive">
            <table class="table table-bordered admin-table" style="table-layout: fixed; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 16%; text-align: center !important;">Sản Phẩm</th>
                        <th style="width: 17%; text-align: center !important;">Khách Hàng</th>
                        <th style="width: 12%; text-align: center !important;">Đánh Giá</th>
                        <th style="width: 20%; text-align: center !important;">Bình Luận</th>
                        <th style="width: 12%; text-align: center !important;">Trạng Thái</th>
                        <th style="width: 12%; text-align: center !important;">Ngày</th>
                        <th style="width: 11%; text-align: center !important;">Hành Động</th>
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
                            <td style="word-wrap: break-word; white-space: normal; word-break: break-word;">
                                <div style="max-height: 100px; overflow-y: auto; padding: 5px;">
                                    {{ $review->comment }}
                                </div>
                            </td>
                            <td>
                                @php
                                    $options = \App\Helpers\StatusHelper::getReviewStatusOption();
                                    $status = $review->approved;
                                @endphp
                                <span class="badge bg-{{ $options[$status]['class'] ?? 'warning' }}">
                                    {{ $options[$status]['label'] ?? ucfirst($status) }}
                                </span>
                            </td>
                            <td>{{ $review->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    @if(!$review->approved)
                                        <form method="POST" action="{{ route('admin.reviews.approve', $review) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Duyệt đánh giá">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" 
                                          class="d-inline form-confirm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa đánh giá">
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
%