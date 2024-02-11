<?php

declare(strict_types=1);

namespace Core\Repositories;

use Core\DTO\User\UserCreateDTO;
use Core\DTO\User\UserSetPasswordDTO;
use Core\Entities\UserEntity;
use Core\ValueObject\EmailValueObject;

interface UserRepository
{
    public function getUserByEmail(EmailValueObject $email): ?UserEntity;

    public function createUser(UserCreateDTO $dto): UserEntity;

    public function setPasswordUser(UserSetPasswordDTO $dto, int $id): UserEntity;
}
