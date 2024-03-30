<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use App\Model\Configuration;
use Core\DTO\Configuration\ConfigurationDTO;
use Core\Entities\ProfileEntity;
use Core\Repositories\ConfigurationRepository;
use Hyperf\DbConnection\Db;

class ConfigurationDatabaseRepository implements ConfigurationRepository
{
    public function getConfigurationsByProfile(ProfileEntity $profile): array
    {
        return Configuration::where('profile_id', $profile->getId())
            ->get()
            ->pluck('value', 'key')
            ->toArray();
    }

    public function upsertConfiguration(ProfileEntity $profile, ConfigurationDTO $dto)
    {
        return Db::table('configurations')
            ->upsert([
                [
                    ...$dto->values(),
                    ...[
                        'profile_id' => $profile->getId()
                    ]
                ]
            ], ['key', 'profile_id']);
    }
}
