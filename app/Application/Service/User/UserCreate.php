<?php

declare(strict_types=1);

namespace Application\Service\User;

use Application\Service\Mail\DTO\UserSetPasswordMailDTO;
use Application\Service\Mail\Notification\SendUserCreatedMail;
use Application\Service\PasswordToken\GenerateToken;
use Core\DTO\User\UserCreateDTO;
use Core\Entities\UserEntity;
use Core\Repositories\UserRepository;
use Hyperf\DbConnection\Db;

class UserCreate
{
    public function __construct(
        private UserRepository $repository,
        private GenerateToken $generator,
        private SendUserCreatedMail $mailer,
        private Db $db,
    ) {}

    public function run(UserCreateDTO $dto): UserEntity
    {
        return $this->db->transaction(function () use ($dto) {
            $user = $this->repository->getUserByEmail($dto->getEmail())
                ?? $this->repository->createUser($dto);

            if ($user->wasRecentlyCreated === false) {
                return $user;
            }

            $token = $this->generator->run($user);
    
            $this->mailer->send(new UserSetPasswordMailDTO([
                'name'  => $user->getName(),
                'email' => (string) $user->getEmail(),
                'token' => $token
            ]));

            return $user;
        });
    }
}