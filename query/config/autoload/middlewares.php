<?php

declare(strict_types=1);

use Query\Middleware\CorsMiddleware;

return [
    'http' => [
        CorsMiddleware::class
    ],
];
