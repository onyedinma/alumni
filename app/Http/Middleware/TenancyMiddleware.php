<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;

class TenancyMiddleware
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        $host = request()->getHost();
        $domain = Domain::where('domain', $host)->first();

        if (is_null($domain) && isAddonInstalled('ALUSAAS')) {
            abort(404);
        }

        return $next($request);
    }
}
