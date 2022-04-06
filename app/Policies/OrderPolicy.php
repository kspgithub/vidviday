<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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

    public function view(User $user, Order $order): bool
    {
        //
        return true;
    }

    public function create(User $user): bool
    {
        //
        return true;
    }

    public function update(User $user, Order $order): bool
    {
        //
        return $user->isAdmin() || $user->isTourManager() || $user->isDutyManager();
    }

    public function delete(User $user, Order $order): bool
    {
        //
        return $user->isAdmin() || $user->isTourManager() || $user->isDutyManager();
    }

    public function restore(User $user, Order $order): bool
    {
        //
        return $user->isAdmin() || $user->isTourManager() || $user->isDutyManager();
    }

    public function forceDelete(User $user, Order $order): bool
    {
        //
        return $user->isAdmin();
    }

    public function adminComments(User $user, Order $order)
    {
        return $user->isAdmin() || $user->isManagerOfOrder($order);
    }

    public function dutyComments(User $user, Order $order)
    {
        return $user->isAdmin() || $user->isDutyManager();
    }
}
