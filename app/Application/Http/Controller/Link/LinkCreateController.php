<?php

declare(strict_types=1);

namespace Application\Http\Controller\Link;

use App\Application\Http\Request\Link\LinkCreateRequest;
use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\CreatedResource;
use Application\Service\Link\LinkCreate;
use Core\DTO\Link\LinkCreateDTO;

class LinkCreateController extends AbstractController
{
    public function __invoke(LinkCreateRequest $request, LinkCreate $service)
    {
        $service->run(new LinkCreateDTO($request->validated()));

        return new CreatedResource(null);
    }
}
