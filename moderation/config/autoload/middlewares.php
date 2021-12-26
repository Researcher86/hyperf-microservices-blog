<?php

declare(strict_types=1);

use Moderation\Middleware\CorsMiddleware;

return [
    'http' => [
        CorsMiddleware::class
    ],
];
