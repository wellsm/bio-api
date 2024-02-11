<?php

declare(strict_types=1);

namespace Application\Http\Controller\SocialMedia;

use App\Application\Http\Request\SocialMedia\SocialMediaUpdateRequest;
use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\NoContentResource;
use Application\Service\SocialMedia\SocialMediaUpdate;
use Core\DTO\SocialMedia\SocialMediaUpdateDTO;

class SocialMediaUpdateController extends AbstractController
{
    public function __invoke(SocialMediaUpdateRequest $request, SocialMediaUpdate $service)
    {
        $service->run(new SocialMediaUpdateDTO($request->validated()));

        return new NoContentResource(null);
    }
}
