<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddColorsToSocialMediasTable extends Migration
{
    public function up(): void
    {
        Schema::table('social_medias', function (Blueprint $table) {
            $table->string('text_color', 25)->default('#000');
            $table->string('background', 200)->default('transparent');
        });
    }

    public function down(): void
    {
        Schema::table('social_medias', function (Blueprint $table) {
            $table->dropColumn('text_color');
            $table->dropColumn('background');
        });
    }
}
