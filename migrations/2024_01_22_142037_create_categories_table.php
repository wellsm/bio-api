<?php

declare(strict_types=1);

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id');
            $table->string('name');
            $table->datetimes();

            $table->foreign('profile_id')->on('profiles')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
}
