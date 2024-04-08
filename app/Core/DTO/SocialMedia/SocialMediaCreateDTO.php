<?php

declare(strict_types=1);

namespace Core\DTO\SocialMedia;

use Core\Common\DTO;
use Core\Helper\SocialMedia;

final class SocialMediaCreateDTO extends DTO
{
    public string $url;
    public string $icon;
    public string $textColor;
    public string $background;

    public function getName(): ?string
    {
        return SocialMedia::getName($this->icon);
    }
}