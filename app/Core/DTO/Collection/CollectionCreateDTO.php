<?php

declare(strict_types=1);

namespace Core\DTO\Collection;

use Core\Common\DTO;

final class CollectionCreateDTO extends DTO
{
    public string $name;
    public ?string $description = null;
    public array $links;
}