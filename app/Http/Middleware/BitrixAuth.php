<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BitrixAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');
        $bitrixAuth = $request->input('auth', false);
        $route_name = $request->route()->getName();
        switch ($route_name) {
            case 'crm.contact.update':
                $token = config('services.bitrix24.contact-token');

                break;
            case 'crm.deal.update':
                $token = config('services.bitrix24.deal-token');

                break;
            case 'crm.app.install':
            case 'crm.app.check-server':
                return $next($request);

                break;
            default:
                return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($bitrixAuth === false || empty($bitrixAuth['application_token']) || $bitrixAuth['application_token'] !== $token) {
            return response()->json(['result' => 'ERROR', 'message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
