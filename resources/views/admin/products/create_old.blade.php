@extends('layouts.admin')

@section('title', 'Tạo Sản Phẩm - Hudson Furnishing')
@section('page-title', 'Tạo Sản Phẩm')

@section('content')

<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Tạo sản phẩm mới</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="productForm">
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
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá bán<span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="price" 
                            value="{{ old('price') }}" 
                            placeholder="Nhập giá bán"
                            class="form-control @error('price') is-invalid @enderror"
                            id="price"
                            required
                            maxlength="15"
                            autocomplete="off"
                        />
                        <div class="form-text">
                            <span id="price-condition-text" class="text-muted">
                                Nhập giá từ 1,000 ₫ - 999,999,999 ₫
                            </span>
                        </div>
                        <div id="price-alert" class="alert alert-danger mt-2" style="display: none;">
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
                            name="sale_price" 
                            value="{{ old('sale_price') }}" 
                            placeholder="Nhập giá khuyến mãi"
                            class="@error('sale_price') is-invalid @enderror"
                            id="sale_price"
                        />
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock" class="form-label">Số Lượng<span class="text-danger">*</span></label>
                        <x-number-format-input 
                            name="stock" 
                            value="{{ old('stock') }}" 
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
                <label class="form-label fw-bold">Ảnh Chính Sản Phẩm <span class="text-danger">*</span></label>
                
                <!-- Upload Area cho ảnh chính -->
                <div class="primary-upload-area border border-2 border-dashed rounded-3 p-3 text-center mb-3 @error('primary_image') border-danger @enderror" 
                     style="border-color: #dee2e6; background-color: #f8f9fa; min-height: 120px;">
                    <div class="upload-content d-flex flex-column justify-content-center h-100">
                        <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                        <h6 class="text-muted mb-2">Kéo thả ảnh chính vào đây</h6>
                        <p class="text-muted mb-2 small">hoặc</p>
                        <label for="primary_image" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Chọn ảnh chính
                        </label>
                        <input type="file" 
                               id="primary_image" 
                               name="primary_image" 
                               class="d-none" 
                               accept="image/*"
                               required>
                        <div class="mt-1">
                            <small class="text-muted small">
                                Chỉ 1 ảnh, tối đa 2MB
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Preview Area cho ảnh chính -->
                <div class="primary-preview-area" style="display: none;">
                    <h6 class="text-muted mb-2">Ảnh chính đã chọn:</h6>
                    <div class="primary-preview-container">
                        <!-- Preview ảnh chính sẽ được chèn vào đây -->
                    </div>
                </div>

                @error('primary_image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <x-image-upload 
                    name="images"
                    label="Hình Ảnh Bổ Sung"
                    :multiple="true"
                    :required="false"
                    :maxFiles="4"
                    acceptedTypes="image/*"
                    maxSize="2MB"
                    class="@error('images.*') is-invalid @enderror"
                />
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
    
    // Price validation
    const priceInput = document.getElementById('price');
    const priceAlert = document.getElementById('price-alert');
    const priceAlertMessage = document.getElementById('price-alert-message');
    const priceConditionText = document.getElementById('price-condition-text');
    
    function validatePrice() {
        const priceValue = priceInput.value.replace(/[^\d]/g, ''); // Remove formatting
        const numericPrice = parseInt(priceValue);
        
        if (priceValue === '') {
            priceAlert.style.display = 'none';
            priceConditionText.style.color = '#6c757d';
            return true;
        }
        
        // Chỉ hiển thị alert khi giá < 1000, không alert khi > 999999999
        if (numericPrice < 1000) {
            priceAlertMessage.textContent = 'Giá sản phẩm phải tối thiểu 1,000 ₫';
            priceAlert.style.display = 'block';
            priceConditionText.style.color = '#dc3545';
            priceInput.classList.add('is-invalid');
            return false;
        } else {
            priceAlert.style.display = 'none';
            priceConditionText.style.color = '#28a745';
            priceInput.classList.remove('is-invalid');
            priceInput.classList.add('is-valid');
            return true;
        }
    }
    
    // Xử lý input giá hoàn toàn độc lập
    priceInput.addEventListener('input', function(e) {
        // Lấy chỉ số từ input
        let rawValue = e.target.value.replace(/[^\d]/g, '');
        console.log('Raw value length:', rawValue.length, 'Raw value:', rawValue);
        
        // Giới hạn tối đa 9 số
        if (rawValue.length > 9) {
            rawValue = rawValue.substring(0, 9);
            console.log('Truncated to 9 digits:', rawValue);
        }
        
        // Format với dấu phẩy
        if (rawValue) {
            e.target.value = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        } else {
            e.target.value = '';
        }
        
        console.log('Final formatted value:', e.target.value);
        
        // Validate
        validatePrice();
    });
    
    priceInput.addEventListener('blur', validatePrice);
    
    // ===== CASCADE DROPDOWN VỚI JAVASCRIPT THUẦN =====
    const sectionSelect = document.getElementById('section_id');
    const categorySelect = document.getElementById('category_id');
    
    // Embed categories data directly in JavaScript
    const categoriesData = {!! json_encode($categories) !!};
    console.log('Categories data loaded:', categoriesData);
    
    // Function to update categories based on selected section
    function updateCategoriesDropdown() {
        const selectedSectionId = sectionSelect.value;
        console.log('Selected section ID:', selectedSectionId);
        
        // Clear current options
        categorySelect.innerHTML = '<option value="">Chọn Danh Mục</option>';
        
        if (selectedSectionId && selectedSectionId !== '') {
            // Filter categories by selected section
            const filteredCategories = categoriesData.filter(category => 
                parseInt(category.section_id) === parseInt(selectedSectionId)
            );
            
            console.log('Filtered categories for section', selectedSectionId, ':', filteredCategories);
            
            // Add filtered categories to dropdown
            filteredCategories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                
                // Check if this was the old selected value
                const oldCategoryId = '{{ old("category_id") }}';
                if (oldCategoryId && parseInt(category.id) === parseInt(oldCategoryId)) {
                    option.selected = true;
                }
                
                categorySelect.appendChild(option);
            });
            
            // Enable dropdown
            categorySelect.disabled = false;
            
            if (filteredCategories.length === 0) {
                categorySelect.innerHTML = '<option value="">Không có danh mục nào</option>';
                categorySelect.disabled = true;
            }
        } else {
            // No section selected
            categorySelect.innerHTML = '<option value="">Chọn khu vực trước</option>';
            categorySelect.disabled = true;
        }
    }
    
    // Handle section change
    sectionSelect.addEventListener('change', updateCategoriesDropdown);
    
    // Initialize on page load
    console.log('Initializing cascade dropdown...');
    
    // Handle old values
    const oldSectionId = '{{ old("section_id") }}';
    if (oldSectionId) {
        sectionSelect.value = oldSectionId;
        updateCategoriesDropdown();
    } else {
        // Ensure category dropdown is disabled initially
        categorySelect.disabled = true;
    }
    
    console.log('Cascade dropdown initialized');
    
    // Test function
    window.testCascade = function() {
        console.log('=== TEST CASCADE ===');
        console.log('Categories data:', categoriesData);
        console.log('Current section value:', sectionSelect.value);
        console.log('Section select element:', sectionSelect);
        console.log('Category select element:', categorySelect);
        
        if (categoriesData.length > 0) {
            console.log('Sample category:', categoriesData[0]);
            console.log('All section IDs:', categoriesData.map(c => c.section_id));
        }
        
        // Test filtering
        if (sectionSelect.value) {
            const filtered = categoriesData.filter(c => parseInt(c.section_id) === parseInt(sectionSelect.value));
            console.log('Filtered result for section', sectionSelect.value, ':', filtered);
        }
        
        // Force update
        updateCategoriesDropdown();
        console.log('===================');
    };
    
    // Handle form submission - convert formatted numbers to raw values
    document.getElementById('productForm').addEventListener('submit', function(e) {
        // Validate price before submission (chỉ kiểm tra giá < 1000)
        const priceValue = priceInput.value.replace(/[^\d]/g, '');
        const numericPrice = parseInt(priceValue);
        
        if (priceValue && numericPrice < 1000) {
            e.preventDefault();
            priceAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }
        
        // Convert price input to raw value
        if (priceInput.value) {
            let hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = priceInput.name;
            hiddenInput.value = priceInput.value.replace(/[^\d]/g, ''); // Remove all non-numeric characters
            
            // Replace the formatted input with hidden input
            priceInput.style.display = 'none';
            priceInput.parentNode.insertBefore(hiddenInput, priceInput);
        }
        
        // Get all other number format inputs and convert them to raw values
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
            stockInput.addEventListener('input', function() {
                const stockValue = parseInt(this.value.replace(/[^\d]/g, ''));
                const activeOption = statusSelect.querySelector('option[value="active"]');
                
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

    // ===== CHỨC NĂNG KÉO THẢ CHO ẢNH CHÍNH =====
    const primaryUploadArea = document.querySelector('.primary-upload-area');
    const primaryFileInput = document.getElementById('primary_image');
    const primaryPreviewContainer = document.querySelector('.primary-preview-container');
    const primaryPreviewArea = document.querySelector('.primary-preview-area');
    
    let primarySelectedFile = null;

    // Drag and drop functionality cho ảnh chính
    primaryUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        primaryUploadArea.classList.add('dragover');
    });

    primaryUploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        primaryUploadArea.classList.remove('dragover');
    });

    primaryUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        primaryUploadArea.classList.remove('dragover');
        
        const files = Array.from(e.dataTransfer.files);
        handlePrimaryFile(files[0]); // Chỉ lấy file đầu tiên
    });

    // Click to upload cho ảnh chính
    primaryUploadArea.addEventListener('click', function() {
        primaryFileInput.click();
    });

    // File input change cho ảnh chính
    primaryFileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            handlePrimaryFile(file);
        }
    });

    // Handle selected file cho ảnh chính
    function handlePrimaryFile(file) {
        // Check file type
        if (!file.type.startsWith('image/')) {
            alert('Chỉ được chọn file hình ảnh!');
            return;
        }
        
        // Check file size (2MB = 2 * 1024 * 1024 bytes)
        if (file.size > 2 * 1024 * 1024) {
            alert('Kích thước file không được vượt quá 2MB!');
            return;
        }

        primarySelectedFile = file;
        updatePrimaryPreview();
        updatePrimaryFileInput();
    }

    // Update preview cho ảnh chính
    function updatePrimaryPreview() {
        if (!primarySelectedFile) {
            primaryPreviewArea.style.display = 'none';
            return;
        }

        primaryPreviewArea.style.display = 'block';
        
        const reader = new FileReader();
        reader.onload = function(e) {
            primaryPreviewContainer.innerHTML = `
                <div class="primary-preview-image position-relative">
                    <img src="${e.target.result}" 
                         alt="Primary Preview" 
                         class="img-fluid rounded border"
                         style="width: 100%; max-width: 300px; height: 200px; object-fit: cover;">
                    <button type="button" 
                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                            onclick="removePrimaryPreview()"
                            title="Xóa ảnh chính">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
        };
        reader.readAsDataURL(primarySelectedFile);
    }

    // Remove preview cho ảnh chính
    window.removePrimaryPreview = function() {
        primarySelectedFile = null;
        updatePrimaryPreview();
        updatePrimaryFileInput();
    };

    // Update file input cho ảnh chính
    function updatePrimaryFileInput() {
        const dt = new DataTransfer();
        if (primarySelectedFile) {
            dt.items.add(primarySelectedFile);
        }
        primaryFileInput.files = dt.files;
    }

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
</script>
@endsection
