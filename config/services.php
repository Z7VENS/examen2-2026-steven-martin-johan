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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // Configuración para el servicio de OpenAI Realtime Sessions
    'openai' => [
        // Clave de API de OpenAI (debe definirse en el archivo .env)
        'key' => env('OPENAI_API_KEY'),
        // URL de la API de OpenAI para crear sesiones realtime
        'url' => env('OPENAI_URL', 'https://api.openai.com/v1/realtime/sessions'),
        // Modelo de lenguaje por defecto para las sesiones realtime
        'model' => env('OPENAI_MODEL', 'gpt-4o-realtime-preview-2025-06-10'),
        // Tiempo límite de espera en segundos para la conexión/respuesta
        'timeout' => env('OPENAI_TIMEOUT', 10),
    ],

];
