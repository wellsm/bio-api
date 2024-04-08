<?php

declare(strict_types=1);

namespace Application\Service\Configuration;

use Application\Constants\App;
use Core\DTO\Configuration\ConfigurationDTO;
use Core\Entities\ProfileEntity;
use Core\Enums\BioLayout;
use Core\Enums\IconStyle;
use Core\Repositories\ConfigurationRepository;
use Hyperf\Context\Context;

class Config
{
    public const string SEARCH        = 'enable-search';
    public const string LAYOUT        = 'layout';
    public const string TAG_PINTEREST = 'tag-pinterest';
    public const string ICON_STYLE    = 'icon-style';

    public const CONFIGS = [
        self::SEARCH        => 0,
        self::LAYOUT        => BioLayout::List->value,
        self::TAG_PINTEREST => '',
        self::ICON_STYLE    => IconStyle::Circle->value,
    ];

    public const NAMES = [
        self::SEARCH        => 'Enable Search',
        self::LAYOUT        => 'Bio Layout',
        self::TAG_PINTEREST => 'Tag do Pinterest',
        self::ICON_STYLE    => 'Icon Style',
    ];

    public const DESCRIPTIONS = [
        self::SEARCH        => 'With search, your users can filter your links by link title',
        self::LAYOUT        => 'Change your Bio Layout to better serve your users',
        self::TAG_PINTEREST => 'Connect your Pinterest to your Bio, need to add TXT Record to your domain',
        self::ICON_STYLE    => 'Change your social media icon style',
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