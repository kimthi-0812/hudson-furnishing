<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SoftDeleteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply to admin routes
        if ($request->is('admin/*')) {
            // Override delete methods to use soft delete
            if ($request->isMethod('DELETE')) {
                // This will be handled in the controllers
                $request->merge(['_soft_delete' => true]);
            }
        }

        return $next($request);
    }
}
