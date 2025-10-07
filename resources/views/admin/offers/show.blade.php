@extends('layouts.admin')

@section('title', 'Chi Tiết Ưu Đãi: ' . $offer->title)

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Thông Tin Chi Tiết Ưu Đãi: {{ $offer->title }}</h6>
        <div>
            <a href="{{ route('admin.offers.edit', $offer) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Chỉnh Sửa
            </a>
            <a href="{{ route('admin.offers.index') }}" class="btn btn-info btn-sm">
                <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                @if ($offer->image)
                    <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }} Image" class="img-fluid rounded" style="max-height: 200px; border: 1px solid #ccc;">
                @else
                    <p class="text-muted">Không có ảnh đại diện</p>
                @endif
            </div>
            <div class="col-md-9">
                <p><strong>Tiêu Đề:</strong> {{ $offer->title }}</p>
                <p><strong>Slug:</strong> {{ $offer->slug }}</p>
                <p><strong>Loại Ưu Đãi:</strong> 
                    @if ($offer->type == 'percentage')
                        <span class="badge badge-success">Phần Trăm (%)</span>
                    @else
                        <span class="badge badge-primary">Giá Trị Cố Định</span>
                    @endif
                </p>
                <p><strong>Giá Trị:</strong> 
                    <span class="text-danger font-weight-bold">
                        {{ number_format($offer->value) }}{{ $offer->type == 'percentage' ? '%' : ' VNĐ' }}
                    </span>
                </p>
                <p><strong>Thời Gian Áp Dụng:</strong> 
                    Từ {{ \Carbon\Carbon::parse($offer->start_date)->format('H:i d/m/Y') }} 
                    đến {{ \Carbon\Carbon::parse($offer->end_date)->format('H:i d/m/Y') }}
                </p>
                <hr>
                <p><strong>Mô Tả:</strong> {{ $offer->description ?? 'Không có mô tả chi tiết' }}</p>
            </div>
        </div>
    </div>
</div>

---

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Sản Phẩm Được Áp Dụng Ưu Đãi ({{ $products->total() ?? 0 }})</h6>
    </div>
    <div class="card-body">
        
        @if ($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Danh Mục</th>
                            <th>Thương Hiệu</th>
                            <th>Giá Gốc</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Lặp qua biến $products đã được phân trang --}}
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>{{ $product->brand->name ?? 'N/A' }}</td>
                            <td>{{ number_format($product->price) }} VNĐ</td>
                            <td>
                                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info">Xem</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Hiển thị phân trang --}}
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> Không có sản phẩm nào được áp dụng ưu đãi này.
            </div>
        @endif

    </div>
</div>

@endsection