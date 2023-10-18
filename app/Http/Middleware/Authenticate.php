<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if($request->routeIs('admin.*')) {
        Session::put('login_need','login_need');
            return $request->expectsJson() ? null : route('home');
        }else if($request->routeIs('user.*')) {
        Session::put('login_need','login_need');
            return $request->expectsJson() ? null : route('home');
        }else if($request->routeIs('doctor.*')) {
        Session::put('login_need','login_need');
            return $request->expectsJson() ? null : route('home');
        }else if($request->routeIs('receptionist.*')) {
        Session::put('login_need','login_need');
            return $request->expectsJson() ? null : route('home');
        }else {
            return $request->expectsJson() ? null : route('home');
        }
    }
}
