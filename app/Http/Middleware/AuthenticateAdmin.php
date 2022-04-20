<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAdmin
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
        //If request does not comes from logged in employee
        //then he shall be redirected to Employees Login page
        if (! \Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
         }
 
        return $next($request);
    }
}
