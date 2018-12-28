<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AksesMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $menu)
    {
        if($request->ajax()){
            $user = Auth::guard('api')->user();
        }else{
            $user = $request->user();
        }
        $user->load('hakakses');
        $hakakses = $user->hakakses->hak_akses;
        $hakakses = is_string($hakakses) ? json_decode($hakakses) : $hakakses;
        $hakakses = collect($hakakses)->toArray();
        if(isset($hakakses[$menu]))
            return $next($request);
        abort(503);
    }
}
