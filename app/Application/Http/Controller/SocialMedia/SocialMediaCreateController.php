<?php

declare(strict_types=1);

namespace Application\Http\Controller\SocialMedia;

use App\Application\Http\Request\SocialMedia\SocialMediaCreateRequest;
use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\CreatedResource;
use Application\Service\SocialMedia\SocialMediaCreate;
use Core\DTO\SocialMedia\SocialMediaCreateDTO;

class SocialMediaCreateController extends AbstractController
{
    public function __invoke(SocialMediaCreateRequest $request, SocialMediaCreate $service)
    {
        $service->run(new SocialMediaCreateDTO($request->validated()));

        return new CreatedResource(null);
    }
}
