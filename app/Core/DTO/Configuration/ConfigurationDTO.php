<?php

declare(strict_types=1);

namespace Core\DTO\Configuration;

use Core\Common\DTO;

final class ConfigurationDTO extends DTO
{
    public string $key;
    public bool|string|int|null $value;
}