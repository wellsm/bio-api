<?php

declare(strict_types=1);

namespace Application\Http\Controller\Collection;

use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\Collection\CollectionListResource;
use Application\Service\Collection\CollectionList;
use Core\DTO\Collection\CollectionListDTO;
use Hyperf\HttpServer\Contract\RequestInterface;

class CollectionListController extends AbstractController
{
    public function __invoke(RequestInterface $request, CollectionList $service)
    {
        $data = $request->getQueryParams();

        return (new CollectionListResource(
            $service->run(new CollectionListDTO($data))
        ))->toResponse();
    }
}
