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
        Schema::create('pengeluaran_desa', function (Blueprint $table) {
            $table->id();
            $table->string('id_desa', 255);
            $table->string('tipe', 255);
            $table->string('nama', 255);
            $table->string('kategori', 255);
            $table->integer('jumlah');
            $table->string('deskripsi', 255);
            $table->string('bulan', 255);
            $table->string('tahun', 255);
            $table->string('kuitansi', 255);
            $table->string('status', 255)->nullable();

      
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran_desa');
    }
};
