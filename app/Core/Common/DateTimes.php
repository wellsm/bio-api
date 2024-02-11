<?php

declare(strict_types=1);

namespace Core\Common;

use DateTime;

interface DateTimes
{
    public function getCreatedAt(): DateTime;

    public function getUpdatedAt(): DateTime;
}
