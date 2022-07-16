<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Cache;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RedirectMiddleware
{
    public Collection $redirects;

    public function __construct()
    {
        $this->redirects = Cache::remember('redirects', 1, function () {
            return Redirect::query()->published()->get();
        });
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = urldecode($request->getRequestUri());

        $redirect = null;

        if($full = $this->redirects->where('type', Redirect::TYPE_FULL)->where('from', $uri)->first()) {
            $redirect = $full->to;
        }

        if($particular = $this->redirects->where('type', Redirect::TYPE_PARTIAL)->filter(function (Redirect $r) use($uri) {
            return Str::contains($uri, $r->from);
        })->first()) {
            $redirect = Str::replace($particular->from, $particular->to, $uri);
        }

        if($regex = $this->redirects->where('type', Redirect::TYPE_REGEX)->filter(function (Redirect $r) use($uri) {
            try {
                return preg_match($r->from, $uri);
            } catch (\Exception $e) {
                return false;
            }
        })->first()) {
            $redirect = preg_replace($regex->from, $regex->to, $uri);
        }

        if($redirect) {
            return redirect()->to(htmlspecialchars($redirect));
        }

        return $next($request);
    }
}
