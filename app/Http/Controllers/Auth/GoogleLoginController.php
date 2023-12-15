<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleLoginController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function authGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $find_user = User::where('google_id', $user->id)->first();

            if ($find_user) {

                Auth::login($find_user);
                toastr()->success('Đăng nhập thành công', ' ');
                return redirect('/user/dashboard');
            } else {
                $new_user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' =>  Hash::make('12345678')
                ]);
                // dd($new_user);

                Auth::login($new_user);
                toastr()->success('Đăng nhập thành công', ' ');
                return redirect('/user/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
