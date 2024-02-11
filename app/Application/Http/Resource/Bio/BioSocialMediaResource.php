<?php

declare(strict_types=1);

namespace Application\Http\Resource\Bio;

use Core\Entities\SocialMediaEntity;
use Hyperf\Resource\Json\JsonResource;

class BioSocialMediaResource extends JsonResource
{
    /** @var SocialMediaEntity */
    public mixed $resource;

    public ?string $wrap = null;

    public function toArray(): array
    {
        $icon = explode(' ', $this->resource->getIcon());
 
        return [
            'id' => $this->resource->getId(),
            'icon' => [
                'family' => $icon[0],
                'icon'   => $icon[1]
            ],
            'url'  => $this->resource->getUrl(),
        ];
    }
}
