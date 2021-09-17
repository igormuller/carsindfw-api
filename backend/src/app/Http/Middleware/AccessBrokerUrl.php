<?php

namespace App\Http\Middleware;

use App\Models\Broker;
use Closure;
use Illuminate\Http\Request;

class AccessBrokerUrl
{
    public function handle(Request $request, Closure $next)
    {
        $broker = Broker::where('token_access', $request->header('broker-key'))->first();

        if (empty($broker)) {
            return response('Broker don\'t exist', 401);
        }

        $request->attributes->add(['broker' => $broker]);
        return $next($request);
    }
}
