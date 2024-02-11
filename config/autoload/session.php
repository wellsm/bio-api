<?php

declare(strict_types=1);
use Hyperf\Session\Handler\RedisHandler;

return [
    'handler' => RedisHandler::class,
    'options' => [
        'connection'       => 'default',
        'path'             => BASE_PATH . '/runtime/session',
        'gc_maxlifetime'   => 1200,
        'session_name'     => 'HYPERF_SESSION_ID',
        'domain'           => null,
        'cookie_lifetime'  => 5 * 60 * 60,
        'cookie_same_site' => 'lax',
    ],
];
