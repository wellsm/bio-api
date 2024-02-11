<?php

declare(strict_types=1);

namespace Application\Http\Middleware;

use Application\Constants\App;
use Hyperf\Contract\SessionInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VerifySessionMiddleware implements MiddlewareInterface
{
    #[Inject()]
    private SessionInterface $session;

    #[Inject()]
    private ResponseInterface $response;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): Psr7ResponseInterface
    {
        $loggedIn = (int) $this->session->get(App::LOGGED_IN, 0);

        if ($loggedIn === 0) {
            return $this->response->redirect('/login');
        }

        return $handler->handle($request);
    }
}
