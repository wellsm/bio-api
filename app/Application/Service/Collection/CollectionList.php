<?php

declare(strict_types=1);

namespace Application\Service\Collection;

use Application\Service\Profile\ProfileShow;
use Core\DTO\Collection\CollectionListDTO;
use Core\Repositories\CollectionRepository;
use Hyperf\Contract\LengthAwarePaginatorInterface;

class CollectionList
{
    public function __construct(
        private ProfileShow $profile,
        private CollectionRepository $repository
    ) {}

    public function run(CollectionListDTO $dto): LengthAwarePaginatorInterface
    {
        $profile = $this->profile->run();

        return $this->repository->getCollectionList($profile, $dto);
    }
}