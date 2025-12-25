<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('design_requests', function (Blueprint $table) {
            $table->string('request_id', 50)->primary();
            $table->string('customer_id', 50);
            $table->string('designer_id', 50)->nullable();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('category', 50)->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->date('deadline')->nullable();
            $table->string('status', 50);
            $table->timestamps();

            $table->foreign('customer_id')->references('user_id')->on('users');
            $table->foreign('designer_id')->references('user_id')->on('users');
            $table->index('customer_id');
            $table->index('designer_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('design_requests');
    }
};

