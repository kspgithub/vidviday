<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\GeneralException;
use App\Models\User;
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
     * @param UserService $userService
     *
     * @return RedirectResponse
     * @throws GeneralException
     *
     */
    public function callback($provider, UserService $userService)
    {
        $data = Socialite::driver($provider)->user();
        if (empty($data->email)) {
            return redirect()->route('auth.login')->withFlashDanger('До цього облікового запису не прив\'язаний емейл.');
        }

//        if (User::where('email', $data->email)->count() === 0) {
//            return redirect()->route('auth.login')
//                ->withFlashDanger('Користувача з адресою електронної пошти, прив\'язаною до цього облікового запису, не знайдено.');
//        }

        $user = $userService->registerProvider($data, $provider);

        if (!$user->isActive()) {
            auth()->logout();

            return redirect()->route('auth.login')->withFlashDanger(__('Your account has been deactivated.'));
        }

        auth()->login($user);

        return redirect()->route(homeRoute());
    }
}
