@extends('layouts.admin')

@section('title', 'Quản Lý Thùng Rác - Hudson Furnishing')
@section('page-title', 'Quản Lý Thùng Rác')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-12 mb-4">
        <div class="row">
            @foreach($statistics as $model => $stats)
                <div class="col-md-3 mb-3">
                    <div class="card border-left-{{ $stats['trashed'] > 0 ? 'warning' : 'success' }} shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        {{ $modelNames[$model] ?? ucfirst($model) }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $stats['trashed'] }} / {{ $stats['total'] }}
                                    </div>
                                    <div class="text-xs text-muted">
                                        {{ $stats['active'] }} đang hoạt động
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-{{ $stats['trashed'] > 0 ? 'trash' : 'check-circle' }} fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Trashed Items -->
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-light">Các Mục Đã Xóa</h6>
            </div>
            <div class="card-body">
                @if(count($trashedItems) > 0)
                    @foreach($trashedItems as $model => $data)
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold">
                                    {{ $modelNames[$model] ?? ucfirst($model) }} ({{ $data['count'] }} mục)
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Mã số</th>
                                                <th>Tên</th>
                                                <th>Thời gian xóa</th>
                                                <th>Thao tác</th>
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
                                                            Mục #{{ $item->id }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->deleted_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <form method="POST" action="{{ route('admin.trash.restore') }}" class="d-inline">
                                                                @csrf
                                                                <input type="hidden" name="model" value="{{ $model }}">
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                <button type="submit" class="btn btn-success btn-sm" 
                                                                        onclick="return confirm('Khôi phục mục này?')">
                                                                    <i class="fas fa-undo"></i>
                                                                </button>
                                                            </form>
                                                            <form method="POST" action="{{ route('admin.trash.force-delete') }}" class="d-inline">
                                                                @csrf
                                                                <input type="hidden" name="model" value="{{ $model }}">
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                                        onclick="return confirm('Xóa vĩnh viễn mục này?')">
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
                                
                                @if($data['count'] > 5)
                                    <div class="text-center">
                                        <a href="{{ route('admin.trash.show', $model) }}" class="btn btn-outline-primary btn-sm">
                                            Xem Tất Cả {{ $data['count'] }} Mục
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-trash fa-3x text-muted mb-3"></i>
                        <h4>Không Có Mục Đã Xóa</h4>
                        <p class="text-muted">Tất cả mục đều đang hoạt động. Không tìm thấy mục nào đã xóa mềm.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Cleanup Section -->
    <div class="col-12 mt-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-light">Dọn Dẹp Thùng Rác Cũ</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.trash.cleanup') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="days">Xóa các mục cũ hơn (ngày):</label>
                                <input type="number" class="form-control" name="days" value="30" min="1" max="365">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-warning btn-block" 
                                        onclick="return confirm('Điều này sẽ xóa vĩnh viễn các mục cũ trong thùng rác. Tiếp tục?')">
                                    <i class="fas fa-broom"></i> Dọn Dẹp Thùng Rác Cũ
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
