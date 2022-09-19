<?php

namespace App\Mail;

use App\Models\UserQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class VacancyEmail extends BaseTemplateEmail
{
    public UserQuestion $userQuestion;

    public static $subjectKey = 'emails.vacancy.subject';

    public static $viewKey = 'emails.vacancy';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserQuestion $userQuestion = null)
    {
        $this->userQuestion = $userQuestion ?: new UserQuestion();
    }

    public function build()
    {
        $build = parent::build();

        if($this->userQuestion->attachment_url) {
            $build->attach($this->userQuestion->attachment_url);
        }

        return $build;
    }
}
