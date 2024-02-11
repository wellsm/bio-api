<?php

declare(strict_types=1);

namespace Application\Http\Controller\Link;

use App\Application\Http\Request\Link\LinkUpdateRequest;
use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\NoContentResource;
use Application\Service\Link\LinkUpdate;
use Core\DTO\Link\LinkUpdateDTO;

class LinkUpdateController extends AbstractController
{
    public function __invoke(LinkUpdateRequest $request, LinkUpdate $service)
    {
        $service->run(new LinkUpdateDTO($request->validated()));

        return new NoContentResource(null);
    }
}
