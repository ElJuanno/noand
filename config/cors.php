<?php
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],             // o pon aquí tu IP si quieres acotar
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];
