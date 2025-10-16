<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function track(Request $request) {
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');

        $exists = Visitor::where('ip', $ip)
            ->whereData('created_at', Carbon::today())
            ->exists();
        
        if (!$exists) {
            Visitor::create([
                'ip' => $ip,
                'user_agent' => $userAgent,
            ]);
        }

        return response()->json(['message' => 'đã ghi nhận lượt truy cập']);
    }
}
