<?php

declare(strict_types=1);

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreatePasswordTokensTable extends Migration
{
    public function up(): void
    {
        Schema::create('password_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('token', 10);
            $table->timestamp('expires_at');

            $table->unique(['user_id', 'token']);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_tokens');
    }
}
