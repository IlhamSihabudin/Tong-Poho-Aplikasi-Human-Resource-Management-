<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->id_job == "1") {
                return redirect('/admin');
            }
            elseif(Auth::user()->id_job == "2"){
                return redirect('/manager');
            }
            elseif(Auth::user()->id_job == "3"){
                return redirect('/karyawan');
            }
            else{
                return redirect('/404');
            }
        }

        return $next($request);
    }
}
