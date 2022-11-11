<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\EditUserPasswordRequest;
use App\Http\Requests\Admin\User\UpdateUserPasswordRequest;
use App\Models\User;
use App\Services\UserService;
use Throwable;

/**
 * Class UserPasswordController.
 */
class UserPasswordController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserPasswordController constructor.
     *
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  EditUserPasswordRequest  $request
     * @param  User  $user
     * @return mixed
     */
    public function edit(EditUserPasswordRequest $request, User $user)
    {
        return view('admin.user.change-password', ['user' => $user]);
    }

    /**
     * @param  UpdateUserPasswordRequest  $request
     * @param  User  $user
     * @return mixed
     *
     * @throws Throwable
     */
    public function update(UpdateUserPasswordRequest $request, User $user)
    {
        $this->userService->updatePassword($user, $request->validated());

        return redirect()->route('admin.user.show', $user)
            ->withFlashSuccess(__('The user\'s password was successfully updated.'));
    }
}
