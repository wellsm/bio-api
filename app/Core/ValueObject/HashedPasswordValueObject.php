<?php

declare(strict_types=1);

namespace Core\ValueObject;

use DomainException;

class HashedPasswordValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        $info = password_get_info($value);

        if (! isset($info['algo']) || $info['algoName'] == 'unknown') {
            throw new DomainException('Not an hashed password.');
        }

        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    public static function hash(PasswordValueObject $password): self
    {
        return new self(password_hash((string) $password, PASSWORD_BCRYPT));
    }

    public function isEqualTo(self $hashed): bool
    {
        return $this->value == $hashed->value;
    }

    public function check(PasswordValueObject $password): bool
    {
        return password_verify((string) $password, $this->value);
    }
}
