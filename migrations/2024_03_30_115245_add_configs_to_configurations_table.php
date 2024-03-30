<?php

use Hyperf\Database\Migrations\Migration;
use Hyperf\DbConnection\Db;

class AddConfigsToConfigurationsTable extends Migration
{
    public function up(): void
    {
        $profiles = Db::table('profiles')->get()->pluck('id')->toArray();

        dd($profiles);

        $configs  = array_map(fn (int $id) => [
            'key'        => 'layout',
            'value'      => 'list',
            'profile_id' => $id
        ], $profiles);

        Db::table('configurations')->upsert($configs, ['profile_id', 'key']);
    }

    public function down(): void
    {
        Db::table('configurations')
            ->where('key', 'layout')
            ->delete();
    }
}
