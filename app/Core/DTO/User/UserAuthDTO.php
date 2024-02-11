<?php

declare(strict_types=1);

namespace Core\DTO\User;

use Core\Common\DTO;
use Core\ValueObject\EmailValueObject;
use Core\ValueObject\PasswordValueObject;

final class UserAuthDTO extends DTO
{
    public string $email;
    public string $password;

    public function getEmail(): EmailValueObject
    {
        return new EmailValueObject($this->email);
    }

    public function getPassword(): PasswordValueObject
    {
        return new PasswordValueObject($this->password);
    }
}