<?php

declare(strict_types=1);

namespace Application\Service\Configuration;

use Application\Constants\App;
use Core\DTO\Configuration\ConfigurationDTO;
use Core\Entities\ProfileEntity;
use Core\Repositories\ConfigurationRepository;
use Hyperf\Context\Context;

class Config
{
    public const ENABLE_SEARCH = 'enable-search';

    public function __construct(
        private ConfigurationRepository $repository,
        private ConfigList $configs
    ) {}

    public function run(ProfileEntity $profile, ConfigurationDTO $dto): bool|string
    {
        $configurations = $this->configs->run($profile);

        $this->update($profile, $dto, $configurations);

        Context::set(App::CONFIGS, $configurations);

        return $configurations[$dto->key];
    }

    private function update(ProfileEntity $profile, ConfigurationDTO $dto, array $configurations): array
    {
        if ($dto->value === null) {
            return $configurations;
        }

        $this->repository->updateConfiguration($profile, $dto);

        return array_merge($configurations, [$dto->key => $dto->value]);
    }
}