<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use function Symfony\Component\VarDumper\Dumper\esc;

class UserController extends Controller
{
    function userRegister(){
        return view('Frontend.User.user-register');
    }

    function userLogin(){
        return view('Frontend.User.user-login');
    }

    function ForgetPassword(){
        return view('Frontend.User.user-forget-password');
    }

    //Github Login 

    public function redirectToGithubProvider(){
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderGithubCallback(){
        $user = Socialite::driver('github')->user();
        if (User::where('email',$user->getEmail())->where('provider_id',$user->getId())->exists()) {
            $getEmail = User::where('email',$user->getEmail())->first();
            Auth::guard()->login($getEmail,true);
            return redirect()->route('frontPage');
        }
        else{
            if(User::where('email',$user->getEmail())->exists()){
                return redirect()->route('userLogin')->with('error','Email Already Exists Please Login');
            }
            else{
                $getUser = new User;
                $getUser->name=$user->getName();
                $getUser->email=$user->getEmail();
                $getUser->provider_id=$user->getId();
                $getUser->provider='Github';
                $getUser->save();
            }
            Auth::guard()->login($getUser,true);
            return redirect()->route('frontPage');
        }
    }

    // Google login
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();
        if (User::where('email',$user->getEmail())->where('provider_id',$user->getId())->exists()) {
            $getEmail = User::where('email',$user->getEmail())->first();
            Auth::guard()->login($getEmail,'true');
            return redirect()->route('frontPage');
        }
        else{
            if (User::where('email',$user->getEmail())->exists()) {
                return redirect()->route('userLogin')->with('error','Email Already Exists');
            }
            else{
                $cuser = new User;
                $cuser->name=$user->getName();
                $cuser->email=$user->getEmail();
                $cuser->provider_id=$user->getId();
                $cuser->provider='Google';
                $cuser->save();	 	 	 	 	
            }

            Auth::guard()->login($cuser,'true');
            return redirect()->route('frontPage');
        }
    }
}
