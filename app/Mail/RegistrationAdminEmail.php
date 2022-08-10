<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class RegistrationAdminEmail extends BaseTemplateEmail
{
    use Queueable, SerializesModels;

    public $user;

    public static $subjectKey = 'emails.registration.subject';

    public static $viewKey = 'emails.registration-admin';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }
}
