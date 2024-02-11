<?php

declare(strict_types=1);

namespace Application\Service\SocialMedia;

use Application\Service\Profile\ProfileShow;
use Core\Repositories\SocialMediaRepository;
use Hyperf\Collection\Collection;

class SocialMediaList
{
    public function __construct(
        private ProfileShow $profile,
        private SocialMediaRepository $repository
    ) {}

    public function run(?bool $active = null): Collection
    {
        $profile = $this->profile->run();

        return $this->repository->listSocialMedias($profile, $active);
    }
}