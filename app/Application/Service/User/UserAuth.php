<?php

declare(strict_types=1);

namespace Application\Service\User;

use Application\Exception\BusinessException;
use Core\DTO\User\UserAuthDTO;
use Core\Repositories\UserRepository;
use Firebase\JWT\JWT;
use Teapot\StatusCode\Http;

use function Hyperf\Config\config;
use function Hyperf\Translation\__;

class UserAuth
{
    public function __construct(
        private UserRepository $repository
    ) {}

    public function run(UserAuthDTO $dto): string
    {
        $user = $this->repository->getUserByEmail($dto->getEmail());

        if (empty($user?->getPassword())) {
            throw new BusinessException(Http::NOT_FOUND, __('messages.auth.failed'));
        }

        $pass = $user->getPassword()->check($dto->getPassword());

        if ($pass === false) {
            throw new BusinessException(Http::NOT_FOUND, __('messages.auth.failed'));
        }

        // TODO - Service
        return JWT::encode([
            'iss'  => (string) $user->getEmail(),
            'name' => $user->getName(),
            'sub'  => $user->getId(),
            'iat'  => time(),
        ], config('app_key'), 'HS256');
    }
}