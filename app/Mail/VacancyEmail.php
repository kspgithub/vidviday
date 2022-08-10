<?php

namespace App\Mail;

use App\Models\UserQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class VacancyEmail extends BaseTemplateEmail
{
    use Queueable, SerializesModels;

    public UserQuestion $userQuestion;

    public static $subjectKey = 'emails.vacancy.subject';

    public static $viewKey = 'emails.vacancy';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserQuestion $userQuestion)
    {
        //
        $this->userQuestion = $userQuestion;
    }

    public function build()
    {
        return parent::build()->attach($this->userQuestion->attachment_url);
    }
}
