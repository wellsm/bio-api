<?php

declare(strict_types=1);

namespace Core\Entities;

use Core\Common\DateTimes;

interface CategoryEntity extends DateTimes
{
    public function getId(): int;

    public function getProfile(): ProfileEntity;

    public function getName(): string;

    public function setName(string $name): self;

    public function toArray(): array;
}
