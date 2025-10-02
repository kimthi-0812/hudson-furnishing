@extends('layouts.app')

@section('title', 'Materials - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Materials</h1>
        <p class="lead text-muted">Explore the premium materials we use</p>
    </div>
    
    <div class="row">
        @forelse($materials as $material)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    @if($material->image)
                        <img src="{{ asset('uploads/materials/' . $material->image) }}" 
                             class="card-img-top" 
                             alt="{{ $material->name }}"
                             style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $material->name }}</h5>
                        @if($material->description)
                            <p class="card-text text-muted">{{ Str::limit($material->description, 100) }}</p>
                        @endif
                        <a href="{{ route('products.index', ['material' => $material->id]) }}" 
                           class="btn btn-outline-primary btn-sm">
                            View Products
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-cube fa-3x text-muted mb-3"></i>
                    <h4>No materials available</h4>
                    <p class="text-muted">Check back soon for our material collections!</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
