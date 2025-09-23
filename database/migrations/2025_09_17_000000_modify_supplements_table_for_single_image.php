<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('supplements', function (Blueprint $table) {
            $table->dropColumn('images');

            $table->string('image_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('supplements', function (Blueprint $table) {
            $table->dropColumn('image_path');
            $table->json('images')->nullable();
        });
    }
};
