<?php

namespace App\Policies;

use App\Models\TourSchedule;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TourSchedulePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    public function view(User $user, TourSchedule $tourSchedule): bool
    {
        //
        return true;
    }

    public function create(User $user): bool
    {
        //
        return $user->isAdmin() || $user->isTourManager();
    }

    public function update(User $user, TourSchedule $tourSchedule): bool
    {
        //
        return $user->isAdmin() || $user->isTourManager();
    }

    public function delete(User $user, TourSchedule $tourSchedule): bool
    {
        //
        return $user->isAdmin() || $user->isTourManager();
    }

    public function restore(User $user, TourSchedule $tourSchedule): bool
    {
        //
        return $user->isAdmin() || $user->isTourManager();
    }

    public function forceDelete(User $user, TourSchedule $tourSchedule): bool
    {
        //
        return $user->isMasterAdmin();
    }
}
