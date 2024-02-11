<?php

declare(strict_types=1);

namespace Application\Http\Controller\User;

use Application\Http\Request\User\UserCreateRequest;
use Application\Http\Resource\StatusCode\CreatedResource;
use Application\Service\User\UserCreate;
use Core\DTO\User\UserCreateDTO;

class UserCreateController
{
    public function __invoke(UserCreateRequest $request, UserCreate $service)
    {
        $service->run(new UserCreateDTO($request->validated()));

        return new CreatedResource([]);
    }
}
