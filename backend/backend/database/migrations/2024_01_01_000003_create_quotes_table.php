<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->string('quote_id', 50)->primary();
            $table->string('request_id', 50);
            $table->string('designer_id', 50);
            $table->decimal('price', 10, 2);
            $table->integer('estimated_days')->nullable();
            $table->text('description')->nullable();
            $table->string('status', 50)->default('Pending');
            $table->timestamps();

            $table->foreign('request_id')->references('request_id')->on('design_requests');
            $table->foreign('designer_id')->references('user_id')->on('users');
            $table->index('request_id');
            $table->index('designer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};

