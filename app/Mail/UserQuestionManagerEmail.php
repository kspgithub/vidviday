<?php

namespace App\Mail;

use App\Models\UserQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class UserQuestionManagerEmail extends BaseTemplateEmail
{
    public UserQuestion $userQuestion;

    public static $subjectKey = 'emails.user-question.subject';

    public static $viewKey = 'emails.user-question';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserQuestion $userQuestion = null)
    {
        $this->userQuestion = $userQuestion ?: UserQuestion::random();
    }
}
