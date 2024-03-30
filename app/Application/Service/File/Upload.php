<?php

declare(strict_types=1);

namespace Application\Service\File;

use Application\DTO\File\UploadDTO;
use Hyperf\HttpMessage\Upload\UploadedFile;

class Upload
{
    private const string FILENAME = '/uploads/%s.%s';

    private UploadDTO $upload;

    public function filename(string|UploadedFile|null $file): ?UploadDTO
    {
        if (empty($file)) {
            return null;
        }

        $path     = BASE_PATH . '/public';
        $filename = sprintf(self::FILENAME, uniqid(), $file->getExtension());

        return $this->upload = new UploadDTO(compact('file', 'path', 'filename'));
    }

    public function run(?UploadDTO $dto): void
    {
        if (empty($dto)) {
            return;
        }

        $dto->file->moveTo($this->upload->path . $this->upload->filename);
    }
}