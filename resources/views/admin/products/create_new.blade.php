@extends('layouts.admin')

@section('title', 'Tạo Sản Phẩm')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tạo sản phẩm mới</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="productForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Nhập tên sản phẩm (tối đa 75 ký tự)"
                                           maxlength="75"
                                           required>
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
                                            id="category_id" name="category_id" disabled>
                                        <option value="">Chọn khu vực trước</option>
                                    </select>
                                    <div class="form-text">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Vui lòng chọn khu vực trước để hiển thị danh mục
                                        </small>
                                        <br>
                                        <button type="button" class="btn btn-sm btn-outline-info mt-1" onclick="testCascade()">Test Cascade</button>
                                    </div>
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
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô Tả Sản Phẩm <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="4" 
                                              placeholder="Nhập mô tả chi tiết về sản phẩm"
                                              required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá bán <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           id="price" 
                                           name="price" 
                                           value="{{ old('price') }}" 
                                           placeholder="Nhập giá bán"
                                           required>
                                    <div class="form-text" id="price-condition-text">
                                        Nhập giá từ 1,000 ₫ - 999,999,999 ₫
                                    </div>
                                    <div class="alert alert-danger mt-2" id="price-alert" style="display: none;">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <span id="price-alert-message"></span>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="sale_price" class="form-label">Giá Sau Khi Giảm</label>
                                    <x-number-format-input 
                                        id="sale_price" 
                                        name="sale_price" 
                                        value="{{ old('sale_price') }}" 
                                        placeholder="Nhập giá khuyến mãi"
                                        class="@error('sale_price') is-invalid @enderror"
                                    />
                                    @error('sale_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Số Lượng <span class="text-danger">*</span></label>
                                    <x-number-format-input 
                                        id="stock" 
                                        name="stock" 
                                        value="{{ old('stock') }}" 
                                        placeholder="Nhập số lượng"
                                        class="@error('stock') is-invalid @enderror"
                                        required
                                    />
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="featured" 
                                               name="featured" 
                                               value="1" 
                                               {{ old('featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="featured">
                                            Sản Phẩm Nổi Bật
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Ảnh Chính Sản Phẩm <span class="text-danger">*</span></label>
                                    <input type="file" id="primary_image" name="primary_image" accept="image/*" style="display: none;">
                                    
                                    <div class="primary-upload-area border border-2 border-dashed rounded p-3 text-center">
                                        <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                        <h6 class="mb-2">Kéo thả ảnh chính vào đây</h6>
                                        <small class="text-muted d-block mb-2">hoặc</small>
                                        <button type="button" class="btn btn-sm btn-outline-primary">Chọn ảnh chính</button>
                                        <small class="text-muted d-block mt-2">JPG, PNG, GIF tối đa 2MB</small>
                                    </div>
                                    
                                    <div class="primary-preview-area mt-3" style="display: none;">
                                        <label class="form-label">Xem trước ảnh chính:</label>
                                        <div class="primary-preview-container"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Hình Ảnh Bổ Sung</label>
                                    <x-image-upload 
                                        name="images[]" 
                                        multiple="true"
                                        maxSize="2MB"
                                        class="@error('images.*') is-invalid @enderror"
                                    />
                                    @error('images.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Tạo Sản Phẩm</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary me-2">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Pass data to external JavaScript file
window.categoriesData = {!! json_encode($categories) !!};
window.oldSectionId = '{{ old("section_id") }}';
window.oldCategoryId = '{{ old("category_id") }}';
</script>

<style>
/* CSS cho ảnh chính */
.primary-upload-area {
    transition: all 0.3s ease;
    cursor: pointer;
    min-height: 120px !important;
}

.primary-upload-area:hover {
    border-color: #0d6efd !important;
    background-color: #e7f1ff !important;
}

.primary-upload-area.dragover {
    border-color: #0d6efd !important;
    background-color: #e7f1ff !important;
    transform: scale(1.01);
}

.primary-preview-image {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.primary-preview-image:hover {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    transform: translateY(-2px);
}
</style>
@endsection
