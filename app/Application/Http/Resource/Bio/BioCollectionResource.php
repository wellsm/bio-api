<?php

declare(strict_types=1);

namespace Application\Http\Resource\Bio;

use Application\Service\Configuration\Config;
use Core\Entities\LinkEntity;
use Core\Entities\SocialMediaEntity;
use Hyperf\Resource\Json\JsonResource;

class BioCollectionResource extends JsonResource
{
    public ?string $wrap = null;

    public function toArray(): array
    {
        return [
            'profile' => [
                'name'   => $this->resource['profile']->getName(),
                'avatar' => $this->resource['profile']->getAvatar()
            ],
            'medias' => $this->resource['medias']->map(
                fn (SocialMediaEntity $media) => new BioSocialMediaResource($media)
            ),
            'configs'    => array_filter($this->resource['configs'], fn ($key) => $key === Config::LAYOUT, ARRAY_FILTER_USE_KEY),
            'collection' => [
                'name'        => $this->resource['collection']->getName(),
                'description' => $this->resource['collection']->getDescription(),
                'links'       => $this->resource['collection']->getLinks()
                    ->map(fn (LinkEntity $link) => new BioLinkResource($link)),
            ]
        ];
    }
}
