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
        Schema::create('berita_desa', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('id_desa', 255)->nullable(); // <- ini penting kalau belum login user
            $table->text('foto');
            $table->text('deskripsi');
            $table->string('judul', 255);
            $table->timestamp('created_at');
            $table->text('referensi')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_desa');
    }
};
