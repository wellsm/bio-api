<?php

declare(strict_types=1);

namespace Core\DTO\ShortUrl;

use Core\Common\DTO;

final class ShortUrlCreateDTO extends DTO
{
    public string $title;
    public string $url;
}