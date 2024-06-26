<?php

declare(strict_types=1);

namespace Application\Http\Resource\Link;

use Core\Entities\LinkEntity;
use Hyperf\Resource\Json\ResourceCollection;

class LinkListResource extends ResourceCollection
{
    public function toArray(): array
    {
        return [
            'data' => $this->collection
                ->map(fn (LinkEntity $link) => $link->toArray()),
        ];
    }
}
