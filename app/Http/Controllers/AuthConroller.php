<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthConroller extends Controller
{
    public function auth(Request $request) {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Check each guard for the email
        $guards = ['web', 'admin', 'doctor','receptionist'];
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt(['email' => $email, 'password' => $password], $request->get('remember'))) {
                // If the attempt is successful, redirect to the intended location
                Toast::info(Lang::get('toast.login'));
                return redirect()->intended('/');
            }
        }
        // If none of the guards match, return back with an error
        Toast::danger(Lang::get('toast.invalid_email_pwd'));
        return back();

    }
    public function need() {
        Toast::danger(Lang::get('messages.login_need'));
        return redirect()->back();
    }
    public function google() {
        return Socialite::driver('google')->redirect();
    }
    public function googleRedirect() {
        $user = Socialite::driver('google')->user();
        $find = User::where('email', $user->email)->where('social_id', $user->id)->first();
        if($find) {
            Auth::guard('web')->login($find);
            Toast::info(Lang::get('toast.login'));
            return redirect()->route('home');
        } else {
            $emailExists = User::where('email', $user->email)->first();
            if($emailExists) {
                Toast::danger(Lang::get('toast.email_exists'));
                return redirect()->route('home');
            } else {
                $verify_code = random_int(100000, 999999);
                $verify_code = str_pad($verify_code, 6, 0, STR_PAD_LEFT);
                $user = User::firstOrCreate([
                    'first_name' => $user->name,
                    'last_name' => $user->name,
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make(Str::random(24)),
                    'image' => $user->avatar,
                    'social_id' => $user->id,
                    'social' => 'google',
                ]);
                $user->verification_code = $verify_code;
                $user->verified = 0;
                $user->save();
                Auth::guard('web')->login($user);
                return redirect()->route('send-code');
            }
        }

    }
    public function facebook() {
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookRedirect() {
        $user = Socialite::driver('facebook')->user();
        $find = User::where('email', $user->email)->where('social_id', $user->id)->first();
        if($find) {
            Auth::guard('web')->login($find);
            Toast::info(Lang::get('toast.login'))
            ;
            return redirect()->route('home');
        }else {
            $emailExists = User::where('email', $user->email)->first();
            if($emailExists) {
                Toast::danger(Lang::get('toast.email_exists'));
                return redirect()->route('home');
            } else {
                $verify_code = random_int(100000, 999999);
                $verify_code = str_pad($verify_code, 6, 0, STR_PAD_LEFT);
                $user = User::firstOrCreate([
                    'social_id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'password' => Hash::make(Str::random(24)),
                    'social' => 'facebook',
                    'image' => $user->avatar,
                    'verification_code' => $verify_code,
                    'verified' => '0'
                ]);
                Auth::guard('web')->login($user);
                return redirect()->route('send-code');
            }
        }

    }
    public function verify(Request $req) {
        $req->validate([
            'verfication_code' => 'required|min:6|numeric',
        ]);
        $user = User::find(Auth::user()->id);
        if($req->verfication_code == Auth::user()->verification_code) {
            $user->email_verified_at = Carbon::now()->timestamp;
            $user->verified = '1';
            $user->save();
            Toast::success(Lang::get('toast.verified'));
            return redirect()->route('home');
        }
    }
    public function get_email(Request $req) {
        $req->validate([
            'email' => 'required|email',
        ]);
        Session::put('email',$req->email);
        return redirect()->route('reset.password');
    }
    public function get_token($token) {
        $user = User::where('reset_token', $token)->first();
        if ($user) {
            return view('auth.password.reset', ['token' => $token]);
        } else {
            // handle invalid token
        }
    }

    public function reset_pwd(Request $req) {
        $formField = $req->validate([
            'password'=>'required',
            'cpassword'=>'required|same:password',
        ]);
        $user = User::where('reset_token', $req->token)->first();
        if ($user) {
            $user->password = Hash::make($req->password); // hash the new password
            $user->reset_token = null; // clear the reset token
            $user->save();
            Toast::success(Lang::get('toast.pwd_update'));
            return redirect()->route('home');
        } else {
            Toast::danger(Lang::get('toast.acc_not_found'));
            return redirect()->route('home');
        }
    }


    public function logout(Request $req) {
        Auth::guard('web')->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        Toast::success(Lang::get('toast.logout'));
        return redirect()->route('home');
    }
}
