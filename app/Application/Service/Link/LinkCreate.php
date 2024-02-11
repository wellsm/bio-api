<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Application\Service\Profile\ProfileShow;
use Core\DTO\Link\LinkCreateDTO;
use Core\Repositories\LinkRepository;
use Hyperf\DbConnection\Db;
use Hyperf\HttpMessage\Upload\UploadedFile;

class LinkCreate
{
    public function __construct(
        private ProfileShow $profile,
        private LinkRepository $repository,
        private Db $db,
    ) {
    }

    public function run(LinkCreateDTO $dto): void
    {
        $this->db->transaction(function () use ($dto) {
            /** @var UploadedFile */
            $thumbnail = $dto->thumbnail;
            $file      = uniqid();
            $path      = BASE_PATH . '/public';
            $filename  = "/uploads/{$file}.{$thumbnail->getExtension()}";
            $profile   = $this->profile->run();

            $this->repository->createLink(new LinkCreateDTO(array_merge($dto->values(), [
                'thumbnail' => $filename,
                'profile'   => $profile
            ])));

            $thumbnail->moveTo($path . $filename);
        });
    }
}
