<?php

declare(strict_types=1);

namespace Application\Http\Middleware;

use Application\Service\Profile\ProfileShow;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VerifyProfileKeyMiddleware implements MiddlewareInterface
{
    private const HEADER = 'x-profile-key';

    public function __construct(
        private ProfileShow $shower
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $query   = $request->getQueryParams();
        $profile = $query[self::HEADER] ?? $request->getHeaderLine(self::HEADER) ?: null;
        $profile = $this->shower->run((int) $profile);

        return $handler->handle($request);
    }
}
