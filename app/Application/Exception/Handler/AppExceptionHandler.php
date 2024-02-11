<?php

declare(strict_types=1);

namespace Application\Exception\Handler;

use Application\Constants\Env;
use Application\Http\Resource\StatusCode\ErrorResource;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    public function __construct(protected StdoutLoggerInterface $logger) {}

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        
        if (Env::isLocal() == false) {
            $this->logger->error($throwable->getTraceAsString());
        }

        return (new ErrorResource($throwable))->toResponse();
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
