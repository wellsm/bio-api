<?php

declare(strict_types=1);

namespace Application\Http\Controller\Link;

use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\NoContentResource;
use Application\Service\Link\LinkDelete;
use Hyperf\HttpServer\Request;

class LinkDeleteController extends AbstractController
{
    public function __invoke(Request $request, LinkDelete $service)
    {
        $service->run((int) $request->route('link'));

        return new NoContentResource(0);
    }
}
