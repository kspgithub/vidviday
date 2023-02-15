<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\GeneralException;
use App\Models\User;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Exception;
use Google_Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function verify(Request $request)
    {
        $g_csrf_token = $request->get('g_csrf_token');
        $credential = $request->get('credential');

        $client = new Google_Client(['client_id' => config('services.google.client_id')]);  // Specify the CLIENT_ID of the app that accesses the backend
        $payload = $client->verifyIdToken($credential);

        if ($payload) {
            $email = $payload['email'];
            $user = User::query()->where('email', $email)->first();

            if($user) {
                auth()->login($user);

                return redirect()->route(homeRoute());
            }
        } else {
            // Invalid ID token
            return redirect()->route('auth.login')->withFlashDanger(__('There was a problem connecting to :provider', ['provider' => $provider]));
        }

        return redirect()->route('auth.login')->withFlashDanger(__('There was a problem connecting to :provider', ['provider' => $provider]));
    }
}
