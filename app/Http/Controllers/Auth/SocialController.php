<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\GeneralException;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class SocialController.
 */
class SocialController extends Controller
{
    /**
     * @param $provider
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @param  UserService  $userService
     *
     * @throws GeneralException
     *
     * @return RedirectResponse
     */
    public function callback($provider, UserService $userService)
    {
        $user = $userService->registerProvider(Socialite::driver($provider)->user(), $provider);

        if (! $user->isActive()) {
            auth()->logout();

            return redirect()->route('frontend.auth.login')->withFlashDanger(__('Your account has been deactivated.'));
        }

        auth()->login($user);

        return redirect()->route(homeRoute());
    }
}
