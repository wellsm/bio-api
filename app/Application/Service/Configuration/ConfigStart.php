<?php

declare(strict_types=1);

namespace Application\Service\Configuration;

use Core\DTO\Configuration\ConfigurationDTO;
use Core\Entities\ProfileEntity;

class ConfigStart
{
    public function __construct(
        private Config $config
    ) {}

    public function run(ProfileEntity $profile): void
    {
        foreach (Config::CONFIGS as $key => $value) {
            $this->config->run($profile, new ConfigurationDTO(compact('key', 'value')));
        }
    }
}