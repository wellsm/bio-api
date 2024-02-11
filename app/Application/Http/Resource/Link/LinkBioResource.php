<?php

declare(strict_types=1);

namespace Application\Http\Resource\Link;

use Core\Entities\LinkEntity;
use Hyperf\Resource\Json\JsonResource;

class LinkBioResource extends JsonResource
{
    /** @var LinkEntity */
    public mixed $resource;

    public function toArray(): array
    {
        return [
            'title'     => $this->resource->getTitle(),
            'url'       => $this->resource->getUrl(),
            'thumbnail' => $this->resource->getThumbnail(),
        ];
    }
}
