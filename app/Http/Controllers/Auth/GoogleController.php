<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $findUser = User::where('google_id', $user->id)->first();
            
            if ($findUser) {
                
                Auth::login($findUser);
                
                return redirect()->intended('home');
                
            } else {
                $newUser = User::where('email', $user->email)->first();

                if($findUser){
                    $findUser->update(['google_id' =>  $user->id]);
                    Auth::login($newUser);
                    return redirect()->intended('home');
                }

                return redirect(route('login'))->with('error', __("You have to registered first to login with google"));
            }

        } catch (Exception $e) {
           return redirect(route('login'))->with('error', $e->getMessage());
        }
    }
}
