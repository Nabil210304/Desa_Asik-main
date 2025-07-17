<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm_desa', function (Blueprint $table) {
            $table->id();
            $table->string('id_umkm', 255)->nullable();
            $table->string('id_desa', 255);

            // UMKM Utama
            $table->string('nama_umkm');
               
            $table->text('ringkasan_umkm');
   $table->text('map');

             $table->text('waktu_operasional');
            // Kategori & Produk
            $table->string('kategori_umkm')->nullable();
         

            // Sosial Media
            $table->string('sosmed_facebook')->nullable();
            $table->string('sosmed_instagram')->nullable();
            $table->string('sosmed_tiktok')->nullable();
            $table->string('sosmed_twitter')->nullable();

            // Alamat dan Info Kontak
            $table->string('alamat_lengkap');
            $table->string('nomor_izin_berusaha');
            $table->string('no_telepon');

            // Penjualan
        


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm_desa');
    }
};
