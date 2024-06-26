<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Core\Repositories\LinkRepository;

class LinkDelete
{
    public function __construct(
        private LinkRepository $repository
    ) {}

    public function run(int $id): void
    {
        $this->repository->deleteLink($id);
    }
}