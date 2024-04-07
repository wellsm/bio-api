<?php

declare(strict_types=1);

namespace Application\Http\Controller\Collection;

use App\Application\Http\Request\Collection\CollectionUpdateRequest;
use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\NoContentResource;
use Application\Service\Collection\CollectionUpdate;
use Core\DTO\Collection\CollectionUpdateDTO;

class CollectionUpdateController extends AbstractController
{
    public function __invoke(CollectionUpdateRequest $request, CollectionUpdate $service)
    {
        $service->run(new CollectionUpdateDTO($request->validated()));

        return new NoContentResource(null);
    }
}
