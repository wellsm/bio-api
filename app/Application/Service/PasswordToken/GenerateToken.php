<?php

declare(strict_types=1);

namespace Application\Service\PasswordToken;

use Core\Entities\UserEntity;
use Core\Repositories\PasswordTokenRepository;

class GenerateToken
{
    public function __construct(
        private PasswordTokenRepository $repository,
        private VerifyUser $verify
    ) {}

    public function run(UserEntity $user): string
    {
        $password = $this->verify->run($user)
            ?? $this->repository->generateToken($user);

        return $password->getToken();
    }
}
