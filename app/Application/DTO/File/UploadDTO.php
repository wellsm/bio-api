<?php

declare(strict_types=1);

namespace Application\DTO\File;

use Core\Common\DTO;
use Hyperf\HttpMessage\Upload\UploadedFile;

final class UploadDTO extends DTO
{
    public string|UploadedFile|null $file;
    public string $path;
    public string $filename;
}