<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_supplement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplement_id');
            $table->timestamps();

            $table->unique(['category_id', 'supplement_id']);
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('supplement_id')->references('id')->on('supplements')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_supplement');
    }
};
