<?php

declare(strict_types=1);

namespace Core\DTO\User;

use Core\Common\DTO;
use Core\ValueObject\PasswordValueObject;

final class UserSetPasswordDTO extends DTO
{
    public string $token;
    public string $password;

    public function getPassword(): PasswordValueObject
    {
        return new PasswordValueObject($this->password);
    }
}