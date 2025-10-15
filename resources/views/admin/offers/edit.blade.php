@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Ưu Đãi: ' . $offer->title)

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Chỉnh Sửa Ưu Đãi: {{ $offer->title }}</h6>
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
                    {{-- Tiêu đề --}}
                    <div class="form-group">
                        <label for="title">Tiêu Đề Ưu Đãi (<span class="text-danger">*</span>)</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title', $offer->title) }}">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Mô tả --}}
                    <div class="form-group">
                        <label for="description">Mô Tả</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $offer->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Start Date --}}
                    <div class="form-group">
                        <label for="start_date">Ngày Bắt Đầu (<span class="text-danger">*</span>)</label>
                        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" 
                               value="{{ old('start_date', $offer->start_date->format('Y-m-d')) }}">
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- End Date --}}
                    <div class="form-group">
                        <label for="end_date">Ngày Kết Thúc (<span class="text-danger">*</span>)</label>
                        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" 
                               value="{{ old('end_date', $offer->end_date->format('Y-m-d')) }}">
                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    {{-- Discount Type --}}
                    <div class="form-group">
                        <label for="discount_type">Loại Giảm Giá (<span class="text-danger">*</span>)</label>
                        <select name="discount_type" id="discount_type" class="form-control @error('discount_type') is-invalid @enderror">
                            <option value="">-- Chọn Loại --</option>
                            <option value="percentage" {{ old('discount_type', $offer->discount_type) == 'percentage' ? 'selected' : '' }}>Phần Trăm (%)</option>
                            <option value="fixed" {{ old('discount_type', $offer->discount_type) == 'fixed' ? 'selected' : '' }}>Giá Trị Cố Định (VNĐ)</option>
                        </select>
                        @error('discount_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Discount Value --}}
                    <div class="form-group">
                        <label for="discount_value">Giá Trị Giảm (<span class="text-danger">*</span>)</label>
                        <x-number-format-input 
                            name="discount_value"
                            value="{{ old('discount_value', $offer->discount_value) }}"
                            placeholder="Nhập giá trị giảm"
                            class="@error('discount_value') is-invalid @enderror"
                            id="discount_value"
                        />
                        @error('discount_value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label for="status">Trạng Thái (<span class="text-danger">*</span>)</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            @foreach(\App\Helpers\StatusHelper::getStatusOptions() as $key => $option)
                                <option value="{{ $key }}" {{ old('status', $offer->status) == $key ? 'selected' : '' }}>
                                    {{ $option['label'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Image --}}
                    <div class="form-group">
                        <label>Ảnh Hiện Tại</label>
                        <div class="mb-2">
                            @if ($offer->image)
                                <img src="{{ asset('storage/' . $offer->image) }}" alt="Offer Image" style="max-width: 150px; border: 1px solid #ccc;">
                            @else
                                <p class="text-muted">Chưa có ảnh.</p>
                            @endif
                        </div>
                        <label for="image">Thay Đổi Ảnh</label>
                        <x-image-upload name="image" id="image" class="@error('image') is-invalid @enderror"/>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm text-light">
                    <span class="icon text-white-50"><i class="fas fa-sync-alt"></i></span>
                    <span class="text">Cập Nhật Ưu Đãi</span>
                </button>
                <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary btn-sm text-light">Hủy</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle number-format inputs
    document.getElementById('offerForm').addEventListener('submit', function() {
        document.querySelectorAll('.number-format-input').forEach(function(input) {
            if(input.value){
                let hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = input.name;
                hidden.value = input.value.replace(/[^\d]/g,'');
                input.style.display='none';
                input.parentNode.insertBefore(hidden,input);
            }
        });
    });

    // Date validation
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');

    function validateDates() {
        const today = new Date(); today.setHours(0,0,0,0);
        if(startDate.value){
            let s = new Date(startDate.value);
            if(s < today){
                startDate.classList.add('is-invalid');
                startDate.classList.remove('is-valid');
                startDate.title = 'Ngày bắt đầu không được trong quá khứ';
            } else {
                startDate.classList.remove('is-invalid');
                startDate.classList.add('is-valid');
                startDate.title = '';
            }
        }

        if(startDate.value && endDate.value){
            let s = new Date(startDate.value);
            let e = new Date(endDate.value);
            if(e <= s){
                endDate.classList.add('is-invalid');
                endDate.classList.remove('is-valid');
                endDate.title = 'Ngày kết thúc phải sau ngày bắt đầu';
            } else {
                endDate.classList.remove('is-invalid');
                endDate.classList.add('is-valid');
                endDate.title = '';
            }
        }
    }

    startDate.addEventListener('input', validateDates);
    startDate.addEventListener('blur', validateDates);
    endDate.addEventListener('input', validateDates);
    endDate.addEventListener('blur', validateDates);
    validateDates();
});
</script>
@endsection
