<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Application\Service\Profile\ProfileShow;
use Core\Repositories\LinkRepository;
use Hyperf\Collection\Collection;

class LinkCollectionList
{
    public function __construct(
        private ProfileShow $profile,
        private LinkRepository $repository
    ) {}

    public function run(): Collection
    {
        return $this->repository->getLinkCollectionList($this->profile->run());
    }
}