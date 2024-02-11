<?php

declare(strict_types=1);

namespace Application\Http\Controller\Password;

use Application\Http\Request\PasswordForgotUserRequest;
use Application\Http\Resource\StatusCode\NoContentResource;
use Application\Service\User\UserForgotPassword;
use Core\DTO\User\UserForgotPasswordDTO;

class PasswordForgotController
{
    public function __invoke(PasswordForgotUserRequest $request, UserForgotPassword $service)
    {
        $request->validateResolved();
        $service->run(new UserForgotPasswordDTO($request->validated()));

        return new NoContentResource([]);
    }
}
