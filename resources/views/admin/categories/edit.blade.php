@extends('layouts.admin')

@section('title', 'Edit Category - Hudson Furnishing')
@section('page-title', 'Chỉnh Sửa Danh Mục')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa danh mục: {{ $category->name }}</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Tên Danh Mục *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $category->name) }}" required>
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
                        <option value="{{ $section->id }}" {{ old('section_id', $category->section_id) == $section->id ? 'selected' : '' }}>
                            {{ $section->name }}
                        </option>
                    @endforeach
                </select>
                @error('section_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="text-end">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary me-2">Hủy</a>
                <button type="submit" class="btn btn-primary">Cập nhật Danh mục</button>
            </div>
        </form>
    </div>
</div>
@endsection
