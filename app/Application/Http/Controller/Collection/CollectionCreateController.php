<?php

declare(strict_types=1);

namespace Application\Http\Controller\Collection;

use App\Application\Http\Request\Collection\CollectionCreateRequest;
use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\CreatedResource;
use Application\Service\Collection\CollectionCreate;
use Core\DTO\Collection\CollectionCreateDTO;

class CollectionCreateController extends AbstractController
{
    public function __invoke(CollectionCreateRequest $request, CollectionCreate $service)
    {
        $service->run(new CollectionCreateDTO($request->validated()));

        return new CreatedResource(null);
    }
}
