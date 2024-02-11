<?php

declare(strict_types=1);

namespace Core\DTO\Common;

use Core\Common\DTO;
use Core\Helper\Util;

abstract class ListDTO extends DTO
{
    public string|int $page = 1;
    public string|int $perPage = Util::PER_PAGE;

    public function getPage(): int
    {
        return (int) ($this->page ?? 1);
    }

    public function getPerPage(): int
    {
        return (int) ($this->perPage ?? Util::PER_PAGE);
    }
}