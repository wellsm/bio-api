<?php

declare(strict_types=1);

namespace Application\Http\Controller\SocialMedia;

use App\Application\Http\Request\SocialMedia\SocialMediaOrderRequest;
use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\NoContentResource;
use Application\Service\SocialMedia\SocialMediaOrdering;

class SocialMediaOrderingController extends AbstractController
{
    public function __invoke(SocialMediaOrderRequest $request, SocialMediaOrdering $service)
    {
        $service->run($request->validated());

        return new NoContentResource(0);
    }
}
