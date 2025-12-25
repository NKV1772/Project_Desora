<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->string('portfolio_id', 50)->primary();
            $table->string('designer_id', 50);
            $table->string('title', 255);
            $table->string('image_url', 500);
            $table->string('category', 50)->nullable();
            $table->text('description')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->integer('view_count')->default(0);
            $table->timestamps();

            $table->foreign('designer_id')->references('user_id')->on('users');
            $table->index('designer_id');
            $table->index('category');
            $table->index('is_approved');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};

