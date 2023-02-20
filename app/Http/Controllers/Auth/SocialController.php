<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\GeneralException;
use App\Http\Requests\Social\SocialVerifyRequest;
use App\Models\User;
use App\Services\Auth\SocialAuth;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Exception;
use Google_Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
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
        try {
            $data = Socialite::driver($provider)->user();
            if (empty($data->email)) {
                return redirect()->route('auth.login')->withFlashDanger('До цього облікового запису не прив\'язаний емейл.');
            }

//        if (User::where('email', $data->email)->count() === 0) {
//            return redirect()->route('auth.login')
//                ->withFlashDanger('Користувача з адресою електронної пошти, прив\'язаною до цього облікового запису, не знайдено.');
//        }

            $user = $userService->registerProvider($data, $provider);

            if (!$user) {
                return redirect()->route('auth.login')->withFlashDanger(__('There was a problem connecting to :provider', ['provider' => $provider]));
            }

//            if ($user->status !== User::STATUS_ACTIVE) {
//                auth()->logout();
//                return redirect()->route('auth.login')->withFlashDanger(__('Your account has been deactivated.'));
//            }

            auth()->login($user);

            return redirect()->route(homeRoute());
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('auth.login')->withFlashDanger(__('There was a problem connecting to :provider', ['provider' => $provider]));
        }

    }

    public function verify(SocialVerifyRequest $request, $provider, UserService $userService)
    {
        try {

            $socialite = Socialite::driver($provider);

            $credential = $request->get('credential');
            $authenticator = SocialAuth::for($provider);
            $payload = $authenticator->verify($credential);

            $payload['id'] = Arr::get($payload, 'sub');
            $payload['verified_email'] = Arr::get($payload, 'email_verified');
            $payload['link'] = Arr::get($payload, 'profile');

            $data = (new \Laravel\Socialite\Two\User)->setRaw($payload)->map([
                'id' => Arr::get($payload, 'sub'),
                'nickname' => Arr::get($payload, 'nickname'),
                'name' => Arr::get($payload, 'name'),
                'email' => Arr::get($payload, 'email'),
                'avatar' => $avatarUrl = Arr::get($payload, 'picture'),
                'avatar_original' => $avatarUrl,
            ]);

            if ($data) {
                $user = $userService->registerProvider($data, $provider);

                if($user) {
                    auth()->login($user);

                    return redirect()->route(homeRoute());
                }
            } else {
                // Invalid ID token
                return redirect()->route('auth.login')->withFlashDanger(__('There was a problem connecting to :provider', ['provider' => $provider]));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('auth.login')->withFlashDanger(__('There was a problem connecting to :provider', [
                'provider' => $provider,
                'message' => $e->getMessage(),
            ]));
        }
    }
}
