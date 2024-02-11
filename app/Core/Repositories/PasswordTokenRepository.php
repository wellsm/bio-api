<?php

declare(strict_types=1);

namespace Core\Repositories;

use Core\Entities\PasswordTokenEntity;
use Core\Entities\UserEntity;

interface PasswordTokenRepository
{
    public function generateToken(UserEntity $user): PasswordTokenEntity;

    public function verifyToken(string $token): ?PasswordTokenEntity;

    public function verifyUser(UserEntity $user): ?PasswordTokenEntity;
}
