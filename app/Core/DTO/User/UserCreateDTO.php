<?php

declare(strict_types=1);

namespace Core\DTO\User;

use Core\Common\DTO;
use Core\ValueObject\EmailValueObject;

final class UserCreateDTO extends DTO
{
    public string $name;
    public string $email;

    public function getEmail(): EmailValueObject
    {
        return new EmailValueObject($this->email);
    }
}