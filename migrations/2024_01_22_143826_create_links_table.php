<?php

declare(strict_types=1);

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateLinksTable extends Migration
{
    public function up(): void
    {
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title', 200);
            $table->string('url', 200);
            $table->string('thumbnail')->nullable();
            $table->boolean('active')->default(false);
            $table->softDeletes();
            $table->datetimes();

            $table->foreign('profile_id')->on('profiles')->references('id');
            $table->foreign('category_id')->on('categories')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('links');
    }
}
