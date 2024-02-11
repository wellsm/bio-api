<?php

declare(strict_types=1);

namespace Core\DTO\SocialMedia;

use Core\Common\DTO;
use Core\Helper\SocialMedia;

final class SocialMediaOrderDTO extends DTO
{
    public string $url;
    public string $icon;
    public int|string $order;

    public function getName(): ?string
    {
        return SocialMedia::getName($this->icon);
    }
}