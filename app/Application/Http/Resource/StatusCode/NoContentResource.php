<?php

declare(strict_types=1);

namespace Application\Http\Resource\StatusCode;

use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Resource\Json\JsonResource;
use Hyperf\Resource\Response\Response;
use Psr\Http\Message\ResponseInterface;
use Teapot\StatusCode\Http;

class NoContentResource extends JsonResource
{
    public ?string $wrap = null;

    public function toArray(): array
    {
        return [];
    }

    public function toResponse(): ResponseInterface
    {
        return (new Response($this))
            ->toResponse()
            ->withBody(new SwooleStream(''))
            ->withStatus(Http::NO_CONTENT)
        ;
    }
}
