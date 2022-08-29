<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()) {
            if(Auth::user()->level > 0) {
                return $next($request);
            } elseif(Auth::user()->level == 0 or Auth::user()->email_verifyed_at == '') {
                return redirect()->route('error');
            } 
        } else {
            return redirect()->route('login');
        }
    }
}
