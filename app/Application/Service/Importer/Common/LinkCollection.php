<?php

declare (strict_types=1);

namespace Application\Service\Importer\Common;

use Core\DTO\Link\LinkCreateDTO;
use Countable;
use Hyperf\Contract\Arrayable;

class LinkCollection implements Countable, Arrayable
{
    /** @var LinkCreateDTO[] $links */
    private array $links = [];

    public function addLink(LinkCreateDTO $link)
    {
        $this->links[] = $link;
    }

    public function toArray(): array
    {
        return $this->links;
    }

    public function count(): int
    {
        return count($this->links);
    }
}