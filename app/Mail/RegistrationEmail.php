<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class RegistrationEmail extends BaseTemplateEmail
{
    use Queueable, SerializesModels;

    public $user;

    public $password;

    public $contacts;

    public $showFooter = true;

    public static $subjectKey = 'emails.registration.subject';

    public static $viewKey = 'emails.registration';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $password)
    {
        //
        $this->user = $user;
        $this->password = $password;
        $this->contacts = Contact::first();
    }
}
