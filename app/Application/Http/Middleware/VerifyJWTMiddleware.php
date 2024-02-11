<?php

declare(strict_types=1);

namespace Application\Http\Middleware;

use App\Model\User;
use Application\Constants\App;
use Application\Exception\BusinessException;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Hyperf\Context\Context;
use Hyperf\Stringable\Str;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Teapot\StatusCode\Http;

use function Hyperf\Config\config;

class VerifyJWTMiddleware implements MiddlewareInterface
{
    private const HEADER = 'authorization';

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $query  = $request->getQueryParams();
        $bearer = $query[self::HEADER] ?? $request->getHeaderLine(self::HEADER);
        $bearer = trim(Str::after($bearer, 'Bearer'));

        if (empty($bearer)) {
            throw new BusinessException(Http::UNAUTHORIZED);
        }

        try {
            $jwt = JWT::decode($bearer, new Key(config('app_key'), 'HS256'));
        } catch (Exception) {
            throw new BusinessException(Http::FORBIDDEN);
        }

        $user = User::find($jwt->sub);

        Context::set(App::USER, $user);

        return $handler->handle($request);
    }
}
