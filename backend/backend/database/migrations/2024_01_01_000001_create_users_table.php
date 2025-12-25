<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id', 50)->primary();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('full_name', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('avatar_url', 500)->nullable();
            $table->string('role', 20);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('email');
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

