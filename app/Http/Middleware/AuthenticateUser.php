<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (!Auth::guard('users')->check()) {
            return redirect()->route('front.login');
        }

        // if (Auth::guard('users')->user()->stripe_id && \Route::currentRouteName() === "front.plans") {
        //     return redirect()->route('front.user.profile');
        // }
        return $next($request);
    }
}
