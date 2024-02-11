<?php

declare(strict_types=1);

namespace Application\Service\Configuration;

use Application\Constants\App;
use Application\Service\Profile\ProfileShow;
use Core\Repositories\ConfigurationRepository;
use Hyperf\Context\Context;

class ConfigList
{
    public function __construct(
        private ProfileShow $profile,
        private ConfigurationRepository $repository
    ) {}

    public function run(): array
    {
        $profile = $this->profile->run();
        $configs = Context::get(App::CONFIGS) ?? $this->repository->getConfigurationsByProfile($profile);

        Context::set(App::CONFIGS, $configs);

        return $configs;
    }
}