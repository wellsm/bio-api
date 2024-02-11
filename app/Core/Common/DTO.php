<?php

declare(strict_types=1);

namespace Core\Common;

use Core\Helper\Str;
use InvalidArgumentException;
use JsonSerializable;

abstract class DTO implements JsonSerializable
{
    private const PROPERTY_DOESNT_EXISTS = "The property '%s' doesn't exists in '%s' DTO Class";
    private const PROPERTY_READONLY      = "The property '%s' is read-only";
    private array $values                = [];

    public function __construct(array $values)
    {
        foreach ($values as $key => $value) {
            $key = Str::camel($key);

            if (! property_exists($this, $key)) {
                continue;
            }

            $this->{$key}       = $value;
            $this->values[$key] = $this->get($key);
        }
    }

    public function __get(string $name)
    {
        return $this->get($name);
    }

    public function __set(string $name, mixed $value)
    {
        throw new InvalidArgumentException(sprintf(self::PROPERTY_READONLY, $name));
    }

    public function __isset($name): bool
    {
        return property_exists($this, $name);
    }

    public function values(): array
    {
        return $this->values;
    }

    public function get(string $property): mixed
    {
        $getter = 'get' . ucfirst($property);

        if (method_exists($this, $getter)) {
            return $this->{$getter}();
        }

        if (! property_exists($this, $property)) {
            throw new InvalidArgumentException(sprintf(self::PROPERTY_DOESNT_EXISTS, $property, __CLASS__));
        }

        return $this->{$property};
    }

    public function jsonSerialize(): mixed
    {
        return $this->values();
    }

    protected function boolValue(string $property): ?bool
    {
        return $this->get($property) ?? null;
    }
}
