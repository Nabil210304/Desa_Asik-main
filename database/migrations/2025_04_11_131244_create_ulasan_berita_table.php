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
        Schema::create('ulasan_berita', function (Blueprint $table) {
            $table->id();
             $table->text('id_berita');
            $table->text('ulasan');
            $table->string('id_user', 255);
            $table->timestamp('created_at');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan_berita');
    }
};
