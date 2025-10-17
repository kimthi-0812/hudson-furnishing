@extends('layouts.admin')

@section('title', 'Trash Management - Hudson Furnishing')
@section('page-title', 'Trash Management')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-12 mb-4">
        <div class="row">
            @foreach($statistics as $model => $stats)
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.trash.show', $model) }}" style="text-decoration: none;">
                        <div class="card border-left-{{ $stats['trashed'] > 0 ? 'warning' : 'success' }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                                            {{ ucfirst($model) }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $stats['trashed'] }} / {{ $stats['total'] }}
                                        </div>
                                        <div class="text-xs text-muted">
                                            {{ $stats['active'] }} active
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-{{ $stats['trashed'] > 0 ? 'trash' : 'check-circle' }} fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Trashed Items -->
    <!-- Trashed Items -->
<div class="col-12">
    <div class="card shadow">
        <div class="card-header py-3 bg-dark text-light">
            <h6 class="m-0 font-weight-bold">Trashed Items</h6>
        </div>
        <div class="card-body">
            @if(count($trashedItems) > 0)
                @foreach($trashedItems as $model => $data)
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-light">
                            <h6 class="m-0 font-weight-bold">
                                {{ ucfirst($model) }} ({{ $data['count'] }} items)
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:5%;">ID</th>
                                            <th style="width:40%;">Tên</th>
                                            <th style="width:25%;">Thời gian xóa</th>
                                            <th style="width:30%;" class="text-center">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['items']->take(5) as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    @if(isset($item->name))
                                                        {{ $item->name }}
                                                    @elseif(isset($item->title))
                                                        {{ $item->title }}
                                                    @else
                                                        Item #{{ $item->id }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item->deleted_at ? $item->deleted_at->locale('vi')->translatedFormat('d F Y H:i') : '-' }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm">
                                                        <form method="POST" action="{{ route('admin.trash.restore') }}" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="model" value="{{ $model }}">
                                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                                            <button type="submit" class="btn btn-primary form-confirm" title="Restore">
                                                                <i class="fas fa-undo"></i>
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="{{ route('admin.trash.force-delete') }}" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="model" value="{{ $model }}">
                                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                                            <button type="submit" class="btn btn-danger form-confirm" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                
                            </div>                                                                
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <i class="fas fa-trash fa-3x text-muted mb-3"></i>
                    <h4>No Trashed Items</h4>
                    <p class="text-muted">All items are active. No soft deleted items found.</p>
                </div>
            @endif
        </div>
    </div>
</div>


    <!-- Cleanup Section -->
    <div class="col-12 mt-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-light">Dọn dẹp thùng rác</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.trash.cleanup') }}" class="form-confirm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="days">Xóa những mục cũ hơn (ngày):</label>
                                <input type="number" class="form-control" name="days" value="30" min="1" max="365">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-warning btn-block"                                         >
                                    <i class="fas fa-broom"></i> Dọn dẹp 
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
