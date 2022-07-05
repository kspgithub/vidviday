<?php

namespace App\Mail;

use App\Models\UserQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VacancyEmail extends Mailable
{
    use Queueable, SerializesModels;


    public UserQuestion $userQuestion;

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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.vacancy')
            ->attach($this->userQuestion->attachment_url);
    }
}