<?php

declare(strict_types=1);

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateSocialMediasTable extends Migration
{
    public function up(): void
    {
        Schema::create('social_medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id');
            $table->string('icon');
            $table->string('name');
            $table->string('url');
            $table->boolean('active');
            $table->unsignedTinyInteger('order');
            $table->datetimes();

            $table->foreign('profile_id')->on('profiles')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_medias');
    }
}
