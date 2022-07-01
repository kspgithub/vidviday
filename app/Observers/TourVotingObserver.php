<?php

namespace App\Observers;

use App\Models\TourVoting;

class TourVotingObserver
{
    /**
     * Handle the TourVoting "created" event.
     *
     * @param  \App\Models\TourVoting  $tourVoting
     * @return void
     */
    public function created(TourVoting $tourVoting)
    {
        //
    }

    /**
     * Handle the TourVoting "updated" event.
     *
     * @param  \App\Models\TourVoting  $tourVoting
     * @return void
     */
    public function updated(TourVoting $tourVoting)
    {
        //
    }

    /**
     * Handle the TourVoting "deleted" event.
     *
     * @param  \App\Models\TourVoting  $tourVoting
     * @return void
     */
    public function deleted(TourVoting $tourVoting)
    {
        //
    }

    /**
     * Handle the TourVoting "restored" event.
     *
     * @param  \App\Models\TourVoting  $tourVoting
     * @return void
     */
    public function restored(TourVoting $tourVoting)
    {
        //
    }

    /**
     * Handle the TourVoting "force deleted" event.
     *
     * @param  \App\Models\TourVoting  $tourVoting
     * @return void
     */
    public function forceDeleted(TourVoting $tourVoting)
    {
        //
    }
}
