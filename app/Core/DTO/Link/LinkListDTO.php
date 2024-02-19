<?php

declare(strict_types=1);

namespace Core\DTO\Link;

use Core\DTO\Common\ListDTO;

final class LinkListDTO extends ListDTO
{
    public int $user;
    public ?string $title = null;
    public ?string $url = null;
    public bool|string|null $active = null;
    public bool|string|null $fixed = null;

    public function isActive(): ?bool
    {
        return (int) $this->active === 1;
    }

    public function isFixed(): ?bool
    {
        return (int) $this->fixed === 1;
    }
}