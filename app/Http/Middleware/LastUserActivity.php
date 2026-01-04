<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Cache;
use Closure;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->last_seen->lt(now())) {
            /* last seen */
            User::where('id', Auth::user()->id)->update(['last_seen' => now()->addMinutes(5)]);

        }
        return $next($request);
    }
}
