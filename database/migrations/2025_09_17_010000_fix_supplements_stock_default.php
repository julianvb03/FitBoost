<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Normalize null stocks to 0 and enforce NOT NULL with DEFAULT 0
        DB::statement('UPDATE supplements SET stock = 0 WHERE stock IS NULL');
        DB::statement('ALTER TABLE supplements MODIFY stock INT UNSIGNED NOT NULL DEFAULT 0');
    }

    public function down(): void
    {
        // Revert NOT NULL/DEFAULT constraint (allow NULL again)
        DB::statement('ALTER TABLE supplements MODIFY stock INT NULL');
    }
};
