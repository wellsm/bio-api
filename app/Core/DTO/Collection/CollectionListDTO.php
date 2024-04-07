<?php

declare(strict_types=1);

namespace Core\DTO\Collection;

use Core\DTO\Common\ListDTO;

final class CollectionListDTO extends ListDTO
{
    public ?string $name = null;
}