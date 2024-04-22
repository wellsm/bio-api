<?php

declare(strict_types=1);

namespace Application\Service\Link;

use Application\Service\Profile\ProfileShow;
use Application\Service\ShortUrl\ShortUrlUpdate;
use Core\DTO\Link\LinkUpdateDTO;
use Core\Repositories\LinkRepository;
use Hyperf\DbConnection\Db;
use Hyperf\HttpMessage\Upload\UploadedFile;

class LinkUpdate
{
    public function __construct(
        private ProfileShow $profile,
        private ShortUrlUpdate $shortUrl,
        private LinkShow $link,
        private LinkRepository $repository,
        private Db $db,
    ) {
    }

    public function run(LinkUpdateDTO $dto): void
    {
        $this->db->transaction(function () use ($dto) {
            $link     = $this->link->run((int) $dto->id);
            $file     = $link->getFilename();
            $filename = $link->getThumbnail();
            $profile  = $this->profile->run();
            $shortUrl = $link->getShortUrl();

            if (
                $dto->url != $link->getUrl()
                && !empty($shortUrl)
            ) {
                $this->shortUrl->run($dto->url, $shortUrl);
            }

            if ($dto->thumbnail) {
                /** @var UploadedFile */
                $thumbnail = $dto->thumbnail;
                $path      = BASE_PATH . '/public';
                $filename  = "/uploads/{$file}.{$thumbnail->getExtension()}";

                $thumbnail->moveTo($path . $filename);
            }

            $this->repository->updateLink(new LinkUpdateDTO(array_merge($dto->values(), [
                'thumbnail' => $filename,
                'profile'   => $profile,
                'shortUrl'  => $shortUrl,
            ])));
        });
    }
}
