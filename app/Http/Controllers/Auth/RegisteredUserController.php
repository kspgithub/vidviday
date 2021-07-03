<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @param string|null $role
     *
     * @return View
     */
    public function create() :View
    {
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
        $params = $request->validated();
        $params['password'] =  Hash::make($request->password);
        $role = $request->role;
        /**
         * @var User $user
         */
        $user = User::create($params);
        $role = Role::findByName($role);
        $user->assignRole($role);
        Auth::login($user);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME)->withFlashSuccess(__('A confirmation link has been sent to your email address.'));
    }
}
