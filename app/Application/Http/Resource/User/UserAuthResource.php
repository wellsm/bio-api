<?php

declare(strict_types=1);

namespace Application\Http\Resource\User;

use Hyperf\Resource\Json\JsonResource;

class UserAuthResource extends JsonResource
{
    public ?string $wrap = null;

    public function toArray(): array
    {
        $response = [
            'type'  => 'Bearer',
            'token' => $this->resource,
        ];

        if (isset($this->resource['token'])) {
            $response = array_merge($response, $this->resource);
        }

        return $response;
    }
}
