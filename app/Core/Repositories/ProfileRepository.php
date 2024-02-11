<?php

declare(strict_types=1);

namespace Core\Repositories;

use Core\Entities\ProfileEntity;

interface ProfileRepository
{
    public function getProfileById(int $id): ProfileEntity;
}
