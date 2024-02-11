<?php

declare(strict_types=1);

namespace Core\DTO\User;

use Core\Common\DTO;
use Core\ValueObject\EmailValueObject;

final class UserCreateDTO extends DTO
{
    public string $name;
    public string $email;
    public string $token;

    public function getEmail(): EmailValueObject
    {
        return new EmailValueObject($this->email);
    }

    public function getToken(): string
    {
        return bin2hex(random_bytes(64));
    }
}