<?php

declare(strict_types=1);

namespace Application\Http\Resource\StatusCode;

use Application\Constants\ErrorCode;
use Application\Exception\BusinessException;
use Hyperf\Resource\Json\JsonResource;
use Hyperf\Resource\Response\Response;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Teapot\StatusCode\All;
use Teapot\StatusCode\Http;

class ErrorResource extends JsonResource
{
    /** @var BusinessException */
    public mixed $resource;

    public ?string $wrap = null;

    public function toArray(): array
    {
        $code    = $this->resource->getCode();
        $message = ErrorCode::getMessage($code);

        if ($this->resource instanceof ValidationException) {
            return [
                'code'   => All::UNPROCESSABLE_ENTITY,
                'errors' => $this->resource->validator->errors()->getMessages()
            ];
        }

        return [
            'code'    => $code,
            'message' => $this->resource->getMessage() ?: $message,
        ];
    }

    public function toResponse(): ResponseInterface
    {
        $status = match ($this->resource->getCode()) {
            Http::NOT_FOUND    => Http::NOT_FOUND,
            Http::UNAUTHORIZED => Http::UNAUTHORIZED,
            Http::FORBIDDEN    => Http::FORBIDDEN,
            default => Http::BAD_REQUEST,
        };

        return (new Response($this))
            ->toResponse()
            ->withStatus($status)
        ;
    }
}
