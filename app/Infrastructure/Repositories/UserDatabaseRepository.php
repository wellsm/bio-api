<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use App\Model\User;
use Core\DTO\User\UserCreateDTO;
use Core\DTO\User\UserSetPasswordDTO;
use Core\Entities\UserEntity;
use Core\Repositories\UserRepository;
use Core\ValueObject\EmailValueObject;

class UserDatabaseRepository implements UserRepository
{
    public function getUserByEmail(EmailValueObject $email): ?UserEntity
    {
        return User::where('email', (string) $email)->first();
    }

    public function createUser(UserCreateDTO $dto): UserEntity
    {
        return User::create([
            'name'  => $dto->name,
            'email' => $dto->getEmail(),
        ]);
    }

    public function setPasswordUser(UserSetPasswordDTO $dto, int $id): UserEntity
    {
        $user = User::findOrFail($id);
        $user->fill(['password' => $dto->getPassword()]);
        $user->save();

        return $user;
    }
}
