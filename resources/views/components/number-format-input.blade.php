@props([
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'class' => '',
    'id' => null,
    'required' => false,
    'disabled' => false,
    'maxlength' => null
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
    @if($maxlength) maxlength="{{ $maxlength }}" @endif
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

    // --- Helper: format và bỏ định dạng ---
    function formatNumber(value) {
        if (!value) return '';
        const num = value.toString().replace(/[^\d]/g, '');
        return num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function getNumericValue(formattedValue) {
        return formattedValue.replace(/[^\d]/g, '');
    }

    // --- Áp dụng cho tất cả input có class number-format-input ---
    document.querySelectorAll('.number-format-input').forEach(function(input) {

        // Khi người dùng nhập
        input.addEventListener('input', function(e) {
            let rawValue = e.target.value.replace(/[^\d]/g, '');
            
            // Giới hạn số ký tự nếu có maxlength
            const maxLength = e.target.getAttribute('maxlength');
            
            if (maxLength && rawValue.length > parseInt(maxLength)) {
                rawValue = rawValue.substring(0, parseInt(maxLength));
            }
            
            const formatted = formatNumber(rawValue);
            e.target.value = formatted;
            validateInput(e.target);

            // Nếu là price thì validate lại sale_price
            if (e.target.name === 'price') {
                const salePriceField = document.querySelector('input[name="sale_price"]');
                if (salePriceField) validateInput(salePriceField);
            }
        });

        // Khi rời khỏi input
        input.addEventListener('blur', function(e) {
            e.target.value = formatNumber(e.target.value);
            validateInput(e.target);

            if (e.target.name === 'price') {
                const salePriceField = document.querySelector('input[name="sale_price"]');
                if (salePriceField) validateInput(salePriceField);
            }
        });

        // Khi focus lại (đảm bảo format đúng)
        input.addEventListener('focus', function(e) {
            e.target.value = formatNumber(e.target.value);
        });

        // Chặn ký tự không phải số
        input.addEventListener('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char) && e.which !== 8 && e.which !== 9 && e.which !== 27) {
                e.preventDefault();
            }
        });

        // Xử lý paste (dán)
        input.addEventListener('paste', function(e) {
            setTimeout(() => {
                e.target.value = formatNumber(e.target.value);
            }, 0);
        });
    });

    // --- Validate dữ liệu ---
    function validateInput(input) {
        const numericValue = getNumericValue(input.value);
        const isStockField = input.name === 'stock';
        const isSalePriceField = input.name === 'sale_price';
        const isDiscountField = input.name === 'discount_value';

        if (numericValue && !isNaN(numericValue)) {
            const numValue = parseFloat(numericValue);
            let isValid = true;
            let errorMessage = '';

            if (isDiscountField) {
                const discountTypeField = document.querySelector('select[name="discount_type"]');
                if (discountTypeField && discountTypeField.value === 'percentage') {
                    if (numValue <= 0) {
                        isValid = false;
                        errorMessage = 'Tỷ lệ giảm giá phải lớn hơn 0%';
                    } else if (numValue > 75) {
                        isValid = false;
                        errorMessage = 'Tỷ lệ giảm giá không được vượt quá 75%';
                    }
                } else {
                    if (numValue < 1000) {
                        isValid = false;
                        errorMessage = 'Giá trị giảm phải tối thiểu 1,000 VNĐ';
                    } else if (numValue > 1000000000) {
                        isValid = false;
                        errorMessage = 'Giá trị giảm không được vượt quá 1 tỷ VNĐ';
                    }
                }
            } else {
                const minValue = isStockField ? 0 : 1000;
                const maxValue = 1000000000;

                if (numValue < minValue) {
                    isValid = false;
                    errorMessage = isStockField
                        ? 'Số lượng hàng tồn không được âm'
                        : 'Giá trị phải tối thiểu 1,000 VNĐ';
                } else if (numValue > maxValue) {
                    isValid = false;
                    errorMessage = 'Giá trị không được vượt quá 1 tỷ VNĐ';
                }
            }

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
                input.title = '';
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                input.title = errorMessage;
            }

        } else if (!numericValue) {
            input.classList.remove('is-valid', 'is-invalid');
            input.title = '';
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            input.title = 'Vui lòng nhập số hợp lệ';
        }
    }

    // --- Format và validate khi load trang ---
    document.querySelectorAll('.number-format-input').forEach(function(input) {
        if (input.value) input.value = formatNumber(input.value);
        validateInput(input);
    });

    // --- Revalidate khi thay đổi loại giảm giá ---
    const discountTypeField = document.querySelector('select[name="discount_type"]');
    if (discountTypeField) {
        discountTypeField.addEventListener('change', function() {
            const discountValueField = document.querySelector('input[name="discount_value"]');
            if (discountValueField) validateInput(discountValueField);
        });
    }

});
</script>
