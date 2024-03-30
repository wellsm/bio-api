<?php

declare(strict_types=1);

namespace Application\Http\Controller\Profile;

use App\Application\Http\Request\Profile\ProfileCreateRequest;
use Application\Http\Controller\Common\AbstractController;
use Application\Http\Resource\StatusCode\CreatedResource;
use Application\Service\Profile\ProfileCreate;
use Core\DTO\Profile\ProfileCreateDTO;

class ProfileCreateController extends AbstractController
{
    public function __invoke(ProfileCreateRequest $request, ProfileCreate $service)
    {
        $service->run(dto: new ProfileCreateDTO($request->validated()));

        return new CreatedResource(null);
    }
}
