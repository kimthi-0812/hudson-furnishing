@props([
    'formAction' => '',
    'filterConfig' => []
])

<div class="card mb-4 standalone-filter">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-filter me-2"></i>Bộ Lọc Nâng Cao
        </h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ $formAction }}" id="standaloneFilterForm">
            <div class="row">
                @foreach($filterConfig['filters'] as $filter)
                    <div class="col-md-3 mb-3">
                        <label class="form-label">{{ $filter['label'] ?? 'Filter' }}</label>
                        @if($filter['type'] == 'text')
                            <input type="text" name="{{ $filter['name'] }}" class="form-control" 
                                   placeholder="{{ $filter['placeholder'] }}" value="{{ request($filter['name']) }}">
                        @elseif($filter['type'] == 'select')
                            <select name="{{ $filter['name'] }}" class="form-select">
                                <option value="">{{ $filter['placeholder'] }}</option>
                                @if(isset($filter['options']) && is_array($filter['options']))
                                    @foreach($filter['options'] as $value => $option)
                                        @if(is_array($option))
                                            <option value="{{ $value }}" {{ request($filter['name']) == $value ? 'selected' : '' }}>
                                                {{ $option['label'] ?? $value }}
                                            </option>
                                        @else
                                            <option value="{{ $value }}" {{ request($filter['name']) == $value ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        @elseif($filter['type'] == 'price_range')
                            <select name="{{ $filter['name'] }}" class="form-select">
                                <option value="">Tất cả giá</option>
                                <option value="0-500000" {{ request($filter['name']) == '0-500000' ? 'selected' : '' }}>Dưới 500K</option>
                                <option value="500000-1000000" {{ request($filter['name']) == '500000-1000000' ? 'selected' : '' }}>500K - 1M</option>
                                <option value="1000000-2000000" {{ request($filter['name']) == '1000000-2000000' ? 'selected' : '' }}>1M - 2M</option>
                                <option value="2000000-5000000" {{ request($filter['name']) == '2000000-5000000' ? 'selected' : '' }}>2M - 5M</option>
                                <option value="5000000-10000000" {{ request($filter['name']) == '5000000-10000000' ? 'selected' : '' }}>5M - 10M</option>
                                <option value="10000000-999999999" {{ request($filter['name']) == '10000000-999999999' ? 'selected' : '' }}>Trên 10M</option>
                            </select>
                        @elseif($filter['type'] == 'stock_range')
                            <select name="{{ $filter['name'] }}" class="form-select">
                                <option value="">Tất cả</option>
                                <option value="0" {{ request($filter['name']) == '0' ? 'selected' : '' }}>Hết hàng (0)</option>
                                <option value="1-10" {{ request($filter['name']) == '1-10' ? 'selected' : '' }}>Ít (1-10)</option>
                                <option value="11-50" {{ request($filter['name']) == '11-50' ? 'selected' : '' }}>Trung bình (11-50)</option>
                                <option value="51-100" {{ request($filter['name']) == '51-100' ? 'selected' : '' }}>Nhiều (51-100)</option>
                                <option value="101-999999" {{ request($filter['name']) == '101-999999' ? 'selected' : '' }}>Rất nhiều (100+)</option>
                            </select>
                        @elseif($filter['type'] == 'date')
                            <input type="text" name="{{ $filter['name'] }}" class="form-control date-input" 
                                   value="{{ request($filter['name']) }}" 
                                   placeholder="dd/mm/yyyy"
                                   pattern="\d{2}/\d{2}/\d{4}"
                                   title="Nhập ngày theo định dạng dd/mm/yyyy">
                        @endif
                    </div>
                @endforeach
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Áp dụng bộ lọc
                        </button>
                        <a href="{{ $formAction }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Xóa bộ lọc
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
/* Uniform sizing for all filter inputs */
.standalone-filter .form-control,
.standalone-filter .form-select {
    height: 38px !important;
    font-size: 14px !important;
    padding: 0.375rem 0.75rem !important;
    line-height: 1.5 !important;
    border: 1px solid #ced4da !important;
    border-radius: 0.375rem !important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
}

.standalone-filter .form-control:focus,
.standalone-filter .form-select:focus {
    border-color: #80bdff !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    outline: 0 !important;
}

.standalone-filter .form-label {
    font-size: 14px !important;
    font-weight: 500 !important;
    margin-bottom: 0.5rem !important;
    color: #495057 !important;
}

/* Date input styling */
.date-input {
    position: relative;
}

/* Custom styling for date text inputs */
.date-input[type="text"] {
    text-align: left;
    font-family: inherit;
}

.date-input[type="text"]:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.date-input[type="text"]:invalid {
    border-color: #dc3545;
}

.date-input[type="text"]:valid {
    border-color: #28a745;
}
</style>

<script>
// Standalone Filter JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('standaloneFilterForm');
    
    // Auto-submit form on select change
    const autoSubmitSelects = filterForm.querySelectorAll('select');
    autoSubmitSelects.forEach(select => {
        select.addEventListener('change', function() {
            filterForm.submit();
        });
    });

    // Debounced search for text input
    const searchInputs = filterForm.querySelectorAll('input[type="text"]');
    searchInputs.forEach(input => {
        let searchTimeout;
        input.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterForm.submit();
            }, 500);
        });
    });

    // Auto-submit on date input change
    const dateInputs = filterForm.querySelectorAll('input[type="text"].date-input');
    dateInputs.forEach(input => {
        // Add date mask functionality
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
            
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2);
            }
            if (value.length >= 5) {
                value = value.substring(0, 5) + '/' + value.substring(5, 9);
            }
            
            e.target.value = value;
            
            // Auto-submit after valid date entry
            if (value.length === 10) {
                setTimeout(() => {
                    filterForm.submit();
                }, 500);
            }
        });
        
        // Prevent invalid characters
        input.addEventListener('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char) && e.which !== 8 && e.which !== 0) {
                e.preventDefault();
            }
        });
        
        // Handle paste events
        input.addEventListener('paste', function(e) {
            setTimeout(() => {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2);
                }
                if (value.length >= 5) {
                    value = value.substring(0, 5) + '/' + value.substring(5, 9);
                }
                e.target.value = value;
            }, 0);
        });
    });
});
</script>
