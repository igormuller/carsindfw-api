<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        return $next($request)->header('Access-Control-Allow-Origin', '*')
                              ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
                              ->header('Access-Control-Allow-Headers', 'Accept, X-XSRF-TOKEN, Access-Control-Allow-Headers, X-Requested-With, Content-Type, X-Auth-Token, Authorization, Origin');;
    }
}
