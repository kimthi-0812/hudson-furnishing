@extends('layouts.admin')

@section('title', 'Thông Tin Liên Hệ - Hudson Furnishing')
@section('page-title', 'Thông Tin Liên Hệ')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-light">Thông Tin Liên Hệ</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ $contact->name }}</h5>
                        <p class="text-muted mb-3">{{ $contact->message }}</p>
                        
                        <div class="contact-meta mb-3">
                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                            @if($contact->phone)
                                <p><strong>Số điện thoại:</strong> {{ $contact->phone }}</p>
                            @endif
                            <p><strong>Tình Trạng:</strong> 
                                <span class="badge bg-{{ $contact->status == 'new' ? 'warning' : ($contact->status == 'read' ? 'info' : 'success') }}">
                                    {{ ucfirst($contact->status) }}
                                </span>
                            </p>
                            <p><strong>Ngày:</strong> {{ $contact->created_at->locale('vi')->translatedFormat('d F Y \\lú\\c H:i') }}</p>
                        </div>
                        
                        @if($contact->notes)
                            <div class="notes-section">
                                <h6>Admin Notes</h6>
                                <p class="text-muted">{{ $contact->notes }}</p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6>Thao Tác Nhanh</h6>
                                <div class="d-grid gap-2">
                                    @if($contact->status == 'new')
                                        <form method="POST" action="{{ route('admin.contacts.read', $contact) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fas fa-check me-2"></i>Đánh Dấu Đã Đọc
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($contact->status == 'read')
                                        <form method="POST" action="{{ route('admin.contacts.replied', $contact) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success w-100">
                                                <i class="fas fa-reply me-2"></i>Đánh Dấu Đã Trả Lời
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a href="mailto:{{ $contact->email }}" class="btn btn-info">
                                        <i class="fas fa-envelope me-2"></i>Gửi Email
                                    </a>
                                    
                                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" 
                                          class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="fas fa-trash me-2"></i>Xóa Tin Nhắn Liên Hệ
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Update Status Form -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-light">Cập Nhật Tình Trạng Liên Hệ</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.contacts.update', $contact) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Tình Trạng</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="new" {{ $contact->status == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="read" {{ $contact->status == 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="replied" {{ $contact->status == 'replied' ? 'selected' : '' }}>Replied</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="notes" class="form-label">Ghi Chú Của Admin</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ $contact->notes }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Cập Nhật Liên Hệ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-light">Thống Kê Liên Hệ</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border-end">
                            <h4 class="text-primary">{{ $contact->created_at->format('d') }}</h4>
                            <small class="text-muted">Ngày</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <h4 class="text-success">{{ $contact->created_at->locale('vi')->translatedFormat('F') }}</h4>
                        <small class="text-muted">Tháng</small>
                    </div>
                </div>
                
                <div class="mt-3">
                    <small class="text-muted">Nhận: {{ $contact->created_at->locale('vi')->translatedFormat('d F Y H:i') }}</small><br>
                    <small class="text-muted">Cập Nhật: {{ $contact->updated_at->locale('vi')->translatedFormat('d F Y H:i') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
