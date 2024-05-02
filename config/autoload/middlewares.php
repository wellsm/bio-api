<?php

declare(strict_types=1);

use Gokure\HyperfCors\CorsMiddleware;

return [
    'http' => [
        CorsMiddleware::class,
    ],
];
