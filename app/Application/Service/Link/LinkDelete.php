<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Core\Repositories\LinkRepository;

class LinkDelete
{
    private const PROFILE = 1;

    public function __construct(
        private LinkRepository $repository
    ) {}

    public function run(int $id = self::PROFILE): void
    {
        $this->repository->deleteLink($id);
    }
}