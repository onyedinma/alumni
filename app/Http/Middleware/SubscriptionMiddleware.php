<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;

class SubscriptionMiddleware
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
        if(isAddonInstalled('ALUSAAS') && getPackageLimit(PACKAGE_RULE_EXPIRED) && auth()->user()?->role == USER_ROLE_ADMIN){
            if (str_starts_with($request->route()->getName(), 'admin.subscription.')) {
                return $next($request);
            }else{
                return redirect()->route('admin.subscription.index')->withInput()->with('error', __('You dont have any active plan or plan has been expired. Please login to admin panel and upgrade plan'));
            }
        }else if(isAddonInstalled('ALUSAAS') && getPackageLimit(PACKAGE_RULE_EXPIRED)){
            \Auth::logout();
            return redirect()->route('index')->withInput()->with('error', __('You dont have any active plan or plan has been expired. Please login to admin panel in main domain and upgrade plan'));
        }

        return $next($request);
    }
}
