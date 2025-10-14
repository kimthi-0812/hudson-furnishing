@extends('layouts.admin')
@section('title', 'Quản Lý Người Dùng')
@section('page-title', 'Quản Lý Người Dùng')

@section('page-actions')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm Người Dùng Mới
    </a>
@endsection

@section('content')

<div class="card shadow mb-4">
    <!-- Standalone Filter -->
    <x-standalone-filter 
        :formAction="route('admin.users.index')" 
        :filterConfig="[
            'filters' => [
                ['type' => 'text', 'name' => 'keyword', 'placeholder' => 'Tìm theo tên hoặc email...', 'label' => 'Từ khóa'],
                ['type' => 'select', 'name' => 'role', 'placeholder' => '-- Tất cả vai trò --', 'label' => 'Vai trò', 'options' => [
                    'admin' => 'Admin',
                    'staff' => 'Nhân viên',
                    'customer' => 'Khách'
                ]]
            ]
        ]"
    />
</div>

<div class="card shadow">
    <div class="card-body table-responsive">
        <table class="table table-bordered users-table" style="table-layout: fixed; width: 100%;">
            <thead>
                <tr>
                    <th style="width: 10%; text-align: center;">Avatar</th>
                    <th style="width: 25%; text-align: center;">Tên</th>
                    <th style="width: 25%; text-align: center;">Email</th>
                    <th style="width: 15%; text-align: center;">Vai Trò</th>
                    <th style="width: 15%; text-align: center;">Ngày Tạo</th>
                    <th style="width: 10%; text-align: center;">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="text-center">
                        <div class="avatar-circle bg-light d-flex align-items-center justify-content-center mx-auto" style="width:50px; height:50px; border-radius:50%;">
                            <span class="text-muted">{{ strtoupper(substr($user->name,0,1)) }}</span>
                        </div>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $user->role->name == 'admin' ? 'danger' : ($user->role->name == 'staff' ? 'primary' : 'success') }}">
                            {{ $user->role->display_name ?? ucfirst($user->role->name) }}
                        </span>
                    </td>
                    <td class="text-center">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa người dùng này?')">
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
                    <td colspan="6" class="text-center py-4">
                        <i class="fas fa-user fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Không tìm thấy người dùng nào</p>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Thêm Người Dùng Đầu Tiên</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>

<style>
.users-table {
    table-layout: fixed;
    width: 100%;
}
.users-table th, .users-table td {
    word-wrap: break-word;
    white-space: normal;
    text-align: center;
}
.users-table .badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    line-height: 1.2;
}
.avatar-circle span {
    font-weight: 600;
    font-size: 1rem;
}
</style>

@endsection
