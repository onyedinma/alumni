<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IsVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if (getOption('email_verification_status', 0) == 1 && $user->email_verification_status != true && !(in_array($request->route()->getName(), ['email.verify']))) {

            try {
                if (!($user->otp_expiry >= now())) {
                    if (is_null($user->verify_token)) {
                        $user->verify_token = str_replace('-', '', Str::uuid()->toString());
                    }

                    $user->otp = rand(1000, 9999);
                    $user->otp_expiry = now()->addMinute(5);
                    $user->save();

                    genericEmailNotify('',$user, NULL,'email-verification');

                }
                else{
                    return redirect()->route('email.verify', $user->verify_token)->with('success', __('Already send an email. Please wait a minutes to try another'));
                }
                return redirect()->route('email.verify', $user->verify_token)->with('error', __('Verify Your Account'));
            }catch (Exception $e){
                return redirect()->route('email.verify', $user->verify_token)->with('error', __(SOMETHING_WENT_WRONG));
            }

            return redirect(route('email.verify', $user->verify_token));
        }

        return $next($request);
    }
}
