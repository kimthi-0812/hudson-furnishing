<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorStat;
use Carbon\Carbon;

class VisitorStatsController extends Controller
{
    public function index()
    {
        $visitorStats = VisitorStat::where('date', '>=', Carbon::now()->subDays(15))
            ->orderBy('date')
            ->get(['date', 'total_visits', 'unique_visits']);

        // Tổng lượt truy cập tất cả ngày (nếu muốn)
        $totalVisitors = VisitorStat::sum('total_visits');

        return view('admin.visitors.index', compact('visitorStats', 'totalVisitors'));
    }
}
