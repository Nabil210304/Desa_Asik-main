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
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata', 255);
            $table->string('deskripsi_wisata', 255);
            $table->string('akses', 255);
            $table->string('lokasi', 255);
            $table->string('Jenis_wisata')->nullable();
            $table->string('foto_bacground_wisata')->nullable();
            $table->string('gambar_wisata')->nullable();

            $table->string('id_desa');
            $table->string('id_user');
            $table->string('id_umkm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};
