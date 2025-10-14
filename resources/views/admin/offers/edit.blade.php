@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Ưu Đãi: ' . $offer->title)

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Chỉnh Sửa Ưu Đãi: {{ $offer->title }}</h6>
        <a href="{{ route('admin.offers.index') }}" class="btn btn-info btn-sm">
            <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách
        </a>
    </div>
    <div class="card-body">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                Vui lòng kiểm tra lại các lỗi sau:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.offers.update', $offer) }}" method="POST" enctype="multipart/form-data" id="offerForm">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    {{-- Trường Title --}}
                    <div class="form-group">
                        <label for="title">Tiêu Đề Ưu Đãi (<span class="text-danger">*</span>)</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $offer->title) }}" >
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường Type --}}
                    <div class="form-group">
                        <label for="type">Loại Ưu Đãi (<span class="text-danger">*</span>)</label>
                        <select name="discount_type" id="discount_type" class="form-control @error('discount_type') is-invalid @enderror" >
                            <option value="">-- Chọn Loại --</option>
                            <option value="percentage" {{ old('discount_type', $offer->type) == 'percentage' ? 'selected' : '' }}>Phần Trăm (%)</option>
                            <option value="fixed" {{ old('discount_type', $offer->type) == 'fixed' ? 'selected' : '' }}>Giá Trị Cố Định</option>
                        </select>
                        @error('discount_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    {{-- Trường Value --}}
                    <div class="form-group">
                        <label for="value">Giá Trị Ưu Đãi (<span class="text-danger">*</span>)</label>
                        <x-number-format-input 
                            name="discount_value" 
                            value="{{ old('discount_value', $offer->discount_value) }}" 
                            placeholder="Nhập giá trị ưu đãi"
                            class="@error('discount_value') is-invalid @enderror"
                            id="value"
                            
                        />
                        @error('discount_value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    {{-- Trường Start Date --}}
                    <div class="form-group">
                        <label for="start_date">Ngày Bắt Đầu (<span class="text-danger">*</span>)</label>
                        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" 
                               value="{{ old('start_date', \Carbon\Carbon::parse($offer->start_date)->format('d/m/Y')) }}" >
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trường End Date --}}
                    <div class="form-group">
                        <label for="end_date">Ngày Kết Thúc (<span class="text-danger">*</span>)</label>
                        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" 
                               value="{{ old('end_date', \Carbon\Carbon::parse($offer->end_date)->format('d/m/y')) }}" >
                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    {{-- Trường Image --}}
                    <div class="form-group">
                        <label>Ảnh Hiện Tại</label>
                        <div class="mb-2">
                            @if ($offer->image)
                                <img src="{{ asset('storage/' . $offer->image) }}" alt="Offer Image" style="max-width: 150px; border: 1px solid #ccc;">
                            @else
                                <p class="text-muted">Chưa có ảnh.</p>
                            @endif
                        </div>
                        <label for="image">Thay Đổi Ảnh Đại Diện</label>
                        <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng Thái (<span class="text-danger">*</span>)</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" >
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ngừng Hoạt Động</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Trường Description --}}
            <div class="form-group">
                <label for="description">Mô Tả Chi Tiết</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $offer->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Trường Product IDs (Sản phẩm áp dụng) --}}
            
            
            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-sync-alt"></i> Cập Nhật Ưu Đãi
            </button>
        </form>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission - convert formatted numbers to raw values
    document.getElementById('offerForm').addEventListener('submit', function(e) {
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
        
        // No conversion needed for date inputs - they already send yyyy-mm-dd format
    });
    
    // Date validation
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    
    function validateDates() {
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Reset time to start of day
        
        if (startDateInput.value) {
            const startDate = new Date(startDateInput.value);
            if (startDate < today) {
                startDateInput.classList.add('is-invalid');
                startDateInput.classList.remove('is-valid');
                startDateInput.title = 'Ngày bắt đầu không được trong quá khứ';
            } else {
                startDateInput.classList.remove('is-invalid');
                startDateInput.classList.add('is-valid');
                startDateInput.title = '';
            }
        }
        
        if (endDateInput.value && startDateInput.value) {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const oneDayAfter = new Date(startDate);
            oneDayAfter.setDate(oneDayAfter.getDate() + 1);
            
            if (endDate < oneDayAfter) {
                endDateInput.classList.add('is-invalid');
                endDateInput.classList.remove('is-valid');
                endDateInput.title = 'Ngày kết thúc phải sau ngày bắt đầu ít nhất 1 ngày';
            } else {
                endDateInput.classList.remove('is-invalid');
                endDateInput.classList.add('is-valid');
                endDateInput.title = '';
            }
        }
    }
    
    // Add event listeners for date validation
    if (startDateInput) {
        startDateInput.addEventListener('input', validateDates);
        startDateInput.addEventListener('blur', validateDates);
    }
    
    if (endDateInput) {
        endDateInput.addEventListener('input', validateDates);
        endDateInput.addEventListener('blur', validateDates);
    }
    
    // Initial validation
    validateDates();
});
</script>

<style>
/* Date input validation styles */
input[type="date"].is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

input[type="date"].is-valid {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

/* Tooltip styles for date inputs */
input[type="date"][title]:hover::after {
    content: attr(title);
    position: absolute;
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 1000;
    margin-top: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

input[type="date"][title]:hover::before {
    content: '';
    position: absolute;
    border: 5px solid transparent;
    border-bottom-color: #dc3545;
    margin-top: -10px;
    z-index: 1000;
}

/* Custom date input styling */
input[type="date"] {
    position: relative;
    cursor: pointer;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    cursor: pointer;
    padding: 4px;
    margin-right: 2px;
    border-radius: 3px;
}
</style>

@endsection