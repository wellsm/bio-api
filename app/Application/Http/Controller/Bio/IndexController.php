<?php

declare(strict_types=1);

namespace Application\Http\Controller\Bio;

use Application\Http\Resource\Bio\BioResource;
use Application\Service\Bio\BioShow;
use Hyperf\HttpServer\Contract\RequestInterface;

class IndexController
{
    public function __invoke(RequestInterface $request, BioShow $service)
    {
        return new BioResource($service->run());
    }
}
