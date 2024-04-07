<?php

declare(strict_types=1);

namespace Core\Entities;

use Core\Common\DateTimes;
use Core\Common\SoftDeletable;

interface CollectionEntity extends DateTimes, SoftDeletable
{
    public function getId(): int;

    public function getProfile(): ProfileEntity;

    public function setProfile(ProfileEntity $profile): self;

    public function getLinks();

    public function getHash(): string;

    public function addHash(): self;

    public function getName(): string;

    public function setName(string $name): self;

    public function getDescription(): ?string;

    public function setDescription(?string $description = null): self;

    public function toArray(): array;
}
