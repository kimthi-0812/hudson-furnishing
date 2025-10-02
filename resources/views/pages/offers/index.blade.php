@extends('layouts.app')

@section('title', 'Special Offers - Hudson Furnishing')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Special Offers</h1>
        <p class="lead text-muted">Don't miss out on these amazing deals!</p>
    </div>
    
    <div class="row">
        @forelse($offers as $offer)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-danger">
                    @if($offer->image)
                        <img src="{{ asset('uploads/offers/' . $offer->image) }}" 
                             class="card-img-top" 
                             alt="{{ $offer->title }}"
                             style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-danger">{{ $offer->title }}</h5>
                        <p class="card-text">{{ $offer->description }}</p>
                        
                        <div class="offer-details mb-3">
                            <span class="badge bg-danger fs-6">
                                @if($offer->discount_type == 'percentage')
                                    {{ $offer->discount_value }}% OFF
                                @else
                                    ${{ number_format($offer->discount_value, 2) }} OFF
                                @endif
                            </span>
                        </div>
                        
                        <div class="text-muted">
                            <small>
                                <i class="fas fa-calendar-alt me-1"></i>
                                Valid until: {{ $offer->end_date->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('products.index') }}" class="btn btn-danger w-100">Shop Now</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                    <h4>No offers available</h4>
                    <p class="text-muted">Check back soon for amazing deals!</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Browse Products</a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
