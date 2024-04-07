<?php

declare(strict_types=1);

namespace Application\Http\Controller\Collection;

use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\Collection\CollectionLinkListResource;
use Application\Service\Link\LinkCollectionList;

class CollectionLinkListController extends AbstractController
{
    public function __invoke(LinkCollectionList $service)
    {
        return (new CollectionLinkListResource($service->run()))->toResponse();
    }
}
