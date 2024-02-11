<?php

declare(strict_types=1);

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateInteractionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('interactable_id');
            $table->string('interactable_type')->index();
            $table->datetimes();

            $table->index(['interactable_id', 'interactable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
}
