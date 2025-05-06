<?php

return [
    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses'      => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend'   => [
        'key' => env('RESEND_KEY'),
    ],

    'slack'    => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel'              => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'openai'   => [
        'key' => env('OPENAI_API_KEY'),
    ],

    'pinecone' => [
        'key'         => env('PINECONE_API_KEY'),
        'environment' => env('PINECONE_ENVIRONMENT'),
        'index_name'  => env('PINECONE_INDEX_NAME'),
        'base_url'    => env('PINECONE_BASE_URL'),
    ],
];
