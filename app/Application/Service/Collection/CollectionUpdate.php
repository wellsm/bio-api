<?php

declare(strict_types=1);

namespace Application\Service\Collection;

use Application\Service\Profile\ProfileShow;
use Core\DTO\Collection\CollectionUpdateDTO;
use Core\Repositories\CollectionRepository;

class CollectionUpdate
{
    public function __construct(
        private ProfileShow $profile,
        private CollectionRepository $repository,
    ) {
    }

    public function run(CollectionUpdateDTO $dto): void
    {
        $this->repository->updateCollection($this->profile->run(), $dto);
    }
}
