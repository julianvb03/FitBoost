<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Orders: add user_id FK
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        // Items: add order_id and supplement_id FKs
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->after('id');
            $table->unsignedBigInteger('supplement_id')->after('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->foreign('supplement_id')->references('id')->on('supplements')->cascadeOnDelete();
        });

        // Reviews: add user_id and supplement_id FKs + timestamps if missing
        Schema::table('reviews', function (Blueprint $table) {
            if (! Schema::hasColumn('reviews', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }
            if (! Schema::hasColumn('reviews', 'supplement_id')) {
                $table->unsignedBigInteger('supplement_id')->after('user_id');
            }
            if (! Schema::hasColumn('reviews', 'created_at')) {
                $table->timestamps();
            }
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('supplement_id')->references('id')->on('supplements')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['supplement_id']);
            $table->dropColumn(['order_id', 'supplement_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('reviews', 'supplement_id')) {
                $table->dropForeign(['supplement_id']);
                $table->dropColumn('supplement_id');
            }
            // Do not drop timestamps in down (safe no-op)
        });
    }
};
