@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Vật Liệu: ' . $material->name)

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-light">Chỉnh Sửa Vật Liệu: {{ $material->name }}</h6>
    </div>
    <div class="card-body">

        {{-- Hiển thị thông báo lỗi Validation --}}
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

        {{-- Form Chỉnh Sửa --}}
        <form action="{{ route('admin.materials.update', $material) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            {{-- Tên Vật Liệu --}}
            <div class="form-group mb-3">
                <label for="name">Tên Vật Liệu (<span class="text-danger">*</span>)</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name', $material->name) }}" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Mô Tả --}}
            <div class="form-group mb-3">
                <label for="description">Mô Tả</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-control @error('description') is-invalid @enderror" 
                    rows="4"
                >{{ old('description', $material->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Ảnh Đại Diện --}}
            <div class="form-group mb-3 image-upload-simple">
                <label for="image" class="form-label fw-bold">Hình Ảnh Vật Liệu</label>
                
                <div class="upload-area ">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2 "></i>
                        <strong class="text-muted mb-2">Kéo thả hình ảnh vào đây</strong>
                        <p class="text-muted">hoặc</p>
                    </div>
                    <label for="image" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Chọn hình ảnh
                    </label>
                    <input type="file" name="image" id="image" class="d-none" accept="image/*">
                    <small class="text-muted d-block mt-2">Chỉ 1 ảnh, tối đa 2MB</small>
                </div>

                {{-- Preview --}}
                <div class="preview-container mt-2" style="display: {{ $material->image ? 'block' : 'none' }};">
                    <img id="preview-image" 
                         src="{{ $material->image ? asset('storage/' . $material->image) : '' }}" 
                         alt="Preview" 
                         class="img-fluid rounded border" 
                         style="max-width: 200px; max-height: 150px; object-fit: cover;">
                </div>

                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-sync-alt"></i> Cập Nhật Vật Liệu
            </button>
            <a href="{{ route('admin.materials.index') }}" class="btn btn-secondary btn-sm text-white">Hủy</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image');
    const previewContainer = document.querySelector('.preview-container');
    const previewImage = document.getElementById('preview-image');
    const uploadArea = document.querySelector('.upload-area');

    // Click area to choose file
    uploadArea.addEventListener('click', () => fileInput.click());

    // Drag & Drop
    uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.classList.add('dragover'); });
    uploadArea.addEventListener('dragleave', e => { e.preventDefault(); uploadArea.classList.remove('dragover'); });
    uploadArea.addEventListener('drop', e => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
        fileInput.dispatchEvent(new Event('change'));
    });

    // Preview image
    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            alert('Chỉ chọn file ảnh!');
            fileInput.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Kích thước ảnh vượt quá 2MB!');
            fileInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
});
</script>

<style>
.image-upload-simple .upload-area {
    border: 2px dashed #ced4da;
    border-radius: 0.375rem;
    padding: 20px;
    text-align: center;
    background-color: #f8f9fa;
    cursor: pointer;
    transition: all 0.3s ease;
}
.image-upload-simple .upload-area:hover,
.image-upload-simple .upload-area.dragover {
    border-color: #0d6efd;
    background-color: #e7f1ff;
    transform: scale(1.02);
}
</style>
@endsection
