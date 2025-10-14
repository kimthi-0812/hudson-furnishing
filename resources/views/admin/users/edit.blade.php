@extends('layouts.admin')
@section('title', 'Cập Nhật Người Dùng')
@section('page-title', 'Cập Nhật Người Dùng')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            </div>            
            <div class="mb-3">
                <label for="role_id" class="form-label">Vai Trò</label>
                <select name="role_id" class="form-select">
                    <option value="">Chọn vai trò</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->display_name ?? ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Cập Nhật Người Dùng</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection
