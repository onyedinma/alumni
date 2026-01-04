<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (file_exists(storage_path('installed'))) {
            if (auth()->user()->role == USER_ROLE_SUPER_ADMIN) {
                return $next($request);
            } else {
                abort('403');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
