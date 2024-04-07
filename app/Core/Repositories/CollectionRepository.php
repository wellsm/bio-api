<?php

declare(strict_types=1);

namespace Core\Repositories;

use Core\DTO\Collection\CollectionCreateDTO;
use Core\DTO\Collection\CollectionListDTO;
use Core\DTO\Collection\CollectionUpdateDTO;
use Core\Entities\CollectionEntity;
use Core\Entities\ProfileEntity;

interface CollectionRepository
{
    public function getCollectionList(ProfileEntity $profile, CollectionListDTO $dto);

    public function showCollection(string $hash): CollectionEntity;

    public function createCollection(ProfileEntity $profile, CollectionCreateDTO $dto): void;

    public function updateCollection(ProfileEntity $profile, CollectionUpdateDTO $dto): void;

    public function deleteCollection(int $id): void;
}
