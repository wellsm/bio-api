<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddFixedColumnToLinksTable extends Migration
{
    public function up(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->boolean('fixed')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('fixed');
        });
    }
}
