@extends('layouts.admin')

@section('title', 'Offers Management - Hudson Furnishing')
@section('page-title', 'Offers Management')

@section('page-actions')
    <a href="{{ route('admin.offers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Offer
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Offers</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offers as $offer)
                        <tr>
                            <td>
                                @if($offer->image)
                                    <img src="{{ asset('uploads/offers/' . $offer->image) }}" 
                                         alt="{{ $offer->title }}" class="img-thumbnail" style="width: 50px; height: 50px;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $offer->title }}</td>
                            <td>
                                @if($offer->discount_type == 'percentage')
                                    {{ $offer->discount_value }}% OFF
                                @else
                                    ${{ number_format($offer->discount_value, 2) }} OFF
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $offer->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($offer->status) }}
                                </span>
                            </td>
                            <td>{{ $offer->start_date->format('M d, Y') }}</td>
                            <td>{{ $offer->end_date->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.offers.show', $offer) }}" 
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.offers.edit', $offer) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.offers.destroy', $offer) }}" 
                                          class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No offers found</p>
                                <a href="{{ route('admin.offers.create') }}" class="btn btn-primary">
                                    Add Your First Offer
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $offers->links() }}
        </div>
    </div>
</div>
@endsection
