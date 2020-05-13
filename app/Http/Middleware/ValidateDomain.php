<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Warehouse;
use Auth;

class ValidateDomain
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

        if($subdomain == 'www' || $subdomain == '') {
            return $next($request);
        }

        $warehouse = app('warehouse', ['subdomain' => $subdomain]);
        
        if(empty($warehouse)) {
            abort(404);
        }
        
        return $next($request);
    }
}
