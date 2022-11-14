<?php

namespace App\Http\Middleware;

use App\Models\Partner;
use Closure;
use Illuminate\Http\Request;

class AuthPartnerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (empty($request->input('token', $request->bearerToken()))) {
            return response()->json(['error' => __('Missing authorization token')], 401);
        }
        $token = $request->input('token', $request->bearerToken());
        $partner = Partner::where('token', $token)->first();
        if (empty($partner)) {
            return response()->json(['error' => __('Invalid authorization token')], 401);
        } elseif ($partner->status === Partner::STATUS_BLOCKED) {
            return response()->json(['error' => __('You authorization token was blocked')], 403);
        } elseif (! $partner->checkDomain($request->headers->get('referer'))) {
            return response()->json(['error' => __('You can only send requests from a domain: ').$partner->domain], 403);
        }
        
        return $next($request);
    }
}
