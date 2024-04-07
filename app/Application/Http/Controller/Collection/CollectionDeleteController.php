<?php

declare(strict_types=1);

namespace Application\Http\Controller\Collection;

use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\NoContentResource;
use Application\Service\Collection\CollectionDelete;
use Hyperf\HttpServer\Request;

class CollectionDeleteController extends AbstractController
{
    public function __invoke(Request $request, CollectionDelete $service)
    {
        $service->run((int) $request->route('collection'));

        return new NoContentResource(0);
    }
}
