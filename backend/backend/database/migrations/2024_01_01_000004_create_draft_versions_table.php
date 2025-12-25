<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('draft_versions', function (Blueprint $table) {
            $table->string('draft_id', 50)->primary();
            $table->string('request_id', 50);
            $table->integer('version_number');
            $table->string('file_url', 500);
            $table->string('file_name', 255)->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->string('file_type', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 50)->default('Pending');
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('request_id')->references('request_id')->on('design_requests');
            $table->index('request_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('draft_versions');
    }
};

