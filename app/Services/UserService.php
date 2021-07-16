<?php

namespace App\Services;

use App\Events\User\UserCreated;
use App\Events\User\UserDeleted;
use App\Events\User\UserDestroyed;
use App\Events\User\UserRestored;
use App\Events\User\UserStatusChanged;
use App\Events\User\UserUpdated;
use App\Models\User;
use App\Exceptions\GeneralException;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class UserService.
 */
class UserService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param $type
     * @param  bool|int  $perPage
     *
     * @return mixed
     */
    public function getByType($type, $perPage = false)
    {
        if (is_numeric($perPage)) {
            return $this->model::byType($type)->paginate($perPage);
        }

        return $this->model::byType($type)->get();
    }

    /**
     * @param  array  $data
     *
     * @throws GeneralException
     *
     * @return mixed
     */
    public function registerUser(array $data = []): User
    {
        DB::beginTransaction();

        try {
            $user = $this->createUser($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem creating your account.'));
        }

        DB::commit();

        return $user;
    }

    /**
     * @param $info
     * @param $provider
     *
     * @throws GeneralException
     *
     * @return mixed
     */
    public function registerProvider($info, $provider): User
    {
        $user = $this->model::where('provider_id', $info->id)->first();

        if (! $user) {
            DB::beginTransaction();

            try {
                $user = $this->createUser([
                    'name' => $info->name,
                    'email' => $info->email,
                    'provider' => $provider,
                    'provider_id' => $info->id,
                    'email_verified_at' => now(),
                ]);
            } catch (Exception $e) {
                DB::rollBack();

                throw new GeneralException(__('There was a problem connecting to :provider', ['provider' => $provider]));
            }

            DB::commit();
        }

        return $user;
    }

    /**
     * @param  array  $data
     *
     * @throws GeneralException
     * @throws Throwable
     *
     * @return User
     */
    public function store(array $data = []): User
    {
        DB::beginTransaction();

        try {
            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }

            $user = User::create($data);
            if (isset($data['email_verified']) && (int)$data['email_verified'] === 1) {
                $user->email_verified_at = Carbon::now();
                $user->save();
            }

            if (!empty($data['avatar_upload'])) {
                $user->uploadAvatar($data['avatar_upload']);
            }

            $user->syncRoles($data['role'] ?? []);

            if (! config('site-settings.user.only_roles')) {
                $user->syncPermissions($data['permissions'] ?? []);
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this user. Please try again.'));
        }

        event(new UserCreated($user));

        DB::commit();

        // They didn't want to auto verify the email, but do they want to send the confirmation email to do so?
        if (isset($data['send_confirmation_email']) && (int)$data['send_confirmation_email'] === 1) {
            $user->sendEmailVerificationNotification();
        }

        return $user;
    }

    /**
     * @param  User  $user
     * @param  array  $data
     *
     * @throws Throwable
     *
     * @return User
     */
    public function update(User $user, array $data = []): User
    {
        DB::beginTransaction();

        try {
            if (empty($data['avatar']) && !empty($user->avatar)) {
                $user->deleteAvatar();
            }

            $user->update($data);

            if (!empty($data['avatar_upload'])) {
                $user->uploadAvatar($data['avatar_upload']);
            }

            if (! $user->isMasterAdmin()) {
                // Replace selected roles/permissions
                if (empty($data['role'])) {
                    $user->syncRoles($data['role']);
                }

                if (! config('site-settings.user.only_roles')) {
                    $user->syncPermissions($data['permissions'] ?? []);
                }
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this user. Please try again.'));
        }

        event(new UserUpdated($user));

        DB::commit();

        return $user;
    }

    /**
     * @param  User  $user
     * @param  array  $data
     *
     * @return User
     */
    public function updateProfile(User $user, array $data = []): User
    {
        // $user->login = $data['login'] ?? null;

        if ($user->canChangeEmail() && $user->email !== $data['email']) {
            $user->email = $data['email'];
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
            session()->flash('resent', true);
        }

        return tap($user)->save();
    }

    /**
     * @param  User  $user
     * @param $data
     * @param  bool  $expired
     *
     * @throws Throwable
     *
     * @return User
     */
    public function updatePassword(User $user, $data, $expired = false): User
    {
        if (isset($data['current_password'])) {
            throw_if(
                ! Hash::check($data['current_password'], $user->password),
                new GeneralException(__('That is not your old password.'))
            );
        }

        // Reset the expiration clock
        if ($expired) {
            $user->password_changed_at = now();
        }

        $user->password = $data['password'];

        return tap($user)->update();
    }

    /**
     * @param  User  $user
     * @param $status
     *
     * @throws GeneralException
     *
     * @return User
     */
    public function mark(User $user, $status): User
    {
        if ($status === User::STATUS_INACTIVE && auth()->id() === $user->id) {
            throw new GeneralException(__('You can not do that to yourself.'));
        }

        if ($status === User::STATUS_INACTIVE && $user->isMasterAdmin()) {
            throw new GeneralException(__('You can not deactivate the administrator account.'));
        }

        $user->status = $status;

        if ($user->save()) {
            event(new UserStatusChanged($user, $status));

            return $user;
        }

        throw new GeneralException(__('There was a problem updating this user. Please try again.'));
    }

    /**
     * @param  User  $user
     *
     * @throws GeneralException
     *
     * @return User
     */
    public function delete(User $user): User
    {
        if ($user->id === auth()->id()) {
            throw new GeneralException(__('You can not delete yourself.'));
        }

        if ($this->deleteById($user->id)) {
            event(new UserDeleted($user));

            return $user;
        }

        throw new GeneralException('There was a problem deleting this user. Please try again.');
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     *
     * @return User
     */
    public function restore(User $user): User
    {
        if ($user->restore()) {
            event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException(__('There was a problem restoring this user. Please try again.'));
    }

    /**
     * @param  User  $user
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function destroy(User $user): bool
    {
        if ($user->forceDelete()) {
            event(new UserDestroyed($user));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this user. Please try again.'));
    }

    /**
     * @param  array  $data
     *
     * @return User
     */
    protected function createUser(array $data = []): User
    {
        return $this->model::create([
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'password' => $data['password'] ?? null,
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'middle_name' => $data['middle_name'] ?? null,
            'birthday' => $data['birthday'] ?? null,
            'email_verified_at' => $data['email_verified_at'] ?? null,
            'active' => $data['active'] ?? true,
        ]);
    }
}
