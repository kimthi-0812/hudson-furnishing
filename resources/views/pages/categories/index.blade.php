@extends('layouts.app')

@section('title', 'Categories - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Categories</h1>
        <p class="lead text-muted">Tìm sản phẩm bằng danh mục!</p>
    </div>
    
    <div class="row">
        @foreach($sections as $section)
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title">{{ $section->name }}</h3>
                        <p class="card-text">{{ $section->description }}</p>
                        
                        <div class="row">
                            @foreach($section->categories as $category)
                                <div class="col-md-6 mb-2">
                                    <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                                       class="text-decoration-none">
                                        <div class="d-flex align-items-center p-2 border rounded">
                                            <i class="fas fa-chevron-right text-primary me-2"></i>
                                            <span>{{ $category->name }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-3">
                            <a href="{{ route('products.section', $section->slug) }}" 
                               class="btn btn-outline-primary">
                                View All {{ $section->name }} Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
