<?php

declare(strict_types=1);

namespace Application\Http\Resource\Bio;

use Core\Entities\LinkEntity;
use Core\Entities\SocialMediaEntity;
use Hyperf\Resource\Json\JsonResource;

class BioResource extends JsonResource
{
    public ?string $wrap = null;

    public function toArray(): array
    {
        return [
            'profile' => [
                'name'   => $this->resource['profile']->getName(),
                'avatar' => $this->resource['profile']->getAvatar()
            ],
            'medias'  => $this->resource['medias']
                ->map(fn (SocialMediaEntity $media) => new BioSocialMediaResource($media)),
            'configs' => $this->resource['configs'],
            'links'   => $this->resource['links']
                ->map(fn (LinkEntity $media) => new BioLinkResource($media)),
        ];
    }
}
