<?php

declare(strict_types=1);
use Hyperf\Framework\Bootstrap\PipeMessageCallback;
use Hyperf\Framework\Bootstrap\WorkerExitCallback;
use Hyperf\Framework\Bootstrap\WorkerStartCallback;
use Hyperf\Server\Event;
use Hyperf\Server\Server;
use Swoole\Constant;

use function Hyperf\Support\env;

return [
    'mode'      => SWOOLE_PROCESS,
    'servers'   => [
        [
            'name'      => 'http',
            'type'      => Server::SERVER_HTTP,
            'host'      => '0.0.0.0',
            'port'      => (int) env('PORT', 9501),
            'sock_type' => SWOOLE_SOCK_TCP,
            'callbacks' => [
                Event::ON_REQUEST => [\Hyperf\HttpServer\Server::class, 'onRequest'],
            ],
            'options'   => [
                // Whether to enable request lifecycle event
                'enable_request_lifecycle' => false,
            ],
        ],
    ],
    'settings'  => [
        Constant::OPTION_ENABLE_COROUTINE      => true,
        Constant::OPTION_WORKER_NUM            => min(swoole_cpu_num(), 12),
        Constant::OPTION_PID_FILE              => BASE_PATH . '/runtime/hyperf.pid',
        Constant::OPTION_OPEN_TCP_NODELAY      => true,
        Constant::OPTION_MAX_COROUTINE         => 100000,
        Constant::OPTION_OPEN_HTTP2_PROTOCOL   => true,
        Constant::OPTION_MAX_REQUEST           => 100000,
        Constant::OPTION_SOCKET_BUFFER_SIZE    => 2 * 1024 * 1024,
        Constant::OPTION_BUFFER_OUTPUT_SIZE    => 2 * 1024 * 1024,
        Constant::OPTION_DOCUMENT_ROOT         => BASE_PATH . '/public',
        Constant::OPTION_ENABLE_STATIC_HANDLER => true,
    ],
    'callbacks' => [
        Event::ON_WORKER_START => [WorkerStartCallback::class, 'onWorkerStart'],
        Event::ON_PIPE_MESSAGE => [PipeMessageCallback::class, 'onPipeMessage'],
        Event::ON_WORKER_EXIT  => [WorkerExitCallback::class, 'onWorkerExit'],
    ],
];
