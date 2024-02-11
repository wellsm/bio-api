<?php

declare(strict_types=1);

namespace Core\Entities;

use Core\Common\DateTimes;
use Core\Common\SoftDeletable;

interface LinkEntity extends DateTimes, SoftDeletable
{
    public function getId(): int;

    public function getProfile(): ProfileEntity;

    public function getCategory(): ?CategoryEntity;

    public function getTitle(): string;

    public function setTitle(string $title): self;

    public function getUrl(): string;

    public function setUrl(string $url): self;

    public function getFilename(): string;

    public function getThumbnail(): string;

    public function setThumbnail(string $thumbnail): self;

    public function isActive(): bool;

    public function setActive(bool $active): self;

    public function toArray(): array;
}
