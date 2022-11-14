<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request  $request
     * @param Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Locale is enabled and allowed to be changed

        $locale = $request->get('lang', session()->has('locale') ? session()->get('locale') : '');
        if (config('site-settings.locale.status') && ! empty($locale)) {
            session()->put('locale', $locale);
            setAllLocale($locale);
        }

        return $next($request);
    }
}
