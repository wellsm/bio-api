<?php

declare(strict_types=1);

namespace Application\Http\Controller\Bio;

use Application\Http\Resource\Bio\BioCollectionResource;
use Application\Service\Bio\BioCollectionShow;
use Hyperf\HttpServer\Contract\RequestInterface;

class CollectionController
{
    public function __invoke(RequestInterface $request, BioCollectionShow $service)
    {
        return new BioCollectionResource($service->run($request->route('collection')));
    }
}
