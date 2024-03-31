<?php

declare(strict_types=1);

namespace Application\Http\Controller\Config;

use Application\Http\Controller\Common\AbstractController;
use Application\Service\Configuration\Config;
use Core\Enums\BioLayout;
use Core\Helper\Util;
use Hyperf\DbConnection\Db;

class ConfigListController extends AbstractController
{
    private const NAMES = [
        Config::SEARCH        => 'Enable Search',
        Config::LAYOUT        => 'Bio Layout',
        Config::TAG_PINTEREST => 'Tag do Pinterest'
    ];

    private const DESCRIPTIONS = [
        Config::SEARCH        => 'With search, your users can filter your links by link title',
        Config::LAYOUT        => 'Change your Bio Layout to better serve your users',
        Config::TAG_PINTEREST => 'Connect your Pinterest to your Bio, need to add TXT Record to your domain',
    ];

    public function __invoke()
    {
        $profile = Db::table('profiles')->first();
        $configs = Db::table('configurations')->where('profile_id', $profile['id'])->get()->toArray();

        foreach ($configs as $key => $value) {
            $configs[$key]['name']        = self::NAMES[$value['key']];
            $configs[$key]['description'] = self::DESCRIPTIONS[$value['key']];
        }

        return array_map(function ($config) {
            return [
                'name'        => $config['name'],
                'key'         => $config['key'],
                'value'       => $config['value'],
                'description' => $config['description'],
                'options'     => $this->options($config['key']),
                'type'        => $this->type($config['key']),
            ];
        }, $configs); 
    }

    private function options(string $key): array
    {
        return match ($key) {
            Config::LAYOUT => Util::options([
                BioLayout::List->value => 'List',
                BioLayout::Grid->value => 'Grid',
            ]),
            default => []
        };
    }

    private function type(string $key): string
    {
        return match ($key) {
            Config::LAYOUT        => 'select',
            Config::SEARCH        => 'toggle',
            Config::TAG_PINTEREST => 'input:text',
        };
    }
}
