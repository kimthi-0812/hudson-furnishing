<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        $maintenance = SiteSetting::where('key', 'maintenance_mode')->first();
        $endTime = SiteSetting::where('key', 'maintenance_end')->first();

        $active = $maintenance && $maintenance->value == '1';
        $notExpired = true;

        if ($endTime && !empty($endTime->value)) {
            $notExpired = now()->lt(\Carbon\Carbon::parse($endTime->value));
        }

        // Nếu đang bảo trì và không phải admin
        if ($active && $notExpired && !$request->is('admin*')) {
            $maintenanceEnd = $endTime ? $endTime->value : now()->addDay();
            return response()->view('errors.maintenance', compact('maintenanceEnd'));
        }

        return $next($request);
    }
}
