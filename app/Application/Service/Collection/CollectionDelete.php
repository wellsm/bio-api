<?php

declare(strict_types=1);

namespace Application\Service\Collection;

use Application\Service\Profile\ProfileShow;
use Core\Repositories\CollectionRepository;

class CollectionDelete
{
    public function __construct(
        private ProfileShow $profile,
        private CollectionRepository $repository,
    ) {
    }

    public function run(int $id): void
    {
        $this->repository->deleteCollection($id);
    }
}
