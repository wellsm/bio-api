<?php

declare(strict_types=1);

namespace Application\Http\Controller\SocialMedia;

use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\SocialMedia\SocialMediaListResource;
use Application\Service\SocialMedia\SocialMediaList;

class SocialMediaListController extends AbstractController
{
    public function __invoke(SocialMediaList $service)
    {
        return (new SocialMediaListResource($service->run()))->toResponse();
    }
}
