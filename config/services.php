<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'tinymce' => [
        'key' => env('TINYMCE_KEY', ''),
    ],
    'google' => [
        'active' => env('GOOGLE_ACTIVE', false),
        'autologin' => env('GOOGLE_AUTOLOGIN', false),
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
        'maps_key' => env('GOOGLE_MAPS_KEY', ''),
    ],
    'facebook' => [
        'active' => env('FACEBOOK_ACTIVE', false),
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT'),
    ],
    'bitrix24' => [
        'domain' => env('BITRIX24_DOMAIN', ''),
        'token' => env('BITRIX24_TOKEN', ''),
        'contact-token' => env('BITRIX24_CONTACT_TOKEN', ''),
        'deal-token' => env('BITRIX24_DEAL_TOKEN', ''),
        'user' => env('BITRIX24_USER', ''),
        'log-enable' => env('BITRIX24_LOG_ENABLE', false),
        'test' => env('BITRIX24_TEST', true),
        'integration' => env('BITRIX24_INTEGRATION', false),
        'client_id' => env('BITRIX24_CLIENT_ID', ''),
        'client_secret' => env('BITRIX24_CLIENT_SECRET', ''),
        'client_webhook' => env('BITRIX24_CLIENT_WEBHOOK', ''),
        'client_block_log' => env('BITRIX24_CLIENT_BLOCK_LOG', false),
        'client_log_type_dump' => env('BITRIX24_CLIENT_LOG_TYPE_DUMP', false),
        'client_ignore_ssl' => env('BITRIX24_CLIENT_IGNORE_SSL', true),
    ],
    'wayforpay' => [
        'login' => env('WFP_LOGIN', ''),
        'secret' => env('WFP_SECRET', ''),
        'test' => env('WFP_TEST', true),
        'domain' => env('WFP_DOMAIN', 'https://dev.vidviday.org.ua'),
    ],
    'turbosms' => [
        'wsdlEndpoint' => env('TURBOSMS_WSDLENDPOINT', 'http://turbosms.in.ua/api/wsdl.html'),
        'login' => env('TURBOSMS_LOGIN'),
        'password' => env('TURBOSMS_PASSWORD'),
        'sender' => env('TURBOSMS_SENDER'),
        'debug' => env('TURBOSMS_DEBUG', false), //will log sending attempts and results
        'sandboxMode' => env('TURBOSMS_SANDBOX_MODE', false) //will not invoke API call
    ],
];
