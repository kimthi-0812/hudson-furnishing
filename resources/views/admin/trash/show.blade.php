@extends('layouts.admin')

@section('title', 'Trash - ' . ucfirst($model))
@section('page-title', 'Trash - ' . ucfirst($model))

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-light">{{ ucfirst($model) }} đã xóa</h6>
    </div>
    <div class="card-body">
        @if ($items->count() > 0)
            <form method="POST" action="#" class="bulk-action-form form-confirm">
                @csrf
                <input type="hidden" name="model" value="{{ $model }}">

                <div class="table-responsive">
                    <table class="table table-sm table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="30"><input type="checkbox" data-select-all></th>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Tên</th>
                                <th>Thời gian xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                @php
                                    $url = $model == 'products'
                                        ? ($item->image ? asset('storage/uploads/' . $item->image) : null)
                                        : ($item->image ? asset('storage/' . $item->image) : null);
                                @endphp
                                <tr>
                                    <td style="width: 14%; text-align: center;"><input class="ms-4" type="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @if ($url)
                                            <img src="{{ $url }}"
                                                 alt="{{ $item->name ?? ($item->title ?? 'Item #' . $item->id) }}"
                                                 class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            <span class="text-muted">Không có hình ảnh</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->name ?? ($item->title ?? 'Item #' . $item->id) }}</td>
                                    <td>
                                        @if ($item->deleted_at)
                                            {{ $item->deleted_at->locale('vi')->translatedFormat('d F Y H:i') }}
                                        @else
                                            <span class="text-muted">Không có thời gian xóa</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex gap-2 mt-2">
                    <button type="submit" formaction="{{ route('admin.trash.bulk-restore') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-undo"></i> Khôi phục đã chọn
                    </button>
                    <button type="submit" formaction="{{ route('admin.trash.bulk-force-delete') }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Xóa đã chọn
                    </button>
                </div>
            </form>

            <div class="mt-3">
                {{ $items->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-trash fa-3x text-muted mb-3"></i>
                <h4>Không có mục nào đã xóa</h4>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
