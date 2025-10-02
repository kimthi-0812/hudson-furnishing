@extends('layouts.admin')

@section('title', 'Contact Details - Hudson Furnishing')
@section('page-title', 'Contact Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ $contact->name }}</h5>
                        <p class="text-muted mb-3">{{ $contact->message }}</p>
                        
                        <div class="contact-meta mb-3">
                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                            @if($contact->phone)
                                <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                            @endif
                            <p><strong>Status:</strong> 
                                <span class="badge bg-{{ $contact->status == 'new' ? 'warning' : ($contact->status == 'read' ? 'info' : 'success') }}">
                                    {{ ucfirst($contact->status) }}
                                </span>
                            </p>
                            <p><strong>Date:</strong> {{ $contact->created_at->format('M d, Y H:i') }}</p>
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
                                <h6>Quick Actions</h6>
                                <div class="d-grid gap-2">
                                    @if($contact->status == 'new')
                                        <form method="POST" action="{{ route('admin.contacts.read', $contact) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="fas fa-check me-2"></i>Mark as Read
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($contact->status == 'read')
                                        <form method="POST" action="{{ route('admin.contacts.replied', $contact) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success w-100">
                                                <i class="fas fa-reply me-2"></i>Mark as Replied
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a href="mailto:{{ $contact->email }}" class="btn btn-info">
                                        <i class="fas fa-envelope me-2"></i>Send Email
                                    </a>
                                    
                                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" 
                                          class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="fas fa-trash me-2"></i>Delete Contact
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
                <h6 class="m-0 font-weight-bold text-primary">Update Contact Status</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.contacts.update', $contact) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="new" {{ $contact->status == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="read" {{ $contact->status == 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="replied" {{ $contact->status == 'replied' ? 'selected' : '' }}>Replied</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="notes" class="form-label">Admin Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ $contact->notes }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border-end">
                            <h4 class="text-primary">{{ $contact->created_at->format('d') }}</h4>
                            <small class="text-muted">Day</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <h4 class="text-success">{{ $contact->created_at->format('M') }}</h4>
                        <small class="text-muted">Month</small>
                    </div>
                </div>
                
                <div class="mt-3">
                    <small class="text-muted">Received: {{ $contact->created_at->format('M d, Y H:i') }}</small><br>
                    <small class="text-muted">Updated: {{ $contact->updated_at->format('M d, Y H:i') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
