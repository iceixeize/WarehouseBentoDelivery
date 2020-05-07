<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Warehouse;
use Auth;
use URL;

class AccessWarehouse
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
        $subdomain = $request->route()->parameter('subdomain');
        if($subdomain == 'www') {
            return redirect()->route('manage.dashboard')->with('subdomain');
        } 

        $user = app('user', ['user_id' => Auth::user()->user_id]);

        if($user->userRoles->is_super_admin) {
            // return route choosewarehouse
            return $next($request);
        } else {
            if($user->warehouses()->where('subdomain', $subdomain)->first()) {
            return $next($request);
        }
            // check warehouse = 1 return warehouse มันจะเป็น loop มั้ยวะ
            return $next($request);
        }

        

        if($subdomain == 'www') {
            return $next($request);
        }

        return redirect()->route('manage.home'); 

    }
}
