<?php

namespace App\Observers;

use App\Mail\UserQuestionAdminEmail;
use App\Mail\UserQuestionEmail;
use App\Mail\UserQuestionManagerEmail;
use App\Models\UserQuestion;
use App\Services\MailNotificationService;
use Exception;
use Illuminate\Support\Facades\Mail;

class UserQuestionObserver
{
    /**
     * Handle the UserQuestion "created" event.
     *
     * @param \App\Models\UserQuestion  $userQuestion
     *
     * @return void
     */
    public function created(UserQuestion $userQuestion)
    {
        // Notify admins
        $adminEmails = MailNotificationService::getAdminNotifyEmails();

        // Notify managers related to question
        $managerEmails = (array) $userQuestion->questionType?->email ?? [];

        // Notify managers related to question
        $userEmails = (array) $userQuestion->email;

        try {
            foreach ($adminEmails as $email) {
                Mail::to($email)->queue(new UserQuestionAdminEmail($userQuestion));
            }
            foreach ($managerEmails as $email) {
                Mail::to($email)->queue(new UserQuestionManagerEmail($userQuestion));
            }
            foreach ($userEmails as $email) {
                Mail::to($email)->queue(new UserQuestionEmail($userQuestion));
            }
        } catch (Exception $e) {
            //
        }
    }

    /**
     * Handle the UserQuestion "updated" event.
     *
     * @param \App\Models\UserQuestion  $userQuestion
     *
     * @return void
     */
    public function updated(UserQuestion $userQuestion)
    {
        //
    }

    /**
     * Handle the UserQuestion "deleted" event.
     *
     * @param \App\Models\UserQuestion  $userQuestion
     *
     * @return void
     */
    public function deleted(UserQuestion $userQuestion)
    {
        //
    }

    /**
     * Handle the UserQuestion "restored" event.
     *
     * @param \App\Models\UserQuestion  $userQuestion
     *
     * @return void
     */
    public function restored(UserQuestion $userQuestion)
    {
        //
    }

    /**
     * Handle the UserQuestion "force deleted" event.
     *
     * @param \App\Models\UserQuestion  $userQuestion
     *
     * @return void
     */
    public function forceDeleted(UserQuestion $userQuestion)
    {
        //
    }
}
