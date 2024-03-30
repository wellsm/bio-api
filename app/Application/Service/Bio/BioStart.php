<?php

declare(strict_types=1);

namespace Application\Service\Bio;

use Application\Responses\BioStartResponse;
use Application\Service\Configuration\ConfigStart;
use Application\Service\PasswordToken\VerifyUser;
use Application\Service\Profile\ProfileCreate;
use Application\Service\User\UserCreate;
use Application\Service\User\UserSetPassword;
use Core\DTO\Bio\BioStartDTO;
use Core\DTO\Profile\ProfileCreateDTO;
use Core\DTO\User\UserCreateDTO;
use Core\DTO\User\UserSetPasswordDTO;
use Core\Entities\ProfileEntity;
use Hyperf\DbConnection\Db;

class BioStart
{
    public function __construct(
        private UserCreate $user,
        private UserSetPassword $password,
        private VerifyUser $verify,
        private ProfileCreate $profile,
        private ConfigStart $configs,
        private Db $db,
    ) {}

    public function run(BioStartDTO $dto): BioStartResponse
    {
        return $this->db->transaction(function () use ($dto) {
            $response = $this->createUser($dto);
            $response = $this->createProfile($dto, $response->getToken());

            $this->createConfigs($response->getProfile());

            return $response;
        });
    }

    private function createUser(BioStartDTO $dto): BioStartResponse
    {
        $user = $this->user->run(new UserCreateDTO([
            'name'  => $dto->name,
            'email' => $dto->email
        ]));

        $token = $this->verify->run($user);

        return new BioStartResponse(user: $user, token: $token->getToken());
    }

    private function createProfile(BioStartDTO $dto, string $token): BioStartResponse
    {
        $user = $this->password->run(new UserSetPasswordDTO([
            'token'    => $token,
            'password' => $dto->password,
        ]));

        $profile = $this->profile->run(
            user: $user,
            dto: new ProfileCreateDTO([
                'name'     => $dto->name,
                'username' => $dto->username,
                'avatar'   => null,
            ])
        );

        return new BioStartResponse(user: $user, profile: $profile);
    }

    private function createConfigs(ProfileEntity $profile): void
    {
        $this->configs->run($profile);
    }
}