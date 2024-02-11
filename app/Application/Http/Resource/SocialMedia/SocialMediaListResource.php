<?php

declare(strict_types=1);

namespace Application\Http\Resource\SocialMedia;

use Core\Entities\SocialMediaEntity;
use Hyperf\Collection\Collection;
use Hyperf\Resource\Json\JsonResource;

class SocialMediaListResource extends JsonResource
{
    /** @var Collection */
    public mixed $resource;

    public ?string $wrap = null;

    public function toArray(): array
    {
        return $this->resource->map(function (SocialMediaEntity $media) {
            $icon = explode(' ', $media->getIcon());

            return [
                'id'     => $media->getId(),
                'url'    => $media->getUrl(),
                'order'  => $media->getOrder(),
                'active' => $media->isActive(),
                'icon'   => [
                    'family' => $icon[0],
                    'icon'   => $icon[1]
                ],
            ];
        })->toArray();
    }
}
