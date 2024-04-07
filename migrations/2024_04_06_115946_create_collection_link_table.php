<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateCollectionLinkTable extends Migration
{
    public function up(): void
    {
        Schema::create('collection_link', function (Blueprint $table) {
            $table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('link_id');
            
            $table->foreign('collection_id')->on('collections')->references('id');
            $table->foreign('link_id')->on('links')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collection_link');
    }
}
