<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use App\Model\Profile;
use Application\DTO\File\UploadDTO;
use Core\DTO\Profile\ProfileCreateDTO;
use Core\Entities\ProfileEntity;
use Core\Entities\UserEntity;
use Core\Repositories\ProfileRepository;

class ProfileDatabaseRepository implements ProfileRepository
{
    public function getProfileById(int $id): ?ProfileEntity
    {
        return Profile::find($id);
    }

    public function getFirstProfile(): ?ProfileEntity
    {
        return Profile::query()->first();
    }

    public function createProfile(UserEntity $user, ProfileCreateDTO $dto, ?UploadDTO $upload): ProfileEntity
    {
        $profile = new Profile();

        $profile->setUserId($user->getId());
        $profile->setName($dto->name);
        $profile->setUsername($dto->username);
        $profile->setAvatar($upload?->filename);

        $profile->save();

        return $profile;
    }
}
