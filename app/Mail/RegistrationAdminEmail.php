<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class RegistrationAdminEmail extends BaseTemplateEmail
{
    public User $user;

    public static $subjectKey = 'emails.registration-admin.subject';

    public static $viewKey = 'emails.registration-admin';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user = null)
    {
        $this->user = $user ?: new User();
    }
}
