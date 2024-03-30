<?php

declare(strict_types=1);

namespace Core\DTO\Link;

use Core\Common\DTO;
use Core\Entities\ProfileEntity;
use SplFileInfo;

final class LinkCreateDTO extends DTO
{
    private const string FILENAME = '%s/uploads/%s.%s';

    public string $title;
    public string $url;
    public string|SplFileInfo|null $thumbnail;

    public function getPath(): string
    {
        return BASE_PATH . '/public';
    }

    public function getFilename(): ?string
    {
        return $this->thumbnail === null
            ? null
            : sprintf(self::FILENAME, $this->getPath(), uniqid(), $this->thumbnail->getExtension());
    }
}