<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Core\Entities\ProfileEntity;
use Core\Repositories\LinkRepository;
use Hyperf\Collection\Collection;

class LinkBioList
{
    public function __construct(
        private LinkRepository $repository
    ) {}

    public function run(ProfileEntity $profile): Collection
    {
        return $this->repository->getLinksByProfile($profile);
    }
}