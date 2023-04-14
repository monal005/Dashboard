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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '97593695701-oussubcs5o6k8nqa299152leeqcr34bu.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/authorized/google/callback',
     ],
     'facebook' => [
        'client_id' => '592059576314629',
        'client_secret' => '9522330e930b94754ebff722d2cbf285',
        'redirect' => 'http://localhost:8000/authorized/facebook/callback',
     ],

];
