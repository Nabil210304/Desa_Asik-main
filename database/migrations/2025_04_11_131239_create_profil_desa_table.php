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
        Schema::create('profil_desa', function (Blueprint $table) {
                $table->id();
                $table->string('id_desa', 255);
                $table->string('id_prangkat_desa', 255)->nullable();
                $table->string('nama_desa');
                $table->text('foto')->nullable();
                  $table->text('foto2')->nullable();
                    $table->text('foto3')->nullable();
                      $table->text('foto4')->nullable();
                        $table->text('foto5')->nullable();
                          $table->text('foto6')->nullable();
                  

$table->string('link_ig')->nullable();
            $table->string('email')->nullable();
           $table->string('linkedin')->nullable();
            $table->string('foto_kades')->nullable();
             $table->string('foto_wades')->nullable();



             $table->string('link_ig_wakil')->nullable();
            $table->string('email_wakil')->nullable();
            $table->string('nama_kepala_desa')->nullable();
            $table->string('nama_wakil_kepala_desa')->nullable();
           $table->string('linkedin_wakil')->nullable();
               $table->text('visi')->nullable();
                   $table->text('misi')->nullable();
      















                $table->string('provinsi')->nullable();
                $table->string('kabupaten')->nullable();
                $table->string('kecamatan')->nullable();
                $table->text('deskripsi')->nullable();
                $table->text('link_map')->nullable();
                $table->string('luas_km', 40)->nullable();
                $table->string('kontak_desa', 255)->nullable();
                $table->integer('jumlah_laki_laki');
                $table->integer('jumlah_perempuan');
                $table->string('jumlah_penduduk_kurang_10tahun', 50);
                $table->string('jumlah_penduduk_kurang_20tahun', 50);
                $table->string('jumlah_penduduk_kurang_50tahun', 50);
                $table->string('jumlah_penduduk_lebih_50tahun', 50);
                $table->integer('total_pemasukan');
                $table->text('file_bukti_pemasukan')->nullable();
              

          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desa');
    }
};
