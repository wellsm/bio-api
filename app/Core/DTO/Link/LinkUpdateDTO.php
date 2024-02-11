<?php

declare(strict_types=1);

namespace Core\DTO\Link;

use Core\Common\DTO;
use Core\Entities\ProfileEntity;
use SplFileInfo;

final class LinkUpdateDTO extends DTO
{
    public int|string $id;
    public ?ProfileEntity $profile;
    public string $title;
    public string $url;
    public string|SplFileInfo $thumbnail;
}