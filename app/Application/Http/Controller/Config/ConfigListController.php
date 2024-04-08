<?php

declare(strict_types=1);

namespace Application\Http\Controller\Config;

use Application\Http\Controller\Common\AbstractController;
use Application\Service\Configuration\Config;
use Core\Enums\BioLayout;
use Core\Enums\IconStyle;
use Core\Helper\Util;
use Hyperf\DbConnection\Db;

class ConfigListController extends AbstractController
{
    public function __invoke()
    {
        $profile = Db::table('profiles')->first();
        $configs = Db::table('configurations')->where('profile_id', $profile['id'])->get()->toArray();

        foreach ($configs as $key => $value) {
            $configs[$key]['name']        = Config::NAMES[$value['key']];
            $configs[$key]['description'] = Config::DESCRIPTIONS[$value['key']];
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
        return match ((string) $key) {
            Config::LAYOUT => Util::options([
                BioLayout::List->value => 'List',
                BioLayout::Grid->value => 'Grid',
            ]),
            Config::ICON_STYLE => Util::options([
                IconStyle::Circle->value        => 'Circle',
                IconStyle::Square->value        => 'Square',
                IconStyle::RoundedSquare->value => 'Rounded Square',
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
            Config::ICON_STYLE    => 'select',
        };
    }
}
