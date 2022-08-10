<?php

namespace App\Mail;

use App\Models\UserQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class UserQuestionManagerEmail extends BaseTemplateEmail
{
    use Queueable, SerializesModels;


    public UserQuestion $userQuestion;

    public static $subjectKey = 'emails.user_question.subject';

    public static $viewKey = 'emails.user_question';

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
}
