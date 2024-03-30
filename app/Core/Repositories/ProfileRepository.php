<?php

declare(strict_types=1);

namespace Core\Repositories;

use Application\DTO\File\UploadDTO;
use Core\DTO\Profile\ProfileCreateDTO;
use Core\Entities\ProfileEntity;
use Core\Entities\UserEntity;

interface ProfileRepository
{
    public function getProfileById(int $id): ?ProfileEntity;

    public function getFirstProfile(): ?ProfileEntity;

    public function createProfile(UserEntity $user, ProfileCreateDTO $dto, ?UploadDTO $upload): ProfileEntity;
}
