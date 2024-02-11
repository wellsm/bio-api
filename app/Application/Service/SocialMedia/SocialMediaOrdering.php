<?php

declare(strict_types=1);

namespace Application\Service\SocialMedia;

use Application\Service\Profile\ProfileShow;
use Core\Repositories\SocialMediaRepository;
use Hyperf\DbConnection\Db;

class SocialMediaOrdering
{
    public function __construct(
        private ProfileShow $profile,
        private SocialMediaRepository $repository,
        private Db $db,
    ) {
    }

    public function run(array $medias): void
    {
        $this->db->transaction(function () use ($medias) {
            $profile = $this->profile->run();

            $this->repository->orderSocialMedias($profile, $medias);
        });
    }
}
