<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegistrationAdminEmail;
use App\Mail\RegistrationEmail;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @param string|null $role
     *
     * @return View|RedirectResponse
     */
    public function create(Request $request): View
    {
        if($request->get('force_logout') && $request->user()) {
            $redirect = route('auth.register', $request->except('force_logout'));
            $request->merge(['redirect' => $redirect]);
            $authController = app(AuthenticatedSessionController::class);
            return $authController->destroy($request->merge(['redirect' => $redirect]));
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param RegisterRequest $request
     * @param string $role
     *
     * @return RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        $password = $request->password;
        $params = $request->validated();
        $params['password'] = Hash::make($request->password);
        $role = $request->role;
        /**
         * @var User $user
         */
        $user = User::create($params);
        $role = Role::findByName($role);
        $user->assignRole($role);
        if ($user->isTourist()) {
            $user->syncContact();
        }
        Auth::login($user);

        event(new Registered($user));
        try {
            Mail::to($user->email)->send(new RegistrationEmail($user, $password));
            if ($user->isTourAgent()) {
                Mail::send(new RegistrationAdminEmail($user));
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return redirect()->route('auth.register.success');
    }

    public function success()
    {
        return view('auth.success');
    }
}
