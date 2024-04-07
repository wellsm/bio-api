<?php

declare(strict_types=1);

namespace Application\Http\Resource\Collection;

use Core\Entities\LinkEntity;
use Hyperf\Resource\Json\ResourceCollection;

class CollectionLinkListResource extends ResourceCollection
{
    /** @var Collection */
    public mixed $resource;

    public ?string $wrap = null;

    public function toArray(): array
    {
        return $this->resource->map(function (LinkEntity $link) {
            return [
                'id'        => $link->getId(),
                'title'     => $link->getTitle(),
                'thumbnail' => $link->getThumbnail(),
            ];
        })->toArray();
    }
}
