<?php

declare(strict_types=1);

namespace Core\DTO\Collection;

use Core\Common\DTO;

final class CollectionUpdateDTO extends DTO
{
    public int|string $id;
    public string $name;
    public ?string $description = null;
    public array $links;
}