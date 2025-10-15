@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Sản Phẩm - Hudson Furnishing')
@section('page-title', 'Chỉnh Sửa Sản Phẩm')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Chỉnh Sửa Sản Phẩm: {{ $product->name }}</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" id="productForm">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Sản Phẩm *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $product->name) }}" 
                               maxlength="75" placeholder="Nhập tên sản phẩm (tối đa 75 ký tự)" required>
                        <div class="form-text">
                            <span id="name-counter">0</span>/75 ký tự - Tên sản phẩm sẽ hiển thị tối đa 2 dòng trên product card
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="section_id" class="form-label">Mục Sản Phẩm *</label>
                        <select class="form-select @error('section_id') is-invalid @enderror" 
                                id="section_id" name="section_id" required>
                            <option value="">Chọn Mục Sản Phẩm</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id', $product->section_id) == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Loại Sản Phẩm *</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Chọn Loại Sản Phẩm</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Thương Hiệu *</label>
                        <select class="form-select @error('brand_id') is-invalid @enderror" 
                                id="brand_id" name="brand_id" required>
                            <option value="">Chọn Thương Hiệu</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="material_id" class="form-label">Vật Liệu *</label>
                        <select class="form-select @error('material_id') is-invalid @enderror" 
                                id="material_id" name="material_id" required>
                            <option value="">Chọn Vật Liệu</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}" {{ old('material_id', $product->material_id) == $material->id ? 'selected' : '' }}>
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
                        <label for="price" class="form-label">Đơn Giá *</label>
                        <x-number-format-input 
                            name="price" 
                            value="{{ old('price', $product->price) }}" 
                            placeholder="Nhập giá bán"
                            class="@error('price') is-invalid @enderror"
                            id="price"
                            required
                        />
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="sale_price" class="form-label">Giá Sau Khi Giảm</label>
                        <x-number-format-input 
                            name="sale_price" 
                            value="{{ old('sale_price', $product->sale_price) }}" 
                            placeholder="Nhập giá khuyến mãi"
                            class="@error('sale_price') is-invalid @enderror"
                            id="sale_price"
                        />
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock" class="form-label">Số Lượng Hàng Tồn *</label>
                        <x-number-format-input 
                            name="stock" 
                            value="{{ old('stock', $product->stock) }}" 
                            placeholder="Nhập số lượng"
                            class="@error('stock') is-invalid @enderror"
                            id="stock"
                            required
                        />
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Tình Trạng *</label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="featured" name="featured" 
                               value="1" {{ old('featured', $product->featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="featured">Sản Phẩm Nổi Bật</label>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Mô Tả Sản Phẩm *</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <x-image-upload 
                    name="images"
                    label="Hình Ảnh Sản Phẩm"
                    :multiple="true"
                    :required="false"
                    :maxFiles="5"
                    acceptedTypes="image/*"
                    maxSize="2MB"
                    :existingImages="$product->images"
                    deleteRoute="{{ url('admin/products/' . $product->id . '/images') }}"

                    class="@error('images.*') is-invalid @enderror"
                />
                @error('images.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Cập nhật Sản Phẩm</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">Hủy</a>
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
    
    // Handle form submission - convert formatted numbers to raw values
    document.getElementById('productForm').addEventListener('submit', function(e) {
        // Get all number format inputs and convert them to raw values
        document.querySelectorAll('.number-format-input').forEach(function(input) {
            if (input.value) {
                // Create a hidden input with the raw numeric value
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = input.name;
                hiddenInput.value = input.value.replace(/[^\d]/g, ''); // Remove all non-numeric characters
                
                // Replace the formatted input with hidden input
                input.style.display = 'none';
                input.parentNode.insertBefore(hiddenInput, input);
            }
        });
    });
    
        // Auto-change status to inactive when stock = 0 and disable active option
        const stockInput = document.getElementById('stock');
        const statusSelect = document.getElementById('status');
        
        if (stockInput && statusSelect) {
            // Check initial state on page load
            const initialStockValue = parseInt(stockInput.value.replace(/[^\d]/g, ''));
            const activeOption = statusSelect.querySelector('option[value="active"]');
            
            if (initialStockValue === 0) {
                statusSelect.value = 'inactive';
                statusSelect.style.backgroundColor = '#f8d7da';
                statusSelect.style.color = '#721c24';
                if (activeOption) {
                    activeOption.disabled = true;
                    activeOption.style.color = '#6c757d';
                }
            }
            
            stockInput.addEventListener('input', function() {
                const stockValue = parseInt(this.value.replace(/[^\d]/g, ''));
                
                if (stockValue === 0) {
                    // Set to inactive and disable active option
                    statusSelect.value = 'inactive';
                    statusSelect.style.backgroundColor = '#f8d7da';
                    statusSelect.style.color = '#721c24';
                    if (activeOption) {
                        activeOption.disabled = true;
                        activeOption.style.color = '#6c757d';
                    }
                } else {
                    // Enable active option and reset styling
                    statusSelect.style.backgroundColor = '';
                    statusSelect.style.color = '';
                    if (activeOption) {
                        activeOption.disabled = false;
                        activeOption.style.color = '';
                    }
                }
            });
        }
});
</script>
@endsection
