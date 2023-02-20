<?php

namespace App\Services\Auth\Drivers;

use App\Services\Auth\SocialAuth;
use Google\Client;

class GoogleAuth extends SocialAuth
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['client_id' => config('services.google.client_id')]);
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
