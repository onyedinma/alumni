<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Google2FAAuthentication
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
        if(Auth::user()){
            $user = User::where('id',auth()->user()->id)->first();
            if($user && $user->google_auth_status == 1){
                    if(Session::get('2fa_status') == false){
                        return redirect()->route('google2fa.authenticate.verify');
                    }
            }
        }
        return $next($request);
    }
}
