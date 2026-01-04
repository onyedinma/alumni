<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        try{
            $token = Str::random(64);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'otp' => rand(1000, 9999),
                'otp_expiry' => now()->addMinutes(5),
                'created_at' => now()
            ]);

            $user = DB::table('password_resets')->join('users', 'users.email', '=', 'password_resets.email')->where('token', $token)->select('users.email', 'users.name', 'password_resets.otp', 'password_resets.otp_expiry')->first();
            genericEmailNotify('',$user, NULL,'password-reset');

            return redirect(route('password.reset.verify_form', ['token' => $token, 'email' => $request->email]))->with('success', 'We have e-mailed your password reset otp!');
        }catch(Exception $e){
            return back()->with('error', __(SOMETHING_WENT_WRONG));
        }
    }

    public function forgetVerifyForm($token, $email)
    {
        $resetPassword = DB::table('password_resets')->where('token', $token)->where('email', $email)->first();
        return view('auth.passwords.verify', compact('token', 'resetPassword'));
    }

    public function forgetVerify(Request $request, $token)
    {
        $otp = $request->otp__field__1.$request->otp__field__2.$request->otp__field__3.$request->otp__field__4;
        $user = DB::table('password_resets')->join('users', 'users.email', '=', 'password_resets.email')->where('token', $token)->select('users.email', 'users.name', 'password_resets.otp', 'password_resets.otp_expiry')->first();
        if(!is_null($user) && $otp == $user->otp){
            return view('auth.passwords.reset')->with(
                ['token' => $token, 'email' => $request->email]
            );
        } else {
            return back()->with('error', __('Your otp doesn`t match or expired'));
        }
    }


    public function forgetVerifyResend(Request $request, $token)
    {
        $user = DB::table('password_resets')->join('users', 'users.email', '=', 'password_resets.email')->where('token', $token)->select('users.email', 'users.name', 'password_resets.otp', 'password_resets.otp_expiry')->first();
        if (getOption('email_verification_status', 0) == 1) {
            try {
                if (!($user->otp_expiry >= now())) {
                    $otp = rand(1000, 9999);
                    $otp_expiry = now()->addMinutes(5);
                    DB::table('password_resets')->where('token', $token)->update([
                        'otp' => $otp,
                        'otp_expiry' => $otp_expiry,
                    ]);

                    $user->otp = $otp;
                    $user->otp_expiry = $otp_expiry;

                    genericEmailNotify('',$user, NULL,'password-reset');

                    return redirect()->route('password.reset.verify_form', $token, $user->email)->with('success', __('We have sent a fresh verify email.'));
                }
                else{
                   return back()->with('success', __('Already send an email. Please wait a minutes to try another'));
                }
               return back()->with('error', __('Verify Your Rest Password'));
            }catch (Exception $e){
                return back()->with('error', __(SOMETHING_WENT_WRONG));
            }

            return back();
        }else{
            return back();
        }
    }

    public function updatePassword(Request $request, $token)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = DB::table('password_resets')->join('users', 'users.email', '=', 'password_resets.email')->where('token', $token)->select('users.email', 'users.name', 'password_resets.otp', 'password_resets.otp_expiry')->first();
        if(!is_null($user) && $user->email == $request->email){
           User::where('email', $user->email)->update([
                'password' => bcrypt($request->password),
           ]);

           return redirect(route('login'))->with('success', __('Reset Successfully. Please login with new passsword'));
        } else {
            return back()->with('error', __('Email doesn`t match'));
        }
    }

}
