<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $findUser = User::where('facebook_id', $user->id)->first();

            if ($findUser) {

                Auth::login($findUser);

                return redirect()->intended('home');

            } else {
                $newUser = User::where('email', $user->email)->first();

                if($findUser){
                    $findUser->update(['facebook_id' =>  $user->id]);
                    Auth::login($newUser);
                    return redirect()->intended('home');
                }
                return redirect(route('login'))->with('error', __("You have to registered first to login with facebook"));

            }

        } catch (Exception $e) {
            return redirect(route('login'))->with('error', $e->getMessage());
        }
    }
}
