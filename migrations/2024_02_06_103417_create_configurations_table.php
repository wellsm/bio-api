<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id');
            $table->string('key', 30);
            $table->string('value');
            $table->datetimes();

            $table->unique(['key', 'value']);
            $table->foreign('profile_id')->on('profiles')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
}
