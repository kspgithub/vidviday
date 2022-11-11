<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        if ($user->isTourAgent()) {
            if (! $user->isVerified()) {
                return $this->destroy($request)->withFlashDanger(__('E-mail Verification Failure'));
            }
            if (! $user->isActive()) {
                return $this->destroy($request)->withFlashDanger(__('E-mail Verification is pending'));
            }
        }

        return redirect()->back();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request  $request
     *
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $redirect = $request->get('redirect', false);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $redirect ? redirect()->to($redirect) : redirect()->back();
    }
}
