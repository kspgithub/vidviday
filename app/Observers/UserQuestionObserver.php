<?php

namespace App\Observers;

use App\Mail\VacancyEmail;
use App\Models\UserQuestion;
use App\Services\MailNotificationService;
use Exception;
use Illuminate\Support\Facades\Mail;

class UserQuestionObserver
{
    /**
     * Handle the UserQuestion "created" event.
     *
     * @param  \App\Models\UserQuestion  $userQuestion
     * @return void
     */
    public function created(UserQuestion $userQuestion)
    {
        //
        $emails = MailNotificationService::getAdminNotifyEmails();

        try {
            foreach ($emails as $email) {
                Mail::to($email)->send(new VacancyEmail($userQuestion));
            }
        } catch (Exception $e) {
            //
        }
    }

    /**
     * Handle the UserQuestion "updated" event.
     *
     * @param  \App\Models\UserQuestion  $userQuestion
     * @return void
     */
    public function updated(UserQuestion $userQuestion)
    {
        //
    }

    /**
     * Handle the UserQuestion "deleted" event.
     *
     * @param  \App\Models\UserQuestion  $userQuestion
     * @return void
     */
    public function deleted(UserQuestion $userQuestion)
    {
        //
    }

    /**
     * Handle the UserQuestion "restored" event.
     *
     * @param  \App\Models\UserQuestion  $userQuestion
     * @return void
     */
    public function restored(UserQuestion $userQuestion)
    {
        //
    }

    /**
     * Handle the UserQuestion "force deleted" event.
     *
     * @param  \App\Models\UserQuestion  $userQuestion
     * @return void
     */
    public function forceDeleted(UserQuestion $userQuestion)
    {
        //
    }
}
