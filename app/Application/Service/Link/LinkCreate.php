<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Application\Service\File\Upload;
use Application\Service\Profile\ProfileShow;
use Application\Service\ShortUrl\ShortUrlCreate;
use Core\DTO\Link\LinkCreateDTO;
use Core\DTO\ShortUrl\ShortUrlCreateDTO;
use Core\Repositories\LinkRepository;
use Hyperf\DbConnection\Db;

class LinkCreate
{
    public function __construct(
        private ProfileShow $profile,
        private ShortUrlCreate $shortUrl,
        private LinkRepository $repository,
        private Upload $upload,
        private Db $db,
    ) {
    }

    public function run(LinkCreateDTO $dto): void
    {
        $this->db->transaction(function () use ($dto) {
            $upload   = $this->upload->filename($dto->thumbnail);
            $profile  = $this->profile->run();
            $shortUrl = $this->shortUrl->run(new ShortUrlCreateDTO($dto->values()));

            $this->repository->createLink($profile, $dto, $upload, $shortUrl);
            $this->upload->run($upload);
        });
    }
}
