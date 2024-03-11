<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginStatus
{
    public function handle($request, Closure $next)
    {

    if (Auth::check() && Auth::user()->status == 0 ) {
        Auth::logout();
        return redirect('/login')->with('error', 'Your account has been logged out.');
    } 

        return $next($request);
    }
}
