<?php

declare(strict_types=1);

namespace Application\Service\SocialMedia;

use Application\Service\Profile\ProfileShow;
use Core\DTO\SocialMedia\SocialMediaUpdateDTO;
use Core\Repositories\SocialMediaRepository;
use Hyperf\DbConnection\Db;

class SocialMediaUpdate
{
    public function __construct(
        private ProfileShow $profile,
        private SocialMediaRepository $repository,
        private Db $db,
    ) {
    }

    public function run(SocialMediaUpdateDTO $dto): void
    {
        $this->db->transaction(function () use ($dto) {
            $profile = $this->profile->run();

            $this->repository->updateSocialMedia($profile, $dto);
        });
    }
}
