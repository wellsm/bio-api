<?php

declare(strict_types=1);

namespace Application\Responses;

use Core\Entities\ProfileEntity;
use Core\Entities\UserEntity;

class BioStartResponse
{
    public function __construct(
        private UserEntity $user,
        private ?string $token = null,
        private ?ProfileEntity $profile = null,
    ) {}

    public function getUser(): UserEntity
    {
        return $this->user;
    }

    public function getProfile(): ProfileEntity
    {
        return $this->profile;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}