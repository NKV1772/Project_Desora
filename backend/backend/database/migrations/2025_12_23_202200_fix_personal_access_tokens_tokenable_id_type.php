<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if foreign key exists and drop it
        $constraintName = 'personal_access_tokens_tokenable_id_foreign';
        $constraintExists = DB::selectOne("
            SELECT constraint_name 
            FROM information_schema.table_constraints 
            WHERE constraint_name = ? 
            AND table_name = 'personal_access_tokens'
        ", [$constraintName]);

        if ($constraintExists) {
            DB::statement("ALTER TABLE personal_access_tokens DROP CONSTRAINT IF EXISTS {$constraintName}");
        }

        // Change column type from bigint to string
        DB::statement('ALTER TABLE personal_access_tokens ALTER COLUMN tokenable_id TYPE VARCHAR(50) USING tokenable_id::text');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Change column type back from string to bigint
        DB::statement('ALTER TABLE personal_access_tokens ALTER COLUMN tokenable_id TYPE BIGINT USING tokenable_id::bigint');
    }
};

