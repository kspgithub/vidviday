<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BitrixAuth
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
        $bitrixAuth = $request->input('auth', false);
        if ($bitrixAuth === false || $bitrixAuth['application_token'] !== config('services.bitrix24.incoming-token')) {
            abort(401, 'Unauthorized');
        }

        return $next($request);
    }
}
