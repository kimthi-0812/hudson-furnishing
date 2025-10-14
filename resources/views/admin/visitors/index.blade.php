@extends('layouts.admin')

@section('title', 'Thống Kê Lượt Truy Cập')
@section('page-title', 'Thống Kê Lượt Truy Cập')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">Thống kê truy cập 15 ngày gần nhất</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Tổng Lượt Truy Cập</th>
                    <th>Lượt Truy Cập Độc Nhất</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitorStats as $stat)
                    <tr>
                        <td>{{ $stat->date }}</td>
                        <td>{{ $stat->total_visits }}</td>
                        <td>{{ $stat->unique_visits }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <h5 class="mt-3">Tổng Lượt Truy Cập Toàn Thời Gian: <strong>{{ number_format($totalVisitors) }}</strong></h5>
    </div>
</div>
@endsection
