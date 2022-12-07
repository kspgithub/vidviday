<?php

namespace App\Observers;

use App\Mail\TestimonialAdminEmail;
use App\Mail\TestimonialAnswerEmail;
use App\Mail\UserQuestionAdminEmail;
use App\Mail\UserQuestionEmail;
use App\Mail\UserQuestionManagerEmail;
use App\Mail\VacancyEmail;
use App\Models\Testimonial;
use App\Models\UserQuestion;
use App\Services\MailNotificationService;
use Exception;
use Illuminate\Support\Facades\Mail;

class TestimonialObserver
{
    /**
     * Handle the UserQuestion "created" event.
     *
     * @param  \App\Models\Testimonial $testimonial
     * @return void
     */
    public function created(Testimonial $testimonial)
    {
        // Notify admins
        $adminEmails = MailNotificationService::getAdminNotifyEmails();

        try {
            if($testimonial->parent) {
                Mail::to($testimonial->parent->email)->queue(new TestimonialAnswerEmail($testimonial));
            } else {
                foreach ($adminEmails as $email) {
                    Mail::to($email)->queue(new TestimonialAdminEmail($testimonial));
                }
            }

        } catch (Exception $e) {
            //
        }
    }

    /**
     * Handle the UserQuestion "updated" event.
     *
     * @param  \App\Models\Testimonial $testimonial
     * @return void
     */
    public function updated(Testimonial $testimonial)
    {
        //
    }

    /**
     * Handle the UserQuestion "deleted" event.
     *
     * @param  \App\Models\Testimonial $testimonial
     * @return void
     */
    public function deleted(Testimonial $testimonial)
    {
        //
    }

    /**
     * Handle the UserQuestion "restored" event.
     *
     * @param  \App\Models\Testimonial $testimonial
     * @return void
     */
    public function restored(Testimonial $testimonial)
    {
        //
    }

    /**
     * Handle the UserQuestion "force deleted" event.
     *
     * @param  \App\Models\Testimonial $testimonial
     * @return void
     */
    public function forceDeleted(Testimonial $testimonial)
    {
        //
    }
}
