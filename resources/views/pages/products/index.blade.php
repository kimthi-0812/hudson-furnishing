@extends('layouts.guest')

@section('title', 'Sản Phẩm - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>Bộ Lọc</h5>
                    <i class="fa-solid fa-filter"></i>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('products.index') }}">
                        <!-- Section Filter -->
                        <div class="mb-3">
                            <label class="form-label">Phòng/Khu Vực</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                    {{ request('section') ? $sections->firstWhere('slug', request('section'))->name : 'Tất Cả Phòng/Khu Vực' }}
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item {{ request('section') == '' ? 'active' : '' }}" href="{{ route('products.index', array_merge(request()->except('section', 'page'), ['section' => ''])) }}">
                                            Tất Cả Phòng/Khu Vực
                                        </a>
                                    </li>
                                    @foreach($sections as $section)
                                    <li>
                                        <a class="dropdown-item {{ request('section') == $section->slug ? 'active' : '' }}"
                                        href="{{ route('products.index', array_merge(request()->except('section', 'page'), ['section' => $section->slug])) }}">
                                            {{ $section->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="mb-3">
                            <label class="form-label">Danh Mục</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                    {{ request('category') ? $categories->firstWhere('id', request('category'))->name : 'Tất Cả Danh Mục' }}
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item {{ request('category') == '' ? 'active' : '' }}" href="{{ route('products.index', array_merge(request()->except('category','page'), ['category' => ''])) }}">
                                            Tất Cả Danh Mục
                                        </a>
                                    </li>
                                    @foreach($categories as $category)
                                    <li>
                                        <a class="dropdown-item {{ request('category') == $category->id ? 'active' : '' }}"
                                        href="{{ route('products.index', array_merge(request()->except('category','page'), ['category' => $category->id])) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Brand Filter -->
                        <div class="mb-3">
                            <label class="form-label">Thương Hiệu</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                    {{ request('brand') ? $brands->firstWhere('id', request('brand'))->name : 'Tất Cả Thương Hiệu' }}
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item {{ request('brand') == '' ? 'active' : '' }}" href="{{ route('products.index', array_merge(request()->except('brand','page'), ['brand' => ''])) }}">
                                            Tất Cả Thương Hiệu
                                        </a>
                                    </li>
                                    @foreach($brands as $brand)
                                    <li>
                                        <a class="dropdown-item {{ request('brand') == $brand->id ? 'active' : '' }}"
                                        href="{{ route('products.index', array_merge(request()->except('brand','page'), ['brand' => $brand->id])) }}">
                                            {{ $brand->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-3">
                            <label class="form-label">Khoảng Giá</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                    {{ request('min_price') ? request('min_price') . ' - ' . request('max_price') : 'Chọn khoảng giá' }}
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item {{ !request('min_price') ? 'active' : '' }}" href="{{ route('products.index', array_merge(request()->except(['min_price','max_price','page']))) }}">
                                            Tất cả
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ request('min_price') == 0 && request('max_price') == 1000000 ? 'active' : '' }}" href="{{ route('products.index', array_merge(request()->except(['min_price','max_price','page']), ['min_price'=>0,'max_price'=>1000000])) }}">
                                            0 - 1,000,000
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ request('min_price') == 1000000 && request('max_price') == 5000000 ? 'active' : '' }}" href="{{ route('products.index', array_merge(request()->except(['min_price','max_price','page']), ['min_price'=>1000000,'max_price'=>5000000])) }}">
                                            1,000,000 - 5,000,000
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!--Reset Bộ Lộc-->
                        <hr>
                        <div class="d-flex gap-2 justify-content-center align-items-center mt-4">                            
                            <a href="{{ route('products.index') }}" class="btn btn-primary flex-fill">Reset Bộ Lọc</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Sản Phẩm ({{ $products->total() }} sản phẩm)</h2>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Sắp Xếp sản phẩm theo
                        </button>
                        <ul class="dropdown-menu">
                            {{-- Tên --}}
                            <li>
                                <a class="dropdown-item {{ request('sort_by') === 'name' ? 'active' : '' }}"
                                href="{{ request()->fullUrlWithQuery([
                                    'sort_by' => 'name',
                                    'sort_order' => (request('sort_by') === 'name' && request('sort_order') === 'asc') ? 'desc' : 'asc',
                                    'page' => 1
                                ]) }}">
                                    Tên
                                    @if(request('sort_by') === 'name')
                                        <span class="float-end">{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </a>
                            </li>

                            {{-- Giá --}}
                            <li>
                                <a class="dropdown-item {{ request('sort_by') === 'price' ? 'active' : '' }}"
                                href="{{ request()->fullUrlWithQuery([
                                    'sort_by' => 'price',
                                    'sort_order' => (request('sort_by') === 'price' && request('sort_order') === 'asc') ? 'desc' : 'asc',
                                    'page' => 1
                                ]) }}">
                                    Giá
                                    @if(request('sort_by') === 'price')
                                        <span class="float-end">{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </a>
                            </li>

                            {{-- Ngày --}}
                            <li>
                                <a class="dropdown-item {{ request('sort_by') === 'created_at' ? 'active' : '' }}"
                                href="{{ request()->fullUrlWithQuery([
                                    'sort_by' => 'created_at',
                                    'sort_order' => (request('sort_by') === 'created_at' && request('sort_order') === 'asc') ? 'desc' : 'asc',
                                    'page' => 1
                                ]) }}">
                                    Ngày
                                    @if(request('sort_by') === 'created_at')
                                        <span class="float-end">{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        @include('components.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h4>Không tìm thấy sản phẩm</h4>
                            <p>Kiểm tra lại bộ lọc của bạn</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Sản Phẩm Phân Trang">
                    {{ $products->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
