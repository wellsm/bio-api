<?php

declare(strict_types=1);

namespace Core\Common;

use DateTime;

interface CreatedAt
{
    public function getCreatedAt(): DateTime;
}
