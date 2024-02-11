<?php

declare(strict_types=1);

namespace Application\Service\User;

use Application\Service\PasswordToken\VerifyToken;
use Core\DTO\User\UserSetPasswordDTO;
use Core\Entities\UserEntity;
use Core\Repositories\UserRepository;

class UserSetPassword
{
    public function __construct(
        private UserRepository $repository,
        private VerifyToken $verify,
    ) {}

    public function run(UserSetPasswordDTO $dto): UserEntity
    {
        $password = $this->verify->run($dto->token);
        $user     = $password->getUser();
        $user     = $this->repository->setPasswordUser($dto, $user->getId());

        // TODO - Expire Token

        return $user;
    }
}