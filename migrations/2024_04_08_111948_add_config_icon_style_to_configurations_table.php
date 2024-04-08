<?php

use Hyperf\Database\Migrations\Migration;
use Hyperf\DbConnection\Db;

use function Hyperf\Collection\data_set;

class AddConfigIconStyleToConfigurationsTable extends Migration
{
    public function up(): void
    {
        $profiles = Db::table('profiles')->get()->pluck('id')->toArray();
        $configs  = array_map(fn (int $id) => [
            'key'        => 'icon-style',
            'value'      => 'circle',
            'profile_id' => $id
        ], $profiles);

        data_set($configs, "*.created_at", date('Y-m-d H:i:s'));
        data_set($configs, "*.updated_at", date('Y-m-d H:i:s'));

        Db::table('configurations')->upsert($configs, ['profile_id', 'key'], ['key']);
    }

    public function down(): void
    {
        Db::table('configurations')
            ->where('key', 'icon-style')
            ->delete();
    }
}
