<?php

declare(strict_types=1);

use App\Model\Link;
use App\Model\Profile;
use App\Model\SocialMedia as ModelSocialMedia;
use Application\Constants\Env;
use Carbon\Carbon;
use Core\Helper\SocialMedia;
use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;
use Hyperf\Stringable\Str;
use Ramsey\Uuid\Uuid;

use function Hyperf\Collection\collect;
use function Hyperf\Collection\data_fill;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $database = require_once BASE_PATH . '/storage/database/insert.php';
        $medias   = collect($database['social_medias'])
            ->map(fn ($media, $index) => [
                ...$media,
                'name'  => SocialMedia::getName($media['icon']),
                'order' => ++$index
            ])
            ->toArray();

        Schema::disableForeignKeyConstraints();

        Db::table('users')->truncate();
        Db::table('users')->insert($database['user']);

        $user    = Db::table('users')->first();
        $profile = $database['profile'];

        Db::table('profiles')->truncate();
        Db::table('profiles')->insert(array_merge($profile, [
            'user_id'  => $user['id'],
            'username' => Str::slug($profile['name'])
        ]));

        $configs = collect($database['configurations'])
            ->map(fn ($value, $key) => compact('key', 'value'))
            ->values()
            ->toArray();

        $profile = Db::table('profiles')->first();
        $links   = array_map(fn ($link) => [
            'title'      => trim($link['title']),
            'url'        => trim($link['url']),
            'thumbnail'  => trim($link['thumbnail']),
            'profile_id' => $profile['id'],
            'active'     => 1,
        ], $database['links']);

        data_fill($configs, '*.profile_id', $profile['id']);
        data_fill($medias, '*.profile_id', $profile['id']);

        Db::table('social_medias')->truncate();
        Db::table('social_medias')->upsert($medias, ['url']);

        Db::table('links')->truncate();
        Db::table('links')->upsert($links, ['url']);

        Db::table('configurations')->truncate();
        Db::table('configurations')->upsert($configs, ['key', 'value']);

        if (Env::isLocal() === false) {
            return;
        }

        $links        = Db::table('links')->get();
        $medias       = Db::table('social_medias')->get();
        $interactions = [];

        $months = Carbon::now()->subMonths(11)->monthsUntil(Carbon::now());
        $months = $months->map(function (Carbon $date) { 
            return $date->year . '-' . $date->month;
        });

        $months = iterator_to_array($months);

        foreach ($links as $link) {
            foreach ($months as $month) {
                [$year, $month] = explode('-', $month);

                foreach (range(1, random_int(5, 20)) as $i) {
                    $interactions[] = [
                        'id'                => Uuid::uuid4()->toString(),
                        'interactable_id'   => $link['id'],
                        'interactable_type' => Link::class,
                        'created_at'        => Carbon::now()->setYear($year)->setMonth($month)->format('Y-m-d H:i:s'),
                    ];
                }
            }
        }

        foreach ($medias as $media) {
            foreach (range(1, random_int(50, 200)) as $i) {
                $interactions[] = [
                    'id'                => Uuid::uuid4()->toString(),
                    'interactable_id'   => $media['id'],
                    'interactable_type' => ModelSocialMedia::class,
                    'created_at'        => date('Y-m-d H:i:s'),
                ];
            }
        }

        foreach (range(1, random_int(500, 5000)) as $i) {
            $interactions[] = [
                'id'                => Uuid::uuid4()->toString(),
                'interactable_id'   => $profile['id'],
                'interactable_type' => Profile::class,
                'created_at'        => date('Y-m-d H:i:s'),
            ];
        }

        foreach (array_chunk($interactions, 1000) as $interactions) {
            Db::table('interactions')->upsert($interactions, ['id']);
        }

        Schema::enableForeignKeyConstraints();
    }
}
