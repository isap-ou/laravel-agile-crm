<?php

return [
    'default' => env('AGILE_CRM_DEFAULT_DOMAIN', 'default'),

    'domains' => [
        'default' => [
            'domain' => env('AGILE_CRM_DOMAIN'),
            'email' => env('AGILE_CRM_EMAIL'),
            'api_key' => env('AGILE_CRM_API_KEY'),
        ],
    ],
];
