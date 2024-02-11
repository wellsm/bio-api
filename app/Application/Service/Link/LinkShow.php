<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Core\Entities\LinkEntity;
use Core\Repositories\LinkRepository;

class LinkShow
{
    private const PROFILE = 1;

    public function __construct(
        private LinkRepository $repository
    ) {}

    public function run(int $id = self::PROFILE): LinkEntity
    {
        return $this->repository->getLinkById($id);
    }
}