<?php

namespace App\Http\Middleware;

use Closure;

class MyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, String $role, String $role2 = null)
    {
        if($role == $request->user()->role || $role2 == $request->user()->role){
            return $next($request);
        }
        return abort(503);
    }
}
