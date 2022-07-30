<?php

namespace App\Observers;

use App\Models\UserSubscription;

class UserSubscriptionObserver
{
    /**
     * Handle the UserSubscription "created" event.
     *
     * @param  \App\Models\UserSubscription  $userSubscription
     * @return void
     */
    public function created(UserSubscription $userSubscription)
    {
        //
    }

    /**
     * Handle the UserSubscription "updated" event.
     *
     * @param  \App\Models\UserSubscription  $userSubscription
     * @return void
     */
    public function updated(UserSubscription $userSubscription)
    {
        //
    }

    /**
     * Handle the UserSubscription "deleted" event.
     *
     * @param  \App\Models\UserSubscription  $userSubscription
     * @return void
     */
    public function deleted(UserSubscription $userSubscription)
    {
        //
    }

    /**
     * Handle the UserSubscription "restored" event.
     *
     * @param  \App\Models\UserSubscription  $userSubscription
     * @return void
     */
    public function restored(UserSubscription $userSubscription)
    {
        //
    }

    /**
     * Handle the UserSubscription "force deleted" event.
     *
     * @param  \App\Models\UserSubscription  $userSubscription
     * @return void
     */
    public function forceDeleted(UserSubscription $userSubscription)
    {
        //
    }
}
