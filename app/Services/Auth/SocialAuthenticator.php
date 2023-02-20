<?php

namespace App\Services\Auth;

interface SocialAuthenticator
{
    public function verify(string $credential): array;
}
