@extends('layouts.guest')

@section('title', $section->name . ' - Hudson Furnishing')

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
                    <!-- ✅ Form luôn có section slug -->
                    <form method="GET" action="{{ route('products.section', ['section' => $section->slug]) }}">
                        
                        <!-- Danh Mục -->
                        <div class="mb-3">
                            <label class="form-label">Danh Mục</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                    {{ request('category') ? $categories->firstWhere('id', request('category'))->name : 'Tất Cả Danh Mục' }}
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item {{ request('category') == '' ? 'active' : '' }}" 
                                           href="{{ route('products.section', ['section' => $section->slug]) }}">
                                            Tất Cả Danh Mục
                                        </a>
                                    </li>
                                    @foreach($categories as $category)
                                        <li>
                                            <a class="dropdown-item {{ request('category') == $category->id ? 'active' : '' }}"
                                               href="{{ route('products.section', array_merge(['section' => $section->slug], request()->except('category','page'), ['category' => $category->id])) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Thương Hiệu -->
                        <div class="mb-3">
                            <label class="form-label">Thương Hiệu</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                    {{ request('brand') ? $brands->firstWhere('id', request('brand'))->name : 'Tất Cả Thương Hiệu' }}
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item {{ request('brand') == '' ? 'active' : '' }}" 
                                           href="{{ route('products.section', ['section' => $section->slug]) }}">
                                            Tất Cả Thương Hiệu
                                        </a>
                                    </li>
                                    @foreach($brands as $brand)
                                        <li>
                                            <a class="dropdown-item {{ request('brand') == $brand->id ? 'active' : '' }}"
                                               href="{{ route('products.section', array_merge(['section' => $section->slug], request()->except('brand','page'), ['brand' => $brand->id])) }}">
                                                {{ $brand->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Vật Liệu -->
                        <div class="mb-3">
                            <label class="form-label">Vật Liệu</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                    {{ request('material') ? $materials->firstWhere('id', request('material'))->name : 'Tất Cả Vật Liệu' }}
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item {{ request('material') == '' ? 'active' : '' }}" 
                                           href="{{ route('products.section', ['section' => $section->slug]) }}">
                                            Tất Cả Vật Liệu
                                        </a>
                                    </li>
                                    @foreach($materials as $material)
                                        <li>
                                            <a class="dropdown-item {{ request('material') == $material->id ? 'active' : '' }}"
                                               href="{{ route('products.section', array_merge(['section' => $section->slug], request()->except('material','page'), ['material' => $material->id])) }}">
                                                {{ $material->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Khoảng giá -->
                        <div class="mb-3">
                            <label class="form-label">Khoảng Giá</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                                    {{ request('min_price') ? request('min_price') . ' - ' . request('max_price') : 'Chọn khoảng giá' }}
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li>
                                        <a class="dropdown-item {{ !request('min_price') ? 'active' : '' }}" 
                                           href="{{ route('products.section', ['section' => $section->slug]) }}">
                                            Tất cả
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ request('min_price') == 0 && request('max_price') == 1000000 ? 'active' : '' }}" 
                                           href="{{ route('products.section', array_merge(['section' => $section->slug], ['min_price'=>0,'max_price'=>1000000])) }}">
                                            0 - 1,000,000
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ request('min_price') == 1000000 && request('max_price') == 5000000 ? 'active' : '' }}" 
                                           href="{{ route('products.section', array_merge(['section' => $section->slug], ['min_price'=>1000000,'max_price'=>5000000])) }}">
                                            1,000,000 - 5,000,000
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Reset Bộ Lọc -->
                         <hr>
                        <div class="d-flex gap-2 justify-content-center align-items-center mt-4">                            
                            <a href="{{ route('products.section', ['section' => $section->slug]) }}" class="btn btn-primary flex-fill ">Reset Bộ Lọc</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>{{ $section->name }} ({{ $products->total() }} sản phẩm)</h2>
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
