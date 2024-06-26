<?php

declare(strict_types=1);

namespace Core\Entities;

use Core\Common\DateTimes;

interface SocialMediaEntity extends DateTimes
{
    public function getId(): int;

    public function getProfile(): ProfileEntity;

    public function setProfile(ProfileEntity $profile): self;

    public function getIcon(): string;

    public function setIcon(string $icon): self;

    public function getName(): string;

    public function setName(string $name): self;

    public function getUrl(): string;

    public function setUrl(string $url): self;

    public function getTextColor(): string;

    public function setTextColor(string $textColor): self;

    public function getBackground(): string;

    public function setBackground(string $background): self;

    public function getOrder(): int;

    public function setOrder(int $order): self;

    public function isActive(): bool;

    public function setActive(bool $active): self;

    public function toArray(): array;
}
