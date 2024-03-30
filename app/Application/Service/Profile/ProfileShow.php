<?php

declare(strict_types=1);

namespace Application\Service\Profile;

use Application\Constants\App;
use Core\Entities\ProfileEntity;
use Core\Repositories\ProfileRepository;
use Hyperf\Context\Context;

class ProfileShow
{
    private const PROFILE = 1;

    public function __construct(
        private ProfileRepository $repository
    ) {}

    public function run(?int $id = self::PROFILE): ProfileEntity
    {
        $profile = Context::get(App::PROFILE)
            ?? $this->getProfileById($id)
            ?? $this->repository->getFirstProfile();

        Context::set(App::PROFILE, $profile);

        return $profile;
    }

    private function getProfileById(?int $id): ?ProfileEntity
    {
        return empty($id) ? null : $this->repository->getProfileById($id);
    }
}