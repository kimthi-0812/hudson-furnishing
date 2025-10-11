@extends('layouts.admin')

@section('title', 'Tạo Sản Phẩm - Hudson Furnishing')
@section('page-title', 'Tạo Sản Phẩm')

@section('content')

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tạo sản phẩm mới</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" maxlength="75" 
                               placeholder="Nhập tên sản phẩm (tối đa 75 ký tự)">
                        <div class="form-text">
                            <span id="name-counter">0</span>/75 ký tự - Tên sản phẩm sẽ hiển thị tối đa 2 dòng trên product card
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="section_id" class="form-label">Khu vực <span class="text-danger">*</span></label>
                        <select class="form-select @error('section_id') is-invalid @enderror" 
                                id="section_id" name="section_id" >
                            <option value="">Chọn Khu vực</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh Mục <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" >
                            <option value="">Chọn Danh Mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Thương Hiệu <span class="text-danger">*</span></label>
                        <select class="form-select @error('brand_id') is-invalid @enderror" 
                                id="brand_id" name="brand_id" >
                            <option value="">Chọn loại thương hiệu</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="material_id" class="form-label">Chất Liệu <span class="text-danger">*</span></label>
                        <select class="form-select @error('material_id') is-invalid @enderror" 
                                id="material_id" name="material_id" >
                            <option value="">Chọn Loại Chất Liệu</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('material_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá bán<span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" value="{{ old('price') }}" >
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="sale_price" class="form-label">Giá Sau Khi Giảm</label>
                        <input type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" 
                               id="sale_price" name="sale_price" value="{{ old('sale_price') }}">
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock" class="form-label">Số Lượng<span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" name="stock" value="{{ old('stock') }}" >
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái<span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" >
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="featured" name="featured" 
                               value="1" {{ old('featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="featured">Sản Phẩm Nổi Bật</label>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Mô Tả Sản Phẩm <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="5" >{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="images" class="form-label">Hình Ảnh Sản Phẩm </label>
                <input type="file" class="form-control @error('images.*') is-invalid @enderror" 
                       id="images" name="images[]" multiple accept="image/*">
                <div class="form-text">Có thể chọn nhiều hình ảnh, hình đầu tiên mặc định là hình chính.</div>
                @error('images.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="text d-flex gap-2">                
                <button type="submit" class="btn btn-primary">Tạo Sản Phẩm</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary me-2">Hủy</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const nameCounter = document.getElementById('name-counter');
    
    // Cập nhật counter khi nhập
    nameInput.addEventListener('input', function() {
        const currentLength = this.value.length;
        nameCounter.textContent = currentLength;
        
        // Thay đổi màu sắc khi gần đạt giới hạn
        if (currentLength > 60) {
            nameCounter.style.color = '#dc3545'; // Đỏ
        } else if (currentLength > 50) {
            nameCounter.style.color = '#ffc107'; // Vàng
        } else {
            nameCounter.style.color = '#6c757d'; // Xám
        }
    });
    
    // Khởi tạo counter với giá trị ban đầu
    nameCounter.textContent = nameInput.value.length;
});
</script>
@endsection
