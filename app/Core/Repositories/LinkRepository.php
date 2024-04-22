<?php

declare(strict_types=1);

namespace Core\Repositories;

use Application\DTO\File\UploadDTO;
use Core\DTO\Link\LinkCreateDTO;
use Core\DTO\Link\LinkListDTO;
use Core\DTO\Link\LinkUpdateDTO;
use Core\Entities\LinkEntity;
use Core\Entities\ProfileEntity;

interface LinkRepository
{
    public function getLinkList(ProfileEntity $profile, LinkListDTO $dto);

    public function getLinkCollectionList(ProfileEntity $profile);

    public function getLinksByProfile(ProfileEntity $profile);

    public function createLink(ProfileEntity $profile, LinkCreateDTO $dto, ?UploadDTO $upload, ?string $shortUrl = null): void;

    public function getLinkById(int $id): LinkEntity;

    public function updateLink(LinkUpdateDTO $dto): void;

    public function toggleLink(int $id): void;

    public function toggleFixedLink(int $id): void;

    public function deleteLink(int $id): void;
}
