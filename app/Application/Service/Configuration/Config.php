<?php

declare(strict_types=1);

namespace Application\Service\Configuration;

use Application\Constants\App;
use Core\DTO\Configuration\ConfigurationDTO;
use Core\Entities\ProfileEntity;
use Core\Enums\BioLayout;
use Core\Repositories\ConfigurationRepository;
use Hyperf\Context\Context;

class Config
{
    public const string SEARCH        = 'enable-search';
    public const string LAYOUT        = 'layout';
    public const string TAG_PINTEREST = 'tag-pinterest';

    public const CONFIGS = [
        self::SEARCH        => 0,
        self::LAYOUT        => BioLayout::List->value,
        self::TAG_PINTEREST => ''
    ];

    public function __construct(
        private ConfigurationRepository $repository,
        private ConfigList $configs
    ) {}

    public function run(ProfileEntity $profile, ConfigurationDTO $dto): bool|string
    {
        $this->repository->upsertConfiguration($profile, $dto);

        $configurations = $this->repository->getConfigurationsByProfile($profile);

        Context::set(App::CONFIGS, $configurations);

        return $configurations[$dto->key];
    }
}