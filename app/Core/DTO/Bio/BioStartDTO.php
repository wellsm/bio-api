<?php

declare(strict_types=1);

namespace Core\DTO\Bio;

use Core\Common\DTO;
use Core\ValueObject\EmailValueObject;
use Core\ValueObject\PasswordValueObject;

final class BioStartDTO extends DTO
{
    public string $email;
    public string $password;
    public string $name;
    public string $username;

    public function getEmail(): EmailValueObject
    {
        return new EmailValueObject($this->email);
    }

    public function getPassword(): PasswordValueObject
    {
        return new PasswordValueObject($this->password);
    }
}