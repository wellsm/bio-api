<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use App\Model\Profile;
use Core\Entities\ProfileEntity;
use Core\Repositories\ProfileRepository;

class ProfileDatabaseRepository implements ProfileRepository
{
    public function getProfileById(int $id): ProfileEntity
    {
        return Profile::findOrFail($id);
    }
}
