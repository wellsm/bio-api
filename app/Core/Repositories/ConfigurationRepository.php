<?php

declare(strict_types=1);

namespace Core\Repositories;

use Core\DTO\Configuration\ConfigurationDTO;
use Core\Entities\ProfileEntity;

interface ConfigurationRepository
{
    public function getConfigurationsByProfile(ProfileEntity $profile): array;

    public function upsertConfiguration(ProfileEntity $profile, ConfigurationDTO $dto);
}
