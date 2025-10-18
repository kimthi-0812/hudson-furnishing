// Product Create Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    console.log('Product create page loaded');
    
    // ===== NAME COUNTER =====
    const nameInput = document.getElementById('name');
    const nameCounter = document.getElementById('name-counter');
    
    if (nameInput && nameCounter) {
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
    }
    
    // ===== PRICE VALIDATION =====
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
    if (priceInput) {
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
    }
    
    // ===== CASCADE DROPDOWN =====
    console.log('=== INITIALIZING CASCADE DROPDOWN ===');
    
    const sectionSelect = document.getElementById('section_id');
    const categorySelect = document.getElementById('category_id');
    
    console.log('Section select found:', !!sectionSelect);
    console.log('Category select found:', !!categorySelect);
    
    if (sectionSelect && categorySelect) {
        // Function to filter categories
        function filterCategories() {
            const sectionId = sectionSelect.value;
            console.log('Filtering categories for section:', sectionId);
            
            // Reset category selection
            categorySelect.value = '';
            
            // Get all category options
            const categoryOptions = categorySelect.querySelectorAll('option[data-section]');
            console.log('Found category options:', categoryOptions.length);
            
            // Hide all category options first
            categoryOptions.forEach(option => {
                option.style.display = 'none';
                console.log('Hiding option:', option.textContent);
            });
            
            // Show matching categories
            if (sectionId) {
                let visibleCount = 0;
                categoryOptions.forEach(option => {
                    const optionSectionId = option.getAttribute('data-section');
                    console.log('Checking option:', option.textContent, 'Section:', optionSectionId, 'Matches:', optionSectionId === sectionId);
                    
                    if (optionSectionId === sectionId) {
                        option.style.display = 'block';
                        option.disabled = false;
                        option.hidden = false;
                        visibleCount++;
                        console.log('✅ Showing option:', option.textContent);
                    } else {
                        console.log('❌ Hiding option:', option.textContent, '(Section mismatch)');
                    }
                });
                
                console.log('📊 Total visible categories:', visibleCount);
                
                if (visibleCount === 0) {
                    console.warn('⚠️ No categories found for section:', sectionId);
                    // Show a message option
                    const noCategoriesOption = document.createElement('option');
                    noCategoriesOption.value = '';
                    noCategoriesOption.textContent = 'Không có danh mục cho khu vực này';
                    noCategoriesOption.disabled = true;
                    categorySelect.appendChild(noCategoriesOption);
                }
            } else {
                // No section selected - show all categories
                categoryOptions.forEach(option => {
                    option.style.display = 'block';
                    option.disabled = false;
                    option.hidden = false;
                });
                console.log('🌐 No section selected, showing all categories');
            }
        }
        
        // Event listener for section change
        sectionSelect.addEventListener('change', function() {
            console.log('Section changed to:', this.value);
            filterCategories();
        });
        
        // Initialize on page load
        const oldSectionId = window.oldSectionId;
        if (oldSectionId) {
            console.log('Setting old section ID:', oldSectionId);
            sectionSelect.value = oldSectionId;
        }
        
        filterCategories();
        console.log('Cascade dropdown initialized successfully');
        
    } else {
        console.error('Section or Category select not found!');
        console.log('Section select:', sectionSelect);
        console.log('Category select:', categorySelect);
    }
    
    // Test function - defined globally
    window.testCascade = function() {
        console.log('🧪 === MANUAL CASCADE TEST ===');
        const sectionSelect = document.getElementById('section_id');
        const categorySelect = document.getElementById('category_id');
        
        if (sectionSelect && categorySelect) {
            console.log('📋 Current section value:', sectionSelect.value);
            console.log('📋 All sections available:', Array.from(sectionSelect.options).map(opt => ({value: opt.value, text: opt.textContent})));
            
            // Get all category options with their section data
            const categoryOptions = categorySelect.querySelectorAll('option[data-section]');
            console.log('📋 All categories with sections:', Array.from(categoryOptions).map(opt => ({
                text: opt.textContent,
                section: opt.getAttribute('data-section'),
                display: opt.style.display
            })));
            
            // Re-run filter logic
            const sectionId = sectionSelect.value;
            console.log('🔄 Filtering for section ID:', sectionId);
            
            // Hide all first
            categoryOptions.forEach(option => {
                option.style.display = 'none';
                option.disabled = true;
                option.hidden = true;
            });
            
            // Show matching
            if (sectionId) {
                let visibleCount = 0;
                categoryOptions.forEach(option => {
                    const optionSectionId = option.getAttribute('data-section');
                    if (optionSectionId === sectionId) {
                        option.style.display = 'block';
                        option.disabled = false;
                        option.hidden = false;
                        visibleCount++;
                        console.log('✅ Showing:', option.textContent);
                    }
                });
                console.log('📊 Total visible after test:', visibleCount);
            } else {
                // Show all if no section selected
                categoryOptions.forEach(option => {
                    option.style.display = 'block';
                    option.disabled = false;
                    option.hidden = false;
                });
                console.log('🌐 No section selected, showing all categories');
            }
            
            console.log('✅ Cascade test completed');
        } else {
            console.error('❌ Elements not found for test');
            console.log('Section select found:', !!sectionSelect);
            console.log('Category select found:', !!categorySelect);
        }
    };
    
    // ===== FORM SUBMISSION =====
    const productForm = document.getElementById('productForm');
    if (productForm) {
        productForm.addEventListener('submit', function(e) {
            console.log('Form submitting...');
            
            // Validate primary image
            if (!primarySelectedFile) {
                e.preventDefault();
                alert('Vui lòng chọn ảnh chính cho sản phẩm!');
                return false;
            }
            
            // Validate price before submission (chỉ kiểm tra giá < 1000)
            if (priceInput) {
                const priceValue = priceInput.value.replace(/[^\d]/g, '');
                const numericPrice = parseInt(priceValue);
                
                if (priceValue && numericPrice < 1000) {
                    e.preventDefault();
                    if (priceAlert) {
                        priceAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return false;
                }
            }
            
            // Create FormData and manually handle file upload
            e.preventDefault();
            
            const formData = new FormData();
            
            // Add all form fields
            const formElements = productForm.elements;
            for (let element of formElements) {
                if (element.name && element.type !== 'file') {
                    formData.append(element.name, element.value);
                }
            }
            
            // Add primary image file
            if (primarySelectedFile) {
                formData.append('primary_image', primarySelectedFile);
                console.log('Adding primary image to form:', primarySelectedFile.name);
            }
            
            // Add additional images if any
            console.log('Checking for additional files...');
            console.log('window.selectedAdditionalFiles:', window.selectedAdditionalFiles);
            console.log('Length:', window.selectedAdditionalFiles ? window.selectedAdditionalFiles.length : 0);
            
            if (window.selectedAdditionalFiles && window.selectedAdditionalFiles.length > 0) {
                window.selectedAdditionalFiles.forEach((file, index) => {
                    console.log(`Adding file ${index + 1}:`, file.name, file.size);
                    formData.append('images[]', file);
                });
                console.log('✅ Added', window.selectedAdditionalFiles.length, 'additional images to form');
            } else {
                console.log('❌ No additional files found');
            }
            
            console.log('Submitting form with FormData...');
            
            // Submit form via fetch
            fetch(productForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/admin/products';
                } else {
                    return response.text();
                }
            })
            .then(data => {
                if (data) {
                    // Show error message
                    alert('Có lỗi xảy ra khi tạo sản phẩm');
                    console.error('Error response:', data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi tạo sản phẩm');
            });
        });
    }
    
    // ===== DISCOUNT CALCULATION =====
    const discountTypeSelect = document.getElementById('discount_type');
    const discountValueInput = document.getElementById('discount_value');
    const finalPriceDisplay = document.getElementById('final_price_display');
    const calculatedPrice = document.getElementById('calculated_price');
    const salePriceHidden = document.getElementById('sale_price');
    
    // Function to calculate final price
    function calculateFinalPrice() {
        const originalPrice = priceInput ? parseInt(priceInput.value.replace(/[^\d]/g, '')) : 0;
        const discountValue = parseInt(discountValueInput.value.replace(/[^\d]/g, '')) || 0;
        
        if (!originalPrice || !discountValue) {
            finalPriceDisplay.style.display = 'none';
            salePriceHidden.value = '';
            // Remove error styling from input
            discountValueInput.classList.remove('is-invalid');
            discountValueInput.classList.remove('is-valid');
            return;
        }
        
        let finalPrice = 0;
        
        if (discountTypeSelect.value === 'percent') {
            // Giảm theo %
            const discountAmount = (originalPrice * discountValue) / 100;
            finalPrice = originalPrice - discountAmount;
        } else {
            // Giảm trực tiếp
            finalPrice = originalPrice - discountValue;
        }
        
        // Validation: Giá sau giảm phải nhỏ hơn giá gốc và > 0
        if (finalPrice >= originalPrice) {
            calculatedPrice.textContent = 'Giá sau giảm phải nhỏ hơn giá gốc!';
            calculatedPrice.className = 'text-danger';
            salePriceHidden.value = '';
            // Remove error styling from input
            discountValueInput.classList.remove('is-invalid');
            discountValueInput.classList.remove('is-valid');
        } else if (finalPrice <= 0) {
            calculatedPrice.textContent = 'Giá sau giảm phải lớn hơn 0!';
            calculatedPrice.className = 'text-danger';
            salePriceHidden.value = '';
            // Remove error styling from input
            discountValueInput.classList.remove('is-invalid');
            discountValueInput.classList.remove('is-valid');
        } else {
            // Format và hiển thị giá
            const formattedPrice = finalPrice.toLocaleString('vi-VN') + ' ₫';
            calculatedPrice.textContent = formattedPrice;
            calculatedPrice.className = 'text-success';
            salePriceHidden.value = finalPrice;
            // Remove error styling from input
            discountValueInput.classList.remove('is-invalid');
            discountValueInput.classList.remove('is-valid');
        }
        
        finalPriceDisplay.style.display = 'block';
    }
    
    // Handle discount type change
    if (discountTypeSelect) {
        discountTypeSelect.addEventListener('change', function() {
            if (this.value === 'percent') {
                discountValueInput.placeholder = 'Nhập % giảm giá (ví dụ: 10)';
            } else {
                discountValueInput.placeholder = 'Nhập số tiền giảm (ví dụ: 100000)';
            }
            calculateFinalPrice();
        });
    }
    
    // Handle discount value input
    if (discountValueInput) {
        discountValueInput.addEventListener('input', function(e) {
            // Format input với dấu phẩy
            let rawValue = e.target.value.replace(/[^\d]/g, '');
            
            // Giới hạn tối đa 9 số
            if (rawValue.length > 9) {
                rawValue = rawValue.substring(0, 9);
            }
            
            // Format với dấu phẩy
            if (rawValue) {
                e.target.value = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            } else {
                e.target.value = '';
            }
            
            calculateFinalPrice();
        });
        
        discountValueInput.addEventListener('blur', calculateFinalPrice);
    }
    
    // Recalculate when original price changes
    if (priceInput) {
        priceInput.addEventListener('input', calculateFinalPrice);
        priceInput.addEventListener('blur', calculateFinalPrice);
    }
    
    // Recalculate when discount type changes
    if (discountTypeSelect) {
        discountTypeSelect.addEventListener('change', calculateFinalPrice);
    }

    // ===== STOCK AND STATUS =====
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
    
    // ===== PRIMARY IMAGE DRAG AND DROP =====
    const primaryUploadArea = document.querySelector('.primary-upload-area');
    const primaryFileInput = document.getElementById('primary_image');
    const primaryPreviewContainer = document.querySelector('.primary-preview-container');
    const primaryPreviewArea = document.querySelector('.primary-preview-area');
    
    let primarySelectedFile = null;

    if (primaryUploadArea && primaryFileInput) {
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

        // Click to upload cho button
        const primaryUploadButton = primaryUploadArea.querySelector('button');
        if (primaryUploadButton) {
            primaryUploadButton.addEventListener('click', function(e) {
                e.stopPropagation(); // Ngăn event bubbling
                primaryFileInput.click();
            });
        }

        // File input change cho ảnh chính
        primaryFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                handlePrimaryFile(file);
            }
        });
    }

    // Handle selected file cho ảnh chính
    function handlePrimaryFile(file) {
        console.log('Handling primary file:', file);
        
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
        console.log('Primary file set:', primarySelectedFile);
        updatePrimaryPreview();
        updatePrimaryFileInput();
    }

    // Update preview cho ảnh chính
    function updatePrimaryPreview() {
        if (!primarySelectedFile || !primaryPreviewArea || !primaryPreviewContainer) {
            if (primaryPreviewArea) {
                primaryPreviewArea.style.display = 'none';
            }
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
        console.log('Primary file updated:', primarySelectedFile ? primarySelectedFile.name : 'null');
        
        // Store the file globally for form submission
        window.selectedPrimaryFile = primarySelectedFile;
    }

});
