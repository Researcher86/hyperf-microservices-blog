<?php

declare(strict_types=1);

use Posts\Middleware\CorsMiddleware;

return [
    'http' => [
        CorsMiddleware::class
    ],
];
