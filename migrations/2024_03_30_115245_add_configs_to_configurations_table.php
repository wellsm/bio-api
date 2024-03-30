<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;
use Hyperf\DbConnection\Db;

use function Hyperf\Collection\data_set;

class AddConfigsToConfigurationsTable extends Migration
{
    public function up(): void
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->dropIndex('configurations_key_value_unique');
            $table->unique(['profile_id', 'key']);
        });

        $profiles = Db::table('profiles')->get()->pluck('id')->toArray();
        $configs  = array_map(fn (int $id) => [
            'key'        => 'layout',
            'value'      => 'list',
            'profile_id' => $id
        ], $profiles);

        data_set($configs, "*.created_at", date('Y-m-d H:i:s'));
        data_set($configs, "*.updated_at", date('Y-m-d H:i:s'));

        Db::table('configurations')->upsert($configs, ['profile_id', 'key'], ['key']);
    }

    public function down(): void
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->dropIndex('configurations_profile_id_key_unique');
            $table->unique(['key', 'value']);
        });

        Db::table('configurations')
            ->where('key', 'layout')
            ->delete();
    }
}
