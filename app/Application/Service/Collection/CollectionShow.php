<?php

declare(strict_types=1);

namespace Application\Service\Collection;

use Core\Entities\CollectionEntity;
use Core\Repositories\CollectionRepository;

class CollectionShow
{
    public function __construct(
        private CollectionRepository $repository
    ) {}

    public function run(string $hash): CollectionEntity
    {
        return $this->repository->showCollection($hash);
    }
}