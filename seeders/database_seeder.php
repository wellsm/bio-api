<?php

declare(strict_types=1);

use Application\Constants\Env;
use Core\Enums\BioLayout;
use Core\Enums\IconStyle;
use Core\Helper\SocialMedia;
use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Seeders\Seeder;
use Hyperf\DbConnection\Db;
use Hyperf\Stringable\Str;

use function Hyperf\Collection\collect;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if (Env::isLocal() === false) {
            return;
        }
        
        Schema::disableForeignKeyConstraints();
        
        $this->clearTables();
        
        $database = $this->getLocalUsersData();
        
        $this->createUserWithProfile($database);
        
        Schema::enableForeignKeyConstraints();
    }
    
    private function clearTables(): void
    {
        $tables = [
            'interactions',
            'collection_link', 
            'collections',
            'configurations',
            'social_medias',
            'links',
            'profiles',
            'password_tokens',
            'users'
        ];
        
        foreach ($tables as $table) {
            Db::table($table)->truncate();
        }
    }
    
    private function getLocalUsersData(): array
    {
        return [
            'user' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            'profile' => [
                'name' => 'John Doe',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            'links' => [
                [
                    'title' => 'My Personal Blog',
                    'url' => 'https://john-doe.dev',
                    'thumbnail' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=300&h=200&fit=crop',
                ],
                [
                    'title' => 'Portfolio of Projects',
                    'url' => 'https://github.com/john-doe',
                    'thumbnail' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=300&h=200&fit=crop',
                ],
                [
                    'title' => 'Online Resume',
                    'url' => 'https://john-doe.dev/cv',
                    'thumbnail' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=200&fit=crop',
                ],
            ],
            'social_medias' => [
                [
                    'icon' => 'fab instagram',
                    'url' => 'https://instagram.com/john-doe',
                    'active' => true,
                    'text_color' => '#ffffff',
                    'background' => 'linear-gradient(45deg, #f09433 0%, #e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%)',
                ],
                [
                    'icon' => 'fab twitter',
                    'url' => 'https://twitter.com/john-doe',
                    'active' => true,
                    'text_color' => '#ffffff',
                    'background' => '#1DA1F2',
                ],
                [
                    'icon' => 'fab linkedin',
                    'url' => 'https://linkedin.com/in/john-doe',
                    'active' => true,
                    'text_color' => '#ffffff',
                    'background' => '#1D4ED8',
                ],
                [
                    'icon' => 'fab github',
                    'url' => 'https://github.com/john-doe',
                    'active' => true,
                    'text_color' => '#ffffff',
                    'background' => '#000000',
                ],
            ],
            'configurations' => [
                'layout' => BioLayout::List->value,
                'icon-style' => IconStyle::Circle->value,
                'tag-pinterest' => 'john-doe',
                'enable-search' => true,
            ],
        ];
    }
    
    private function createUserWithProfile(array $data): void
    {
        Db::table('users')
            ->insert($data['user']);

        $user = Db::table('users')
            ->where('email', $data['user']['email'])
            ->first();
        
        Db::table('profiles')
            ->insert(array_merge($data['profile'], [
                'user_id'  => $user['id'],
                'username' => Str::slug($data['profile']['name'])
            ]));

        $profile = Db::table('profiles')
            ->where('user_id', $user['id'])
            ->first();
        
        $medias = collect($data['social_medias'])
            ->map(fn ($media, $index) => [
                ...$media,
                'name' => SocialMedia::getName($media['icon']),
                'order' => ++$index,
                'profile_id' => $profile['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ])
            ->toArray();
        
        $links = array_map(fn ($link) => [
            'title' => trim($link['title']),
            'url' => trim($link['url']),
            'thumbnail' => trim($link['thumbnail']),
            'profile_id' => $profile['id'],
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ], $data['links']);
        
        $configs = collect($data['configurations'])
            ->map(fn ($value, $key) => [
                'key' => $key,
                'value' => $value,
                'profile_id' => $profile['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ])
            ->values()
            ->toArray();
        
        Db::table('social_medias')->insert($medias);
        Db::table('links')->insert($links);
        Db::table('configurations')->insert($configs);
    }
}
