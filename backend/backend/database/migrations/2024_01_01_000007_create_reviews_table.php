<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->string('review_id', 50)->primary();
            $table->string('request_id', 50)->unique();
            $table->string('customer_id', 50);
            $table->string('designer_id', 50);
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('request_id')->references('request_id')->on('design_requests');
            $table->foreign('customer_id')->references('user_id')->on('users');
            $table->foreign('designer_id')->references('user_id')->on('users');
            $table->index('designer_id');
            $table->index('rating');
        });

        // Add check constraint using raw SQL
        DB::statement('ALTER TABLE reviews ADD CONSTRAINT reviews_rating_check CHECK (rating >= 1 AND rating <= 5)');
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

