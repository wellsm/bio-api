<?php

declare(strict_types=1);

namespace Core\Common;

use DateTime;

interface SoftDeletable
{
    public function getDeletedAt(): DateTime;

    public function delete();
}
