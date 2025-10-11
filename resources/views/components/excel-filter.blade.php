@props([
    'formAction' => '',
    'filterConfig' => [],
    'tableClass' => 'admin-table'
])

<form method="GET" action="{{ $formAction }}" id="excelFilterForm">
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-filter me-2"></i>Bộ Lọc Cột (Excel Style)
                </h6>
                <div>
                    <button type="submit" class="btn btn-sm btn-primary me-2">
                        <i class="fas fa-search"></i> Áp dụng
                    </button>
                    <a href="{{ $formAction }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times"></i> Xóa bộ lọc
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered {{ $tableClass }}" style="table-layout: fixed; width: 100%;">
            <thead>
                <tr>
                    @foreach($filterConfig['headers'] as $header)
                        <th style="width: {{ $header['width'] }}%; text-align: center;">{{ $header['title'] }}</th>
                    @endforeach
                </tr>
                <!-- Excel-style Filter Row -->
                <tr class="filter-row">
                    @foreach($filterConfig['filters'] as $filter)
                        <th style="width: {{ $filter['width'] }}%; text-align: center; padding: 8px;">
                            @if($filter['type'] == 'text')
                                <input type="text" name="{{ $filter['name'] }}" class="form-control form-control-sm" 
                                       placeholder="{{ $filter['placeholder'] }}" value="{{ request($filter['name']) }}"
                                       style="font-size: 12px;">
                            @elseif($filter['type'] == 'select')
                                <select name="{{ $filter['name'] }}" class="form-select form-select-sm" style="font-size: 12px;">
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
                                <select name="{{ $filter['name'] }}" class="form-select form-select-sm" style="font-size: 12px;">
                                    <option value="">Tất cả giá</option>
                                    <option value="0-500000" {{ request($filter['name']) == '0-500000' ? 'selected' : '' }}>Dưới 500K</option>
                                    <option value="500000-1000000" {{ request($filter['name']) == '500000-1000000' ? 'selected' : '' }}>500K - 1M</option>
                                    <option value="1000000-2000000" {{ request($filter['name']) == '1000000-2000000' ? 'selected' : '' }}>1M - 2M</option>
                                    <option value="2000000-5000000" {{ request($filter['name']) == '2000000-5000000' ? 'selected' : '' }}>2M - 5M</option>
                                    <option value="5000000-10000000" {{ request($filter['name']) == '5000000-10000000' ? 'selected' : '' }}>5M - 10M</option>
                                    <option value="10000000-999999999" {{ request($filter['name']) == '10000000-999999999' ? 'selected' : '' }}>Trên 10M</option>
                                </select>
                            @elseif($filter['type'] == 'stock_range')
                                <select name="{{ $filter['name'] }}" class="form-select form-select-sm" style="font-size: 12px;">
                                    <option value="">Tất cả</option>
                                    <option value="0" {{ request($filter['name']) == '0' ? 'selected' : '' }}>Hết hàng (0)</option>
                                    <option value="1-10" {{ request($filter['name']) == '1-10' ? 'selected' : '' }}>Ít (1-10)</option>
                                    <option value="11-50" {{ request($filter['name']) == '11-50' ? 'selected' : '' }}>Trung bình (11-50)</option>
                                    <option value="51-100" {{ request($filter['name']) == '51-100' ? 'selected' : '' }}>Nhiều (51-100)</option>
                                    <option value="101-999999" {{ request($filter['name']) == '101-999999' ? 'selected' : '' }}>Rất nhiều (100+)</option>
                                </select>
                            @elseif($filter['type'] == 'date')
                                <input type="date" name="{{ $filter['name'] }}" class="form-control form-control-sm" 
                                       value="{{ request($filter['name']) }}" style="font-size: 12px;">
                            @elseif($filter['type'] == 'none')
                                <!-- No filter for this column -->
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
</form>

<style>
/* Excel-style Filter Row Styling */
.filter-row {
    background-color: #f8f9fa;
    border-top: 2px solid #dee2e6;
}

.filter-row th {
    padding: 8px 4px !important;
    vertical-align: middle;
    border-bottom: 1px solid #dee2e6;
}

.filter-row .form-control,
.filter-row .form-select {
    border: 1px solid #ced4da;
    border-radius: 4px;
    transition: all 0.15s ease-in-out;
}

.filter-row .form-control:focus,
.filter-row .form-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.filter-row .form-control.border-primary,
.filter-row .form-select.border-primary {
    border-color: #007bff !important;
    background-color: #f8f9ff !important;
}

/* Responsive adjustments for filter inputs */
@media (max-width: 768px) {
    .filter-row th {
        padding: 4px 2px !important;
    }
    
    .filter-row .form-control,
    .filter-row .form-select {
        font-size: 10px;
        padding: 2px 4px;
    }
}
</style>

<script>
// Excel-style Column Filtering
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('excelFilterForm');
    
    // Auto-submit form on select change
    const autoSubmitSelects = filterForm.querySelectorAll('select');
    
    autoSubmitSelects.forEach(select => {
        select.addEventListener('change', function() {
            filterForm.submit();
        });
    });

    // Debounced search for text input
    const searchInput = filterForm.querySelector('input[type="text"]');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterForm.submit();
            }, 500); // Wait 500ms after user stops typing
        });
    }

    // Auto-submit on date input change
    const dateInputs = filterForm.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        input.addEventListener('change', function() {
            filterForm.submit();
        });
    });

    // Add visual feedback for active filters
    function highlightActiveFilters() {
        const inputs = filterForm.querySelectorAll('input, select');
        inputs.forEach(input => {
            if (input.value && input.value !== '') {
                input.classList.add('border-primary');
                input.style.backgroundColor = '#f8f9ff';
            } else {
                input.classList.remove('border-primary');
                input.style.backgroundColor = '';
            }
        });
    }
    
    // Call on page load
    highlightActiveFilters();
    
    // Update visual feedback when inputs change
    const allInputs = filterForm.querySelectorAll('input, select');
    allInputs.forEach(input => {
        input.addEventListener('change', highlightActiveFilters);
        input.addEventListener('input', highlightActiveFilters);
    });
});
</script>
