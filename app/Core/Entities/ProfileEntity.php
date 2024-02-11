<?php

declare(strict_types=1);

namespace Core\Entities;

use Core\Common\DateTimes;

interface ProfileEntity extends DateTimes
{
    public function getId(): int;

    public function getUser(): UserEntity;

    public function getName(): string;

    public function setName(string $name): self;

    public function getUsername(): string;

    public function setUsername(string $username): self;

    public function getAvatar(): string;

    public function setAvatar(string $avatar): self;

    public function toArray(): array;
}
