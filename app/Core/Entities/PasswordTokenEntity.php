<?php

declare(strict_types=1);

namespace Core\Entities;

use DateTime;

interface PasswordTokenEntity
{
    public function getUser(): UserEntity;

    public function getToken(): string;

    public function setToken(string $token): self;

    public function getExpiresAt(): DateTime;

    public function setExpiresAt(DateTime $expiresAt): self;
}
