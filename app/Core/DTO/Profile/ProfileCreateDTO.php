<?php

declare(strict_types=1);

namespace Core\DTO\Profile;

use Core\Common\DTO;
use SplFileInfo;

final class ProfileCreateDTO extends DTO
{
    private const string FILENAME = '%s/uploads/%s.%s';

    public string $name;
    public string $username;
    public string|SplFileInfo|null $avatar;

    public function getPath(): string
    {
        return BASE_PATH . '/public';
    }

    public function getAvatarFilename(): ?string
    {
        return sprintf(self::FILENAME, $this->getPath(), uniqid(), 'png');

        return empty($this->avatar)
            ? null
            : sprintf(self::FILENAME, $this->getPath(), $this->username, $this->avatar->getExtension());
    }
}