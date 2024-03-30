<?php

declare (strict_types=1);

namespace Application\Service\Importer\Common;

use Core\DTO\SocialMedia\SocialMediaCreateDTO;
use Countable;
use Hyperf\Contract\Arrayable;

class SocialMediaCollection implements Countable, Arrayable
{
    /** @var SocialMediaCreateDTO[] $links */
    private array $links = [];

    public function addLink(SocialMediaCreateDTO $link)
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