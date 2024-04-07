<?php

declare(strict_types=1);

namespace Application\Http\Resource\Collection;

use Application\Http\Resource\Link\LinkCollectionResource;
use Core\Entities\CollectionEntity;
use Core\Entities\LinkEntity;
use Hyperf\Resource\Json\ResourceCollection;

class CollectionListResource extends ResourceCollection
{
    public function toArray(): array
    {
        return [
            'data' => $this->collection
                ->map(fn (CollectionEntity $collection) => [
                    'id'          => $collection->getId(),
                    'hash'        => $collection->getHash(),
                    'name'        => $collection->getName(),
                    'description' => $collection->getDescription(),
                    'links'       => $collection->getLinks()
                        ->map(fn (LinkEntity $link) => new LinkCollectionResource($link)),
                ]),
        ];
    }
}
