<?php

namespace App\Observers;

use App\Models\AgencySubscription;

class AgencySubscriptionObserver
{
    /**
     * Handle the AgencySubscription "created" event.
     *
     * @param  \App\Models\AgencySubscription  $agencySubscription
     * @return void
     */
    public function created(AgencySubscription $agencySubscription)
    {
        //
    }

    /**
     * Handle the AgencySubscription "updated" event.
     *
     * @param  \App\Models\AgencySubscription  $agencySubscription
     * @return void
     */
    public function updated(AgencySubscription $agencySubscription)
    {
        //
    }

    /**
     * Handle the AgencySubscription "deleted" event.
     *
     * @param  \App\Models\AgencySubscription  $agencySubscription
     * @return void
     */
    public function deleted(AgencySubscription $agencySubscription)
    {
        //
    }

    /**
     * Handle the AgencySubscription "restored" event.
     *
     * @param  \App\Models\AgencySubscription  $agencySubscription
     * @return void
     */
    public function restored(AgencySubscription $agencySubscription)
    {
        //
    }

    /**
     * Handle the AgencySubscription "force deleted" event.
     *
     * @param  \App\Models\AgencySubscription  $agencySubscription
     * @return void
     */
    public function forceDeleted(AgencySubscription $agencySubscription)
    {
        //
    }
}
