<?php

declare(strict_types=1);

namespace Core\ValueObject;

use DomainException;

class PasswordValueObject
{
    private string $value;

    public function __construct(string $password)
    {
        if (
            strlen($password) < 6
            || strlen($password) > 20
        ) {
            throw new DomainException('Invalid password.');
        }

        $this->value = $password;
    }

    public function __toString()
    {
        return $this->value;
    }

    public function hashed(): HashedPasswordValueObject
    {
        return HashedPasswordValueObject::hash($this);
    }
}
