<?php

declare(strict_types=1);

namespace Core\Repositories;

use Core\DTO\SocialMedia\SocialMediaCreateDTO;
use Core\DTO\SocialMedia\SocialMediaUpdateDTO;
use Core\Entities\ProfileEntity;

interface SocialMediaRepository
{
    public function listSocialMedias(ProfileEntity $profile, bool $active);

    public function createSocialMedia(ProfileEntity $profile, SocialMediaCreateDTO $dto): void;

    public function updateSocialMedia(ProfileEntity $profile, SocialMediaUpdateDTO $dto): void;

    public function orderSocialMedias(ProfileEntity $profile, array $values): void;
}
