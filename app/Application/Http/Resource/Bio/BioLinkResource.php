<?php

declare(strict_types=1);

namespace Application\Http\Resource\Bio;

use Core\Entities\LinkEntity;
use Hyperf\Resource\Json\JsonResource;

class BioLinkResource extends JsonResource
{
    /** @var LinkEntity */
    public mixed $resource;

    public ?string $wrap = null;

    public function toArray(): array
    {
        return [
            'id'        => $this->resource->getId(),
            'title'     => $this->resource->getTitle(),
            'url'       => $this->resource->getUrl(),
            'thumbnail' => $this->resource->getThumbnail(),
        ];
    }
}
