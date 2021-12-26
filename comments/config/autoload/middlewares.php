<?php

declare(strict_types=1);

use Comments\Middleware\CorsMiddleware;

return [
    'http' => [
        CorsMiddleware::class
    ],
];
