<?php

declare(strict_types=1);

namespace Application\Service\PasswordToken;

use Core\Entities\PasswordTokenEntity;
use Core\Repositories\PasswordTokenRepository;

class VerifyToken
{
    public function __construct(
        private PasswordTokenRepository $repository
    ) {}

    public function run(string $token): ?PasswordTokenEntity
    {
        return $this->repository->verifyToken($token);
    }
}
