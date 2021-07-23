<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsMember
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
        $response = $next($request);
        if(Auth::check() && Auth::user()->status == 'Inactive'){
            Auth::logout();
            return redirect('/login')->withSuccess('Your error text');
        }
        return $response;
    }
}
