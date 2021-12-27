<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageSubject;

    public $messageText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageText, $messageSubject)
    {
        //
        $this->messageSubject = $messageSubject;
        $this->messageText = $messageText;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.custom')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($this->messageSubject);
    }
}
