<?php

declare(strict_types=1);

namespace Core\Entities;

use Core\Common\DateTimes;

interface ConfigurationEntity extends DateTimes
{
    public function getId(): int;

    public function getProfile(): ProfileEntity;

    public function getKey(): string;

    public function setKey(string $key): self;

    public function getValue(): string;

    public function setValue(string $value): self;

    public function toArray(): array;
}
