<?php

declare(strict_types=1);

namespace Application\Service\Profile;

use Application\Constants\App;
use Application\Service\File\Upload;
use Core\DTO\Profile\ProfileCreateDTO;
use Core\Entities\ProfileEntity;
use Core\Entities\UserEntity;
use Core\Repositories\ProfileRepository;
use Hyperf\Context\Context;

class ProfileCreate
{
    public function __construct(
        private ProfileRepository $repository,
        private Upload $upload
    ) {}

    public function run(ProfileCreateDTO $dto, ?UserEntity $user = null): ProfileEntity
    {
        /** @var UserEntity */
        $user    = $user ?? Context::get(App::USER);
        $upload  = $this->upload->filename($dto->avatar);
        $profile = $this->repository->createProfile($user, $dto, $upload);
        
        $this->upload->run($upload);

        return $profile;
    }
}