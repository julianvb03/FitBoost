<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplement_test', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplement_id');
            $table->unsignedBigInteger('test_id');
            $table->timestamps();

            $table->unique(['supplement_id', 'test_id']);
            $table->foreign('supplement_id')->references('id')->on('supplements')->cascadeOnDelete();
            $table->foreign('test_id')->references('id')->on('tests')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplement_test');
    }
};
