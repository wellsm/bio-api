<?php

declare(strict_types=1);

namespace Application\Http\Controller\Password;

use Application\Http\Request\Password\PasswordSetRequest;
use Application\Http\Resource\StatusCode\NoContentResource;
use Application\Service\User\UserSetPassword;
use Core\DTO\User\UserSetPasswordDTO;

class PasswordSetController
{
    public function __invoke(PasswordSetRequest $request, UserSetPassword $service)
    {
        $service->run(new UserSetPasswordDTO($request->validated()));

        return new NoContentResource([]);
    }
}
