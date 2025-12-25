<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->string('feedback_id', 50)->primary();
            $table->string('draft_id', 50);
            $table->string('customer_id', 50);
            $table->text('comment')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('draft_id')->references('draft_id')->on('draft_versions');
            $table->foreign('customer_id')->references('user_id')->on('users');
            $table->index('draft_id');
            $table->index('customer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};

