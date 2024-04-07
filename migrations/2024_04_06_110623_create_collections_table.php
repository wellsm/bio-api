<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->string('hash', 36)->index();
            $table->string('name', 150);
            $table->string('description', 1000)->nullable();
            $table->softDeletes();
            $table->datetimes();
            
            $table->foreign('profile_id')->on('profiles')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
}