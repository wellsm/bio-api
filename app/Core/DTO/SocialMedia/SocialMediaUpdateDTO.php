<?php

declare(strict_types=1);

namespace Core\DTO\SocialMedia;

use Core\Common\DTO;
use Core\Helper\SocialMedia;

final class SocialMediaUpdateDTO extends DTO
{
    public int|string $id;
    public string $url;
    public string $icon;
    public int|string $active;
    public string $textColor;
    public string $background;

    public function getName(): ?string
    {
        return SocialMedia::getName($this->icon);
    }
}