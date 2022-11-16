<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && ($user->isAdmin() || $user->isManager() || $user->isDutyManager() || $user->isTourManager())) {
            return $next($request);
        }
        
        if ($request->ajax()) {
            abort(401, __('You do not have access to do that.'));
        }

        return redirect()->route('admin.login.create')->withFlashDanger(__('You do not have access to do that.'));
    }
}
