<?php

declare(strict_types=1);

namespace Application\Http\Controller\Config;

use Application\Http\Controller\Common\AbstractController;
use Hyperf\DbConnection\Db;

class ConfigListController extends AbstractController
{
    private const ENABLE_SEARCH = 'enable-search';

    private const NAMES = [
        self::ENABLE_SEARCH => 'Enable Search',
    ];

    private const DESCRIPTIONS = [
        self::ENABLE_SEARCH => 'With search, your users can filter your links by link title',
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
            ];
        }, $configs);
    }
}
