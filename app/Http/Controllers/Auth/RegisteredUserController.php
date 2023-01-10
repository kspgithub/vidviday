<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegistrationAdminEmail;
use App\Mail\RegistrationEmail;
use App\Models\Role;
use App\Models\SmsNotification;
use App\Models\Staff;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\MailNotificationService;
use App\Services\UserService;
use Daaner\TurboSMS\Facades\TurboSMS;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * DeactivatedUserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display the registration view.
     *
     * @param string|null $role
     *
     * @return View|RedirectResponse
     */
    public function create(Request $request): View
    {
        if ($request->get('force_logout') && $request->user()) {
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
        if ($role === 'tour-agent') {
            $params['status'] = 0;
        }
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

        Session::flash('newUser', $user);

        event(new Registered($user));

        try {
            Mail::to($user->email)->queue(new RegistrationEmail($user, $password));

            // Notify admins via email
            $adminEmails = MailNotificationService::getAdminNotifyEmails();
            foreach ($adminEmails as $email) {
                Mail::to($email)->queue(new RegistrationAdminEmail($user));
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        if ($user->isTourAgent()) {
            // Notify staff via sms
            $smsNotification = SmsNotification::query()->where('key', 'register-tour-agent')->first();

            if ($smsNotification) {

                $text = $smsNotification->text;
                $replaces = config('notifications.sms.register-tour-agent.replaces');

                foreach ($replaces as $replace => $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $text = Str::replace($replace, $target->{$attribute}, $text);
                }

                $staffs = Staff::query()->whereHas('types', function ($q) {
                    return $q->where('slug', 'travel-agencies');
                })->get();

                foreach ($staffs as $staff) {
                    if ($staff->phone) {
                        TurboSMS::sendMessages($staff->phone, $text);
                    }

                    if ($staff->viber) {
                        TurboSMS::sendMessages($staff->phone, $text, 'viber');
                    }
                }

                if (!$user->isVerified()) {
                    $user->sendEmailVerificationNotification();
                }
                if (!$user->isActive()) {
                    Auth::logout();
                }
            }
        }

        return redirect()->route('register.success');
    }

    public function success()
    {
        if (!$user = Session::get('newUser')) {
            return redirect(RouteServiceProvider::HOME);
        }

        return view('auth.success', ['user' => $user]);
    }
}
