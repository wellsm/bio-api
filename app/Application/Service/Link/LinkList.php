<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Application\Service\User\UserByRequest;
use Core\DTO\Link\LinkListDTO;
use Core\Repositories\LinkRepository;
use Hyperf\Contract\LengthAwarePaginatorInterface;

class LinkList
{
    public function __construct(
        private UserByRequest $user,
        private LinkRepository $repository
    ) {}

    public function run(LinkListDTO $dto): LengthAwarePaginatorInterface
    {
        return $this->repository->getLinkList(new LinkListDTO(array_merge($dto->values(), [
            'user' => $this->user->run()->getId()
        ])));
    }
}