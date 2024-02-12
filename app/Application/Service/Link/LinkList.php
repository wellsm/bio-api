<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Application\Service\Profile\ProfileShow;
use Application\Service\User\UserByRequest;
use Core\DTO\Link\LinkListDTO;
use Core\Repositories\LinkRepository;
use Hyperf\Contract\LengthAwarePaginatorInterface;

class LinkList
{
    public function __construct(
        private ProfileShow $profile,
        private UserByRequest $user,
        private LinkRepository $repository
    ) {}

    public function run(LinkListDTO $dto): LengthAwarePaginatorInterface
    {
        $profile = $this->profile->run();

        return $this->repository->getLinkList($profile, $dto);
    }
}