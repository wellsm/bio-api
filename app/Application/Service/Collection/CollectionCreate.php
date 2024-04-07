<?php

declare(strict_types=1);

namespace Application\Service\Collection;

use Application\Service\Profile\ProfileShow;
use Core\DTO\Collection\CollectionCreateDTO;
use Core\Repositories\CollectionRepository;

class CollectionCreate
{
    public function __construct(
        private ProfileShow $profile,
        private CollectionRepository $repository,
    ) {
    }

    public function run(CollectionCreateDTO $dto): void
    {
        $this->repository->createCollection($this->profile->run(), $dto);
    }
}
