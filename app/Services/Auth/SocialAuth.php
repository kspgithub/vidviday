<?php

namespace App\Services\Auth;

use App\Services\Auth\Drivers\GoogleAuth;

abstract class SocialAuth implements SocialAuthenticator
{
    protected $client;

    public static function for(string $provider): static
    {
        $driver = match ($provider) {
            'google' => GoogleAuth::class,
        };

        return app()->make($driver);
    }

    /**
     * @param string $credential
     * @return array('email' => string)
     */
    public function verify(string $credential): array
    {
        try {
            $payload = $this->client->verifyIdToken($credential);

            return $payload;
        } catch (\Exception $e) {
            //
        }
    }
}
