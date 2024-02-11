<?php

declare(strict_types=1);
use Gokure\HyperfCors\CorsMiddleware;
use Hyperf\Session\Middleware\SessionMiddleware;

/*
 * This file is part of Hyperf.
 *
 * @see     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'http' => [
        SessionMiddleware::class,
        CorsMiddleware::class,
    ],
];
