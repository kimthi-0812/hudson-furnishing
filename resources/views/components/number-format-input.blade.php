@props([
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'class' => '',
    'id' => null,
    'required' => false,
    'disabled' => false
])

<input 
    type="text" 
    name="{{ $name }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    class="form-control number-format-input {{ $class }}"
    @if($id) id="{{ $id }}" @endif
    @if($required) required @endif
    @if($disabled) disabled @endif
    data-thousands-separator=","
    data-decimal-separator="."
    autocomplete="off"
    title=""
>

<style>
.number-format-input.is-valid {
    border-color: #28a745 !important;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
}

.number-format-input.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

.number-format-input.is-invalid:hover::after {
    content: attr(title);
    position: absolute;
    background: #dc3545;
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 1000;
    top: -40px;
    left: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.number-format-input.is-invalid:hover {
    position: relative;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to format number with thousands separator (integer only)
    function formatNumber(value) {
        if (!value) return '';
        
        // Remove all non-digit characters
        let cleanValue = value.replace(/[^\d]/g, '');
        
        // Add thousands separator to integer part only
        if (cleanValue) {
            cleanValue = cleanValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
        
        return cleanValue;
    }
    
    // Function to get numeric value (remove formatting)
    function getNumericValue(formattedValue) {
        return formattedValue.replace(/[^\d]/g, '');
    }
    
    // Apply to all number format inputs
    document.querySelectorAll('.number-format-input').forEach(function(input) {
        // Format on input
        input.addEventListener('input', function(e) {
            let cursorPosition = e.target.selectionStart;
            let oldValue = e.target.value;
            let newValue = formatNumber(e.target.value);
            
            // Update the input value
            e.target.value = newValue;
            
            // Restore cursor position (adjust for added commas)
            let addedCommas = (newValue.match(/,/g) || []).length - (oldValue.match(/,/g) || []).length;
            let newCursorPosition = cursorPosition + addedCommas;
            
            // Ensure cursor position is within bounds
            newCursorPosition = Math.min(newCursorPosition, newValue.length);
            e.target.setSelectionRange(newCursorPosition, newCursorPosition);
            
            // Validate input
            validateInput(e.target);
            
            // If this is a price field, re-validate sale_price
            if (e.target.name === 'price') {
                const salePriceField = document.querySelector('input[name="sale_price"]');
                if (salePriceField) {
                    validateInput(salePriceField);
                }
            }
        });
        
        // Format on blur (when user leaves the field)
        input.addEventListener('blur', function(e) {
            e.target.value = formatNumber(e.target.value);
            validateInput(e.target);
            
            // If this is a price field, re-validate sale_price
            if (e.target.name === 'price') {
                const salePriceField = document.querySelector('input[name="sale_price"]');
                if (salePriceField) {
                    validateInput(salePriceField);
                }
            }
        });
        
        // Format on focus (when user enters the field)
        input.addEventListener('focus', function(e) {
            e.target.value = formatNumber(e.target.value);
        });
        
        // Prevent non-numeric characters (except comma)
        input.addEventListener('keypress', function(e) {
            let char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char) && e.which !== 8 && e.which !== 9 && e.which !== 27) {
                e.preventDefault();
            }
        });
        
        // Handle paste event
        input.addEventListener('paste', function(e) {
            setTimeout(() => {
                e.target.value = formatNumber(e.target.value);
            }, 0);
        });
    });
    
    // Function to get raw numeric value from formatted input (for form submission)
    window.getFormattedInputValue = function(inputElement) {
        return getNumericValue(inputElement.value);
    };
    
    // Function to validate a single input
    function validateInput(input) {
        const numericValue = getNumericValue(input.value);
        const isStockField = input.name === 'stock';
        const isSalePriceField = input.name === 'sale_price';
        const isDiscountField = input.name === 'discount_value';
        
        if (numericValue && !isNaN(numericValue)) {
            const numValue = parseFloat(numericValue);
            let isValid = true;
            let errorMessage = '';
            
            // Check discount field with different rules for percentage vs fixed
            if (isDiscountField) {
                const discountTypeField = document.querySelector('select[name="discount_type"]');
                if (discountTypeField && discountTypeField.value === 'percentage') {
                    // For percentage: only check > 0 and <= 75
                    if (numValue <= 0) {
                        isValid = false;
                        errorMessage = 'Tỷ lệ giảm giá phải lớn hơn 0%';
                    } else if (numValue > 75) {
                        isValid = false;
                        errorMessage = 'Tỷ lệ giảm giá không được vượt quá 75%';
                    }
                } else {
                    // For fixed value: check >= 1000 and <= 1 billion
                    if (numValue < 1000) {
                        isValid = false;
                        errorMessage = 'Giá trị giảm phải tối thiểu 1,000 VNĐ';
                    } else if (numValue > 1000000000) {
                        isValid = false;
                        errorMessage = 'Giá trị giảm không được vượt quá 1 tỷ VNĐ';
                    }
                }
            } else {
                // For other fields (stock, sale_price, price)
                const minValue = isStockField ? 0 : 1000;
                const maxValue = 1000000000; // 1 tỷ
                
                if (numValue < minValue) {
                    isValid = false;
                    if (isStockField) {
                        errorMessage = 'Số lượng hàng tồn không được âm';
                    } else {
                        errorMessage = 'Giá trị phải tối thiểu 1,000 VNĐ';
                    }
                } else if (numValue > maxValue) {
                    isValid = false;
                    errorMessage = 'Giá trị không được vượt quá 1 tỷ VNĐ';
                }
            }
            
            // Check sale price vs regular price
            if (isSalePriceField && isValid) {
                const priceField = document.querySelector('input[name="price"]');
                if (priceField && priceField.value) {
                    const priceValue = getNumericValue(priceField.value);
                    if (priceValue && !isNaN(priceValue) && numValue >= parseFloat(priceValue)) {
                        isValid = false;
                        errorMessage = 'Giá khuyến mãi phải nhỏ hơn giá niêm yết';
                    }
                }
            }
            
            if (isValid) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                input.title = ''; // Clear error message
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                input.title = errorMessage;
            }
        } else if (!numericValue) {
            input.classList.remove('is-valid', 'is-invalid');
            input.title = ''; // Clear error message
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            input.title = 'Vui lòng nhập số hợp lệ';
        }
    }
    
    // Auto-format existing values on page load and validate
    document.querySelectorAll('.number-format-input').forEach(function(input) {
        if (input.value) {
            input.value = formatNumber(input.value);
        }
        validateInput(input);
    });
    
    // Force re-validate all inputs after a short delay to ensure DOM is ready
    setTimeout(function() {
        document.querySelectorAll('.number-format-input').forEach(function(input) {
            validateInput(input);
        });
    }, 100);
    
    // Re-validate discount_value when discount_type changes
    const discountTypeField = document.querySelector('select[name="discount_type"]');
    if (discountTypeField) {
        discountTypeField.addEventListener('change', function() {
            const discountValueField = document.querySelector('input[name="discount_value"]');
            if (discountValueField) {
                validateInput(discountValueField);
            }
        });
    }
});
</script>
