<?php

namespace App\Http\Controllers\Admin\User;

use App\Exceptions\GeneralException;
use App\Http\Requests\Admin\User\DeleteUserRequest;
use App\Http\Requests\Admin\User\EditUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var RoleService
     */
    protected $roleService;

    /**
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     * @param RoleService $roleService
     * @param PermissionService $permissionService
     */
    public function __construct(UserService $userService, RoleService $roleService, PermissionService $permissionService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * @return View
     */
    public function index(Request $request)
    {
        return view('admin.user.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $user = new User();

        return view('admin.user.create')
            ->withUser($user)
            ->withRoles($this->roleService->get())
            ->withPermissions($this->permissionService->get());
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return mixed
     * @throws Throwable
     *
     * @throws GeneralException
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->validated());

        return redirect()->route('admin.user.show', $user)->withFlashSuccess(__('The user was successfully created.'));
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function show(User $user)
    {
        return view('admin.user.show')
            ->withUser($user);
    }

    /**
     * @param EditUserRequest $request
     * @param User $user
     *
     * @return mixed
     */
    public function edit(EditUserRequest $request, User $user)
    {
        return view('admin.user.edit')
            ->withUser($user)
            ->withRoles($this->roleService->get())
            ->withPermissions($this->permissionService->get())
            ->withUsedPermissions($user->permissions->modelKeys());
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     *
     * @return mixed
     * @throws Throwable
     *
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update($user, $request->validated());

        return redirect()->route('admin.user.show', $user)->withFlashSuccess(__('The user was successfully updated.'));
    }

    /**
     * @param DeleteUserRequest $request
     * @param User $user
     *
     * @return mixed
     * @throws GeneralException
     *
     */
    public function destroy(DeleteUserRequest $request, User $user)
    {
        $this->userService->delete($user);

        return redirect()->route('admin.user.index')->withFlashSuccess(__('The user was successfully deleted.'));
    }

    public function restore(Request $request, int $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $this->userService->restore($user);

        return redirect()->route('admin.user.index')->withFlashSuccess(__('The user was successfully restored.'));
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     * @throws GeneralException
     *
     */
    public function forceDelete(Request $request, int $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        if ($user->isMasterAdmin()) {
            throw new AuthorizationException(__('You can not delete the master administrator.'));
        }
        $this->userService->destroy($user);

        return redirect()->route('admin.user.index')->withFlashSuccess(__('The user was successfully deleted.'));
    }
}
