<?php

declare(strict_types=1);

namespace Application\Service\PasswordToken;

use Core\Entities\PasswordTokenEntity;
use Core\Entities\UserEntity;
use Core\Repositories\PasswordTokenRepository;

class VerifyUser
{
    public function __construct(
        private PasswordTokenRepository $repository
    ) {}

    public function run(UserEntity $user): ?PasswordTokenEntity
    {
        return $this->repository->verifyUser($user);
    }
}
