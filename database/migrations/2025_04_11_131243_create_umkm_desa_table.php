<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (!Schema::hasTable('ulasan_umkm')) {
            Schema::create('ulasan_umkm', function (Blueprint $table) {
            $table->id();
            $table->string('id_umkm', 255);
            $table->integer('rating');
            $table->text('ulasan');
             $table->text('class')->nullable();
            $table->string('id_user', 255);
            $table->json('photos')->nullable();
            $table->timestamp('created_at');

        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan_umkm');
    }
};
