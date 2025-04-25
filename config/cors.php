<?php

// En config/cors.php
return [
    'paths' => [
        'api/*',
        'api/v1/*',
        'api/v2/*',
        'sanctum/csrf-cookie',
        'registro',
        'registroStore',
        'auth/*',
        'storage/*'
    ],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 3600,
    'supports_credentials' => false,
];
