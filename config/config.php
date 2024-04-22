<?php

declare(strict_types=1);
use Hyperf\Contract\StdoutLoggerInterface;
use Psr\Log\LogLevel;

use function Hyperf\Support\env;

return [
    'app_name'                   => env('APP_NAME'),
    'app_key'                    => env('APP_KEY'),
    'app_env'                    => env('APP_ENV'),
    'scan_cacheable'             => env('SCAN_CACHEABLE', false),
    StdoutLoggerInterface::class => [
        'log_level' => [
            LogLevel::ALERT,
            LogLevel::CRITICAL,
            LogLevel::EMERGENCY,
            LogLevel::ERROR,
            LogLevel::INFO,
            LogLevel::NOTICE,
            LogLevel::WARNING,
        ],
    ],
    'short_url' => [
        'base_uri' => env('SHLINK_BASE_URI', false),
        'enabled'  => env('SHLINK_ENABLED', false),
        'api_key'  => env('SHLINK_API_KEY', false),
    ],
];
