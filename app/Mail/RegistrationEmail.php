<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\User;

class RegistrationEmail extends BaseTemplateEmail
{
    public User $user;

    public string $password;

    public Contact $contacts;

    public static $subjectKey = 'emails.registration.subject';

    public static $viewKey = 'emails.registration';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user = null, string $password = '')
    {
        $this->user = $user ?: User::random();
        $this->password = $password;
        $this->contacts = Contact::first();
    }

    public function getReplaces(): array
    {
        return [
            'user_id' => $this->user->id,
        ];
    }
}
