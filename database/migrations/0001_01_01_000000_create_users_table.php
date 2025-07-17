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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id_user', 255)->primary(); //
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('nik');
            $table->string('sk_pengangkatan')->nullable();;
            $table->string('no_sk')->nullable();;
                $table->string('tgl_pelatikan');
                $table->string('tempat_lahir')->nullable();;
                // Tambahan custom field
            $table->string('no_hp', 20)->nullable();
            $table->integer('role')->default(0); // 0=user biasa, 1=admin desa, 2=superadmin (misal)
            $table->string('alamat', 255)->nullable();

            // Kalau user adalah admin desa
            $table->string('nama_desa', 50)->nullable();
            $table->string('kecamatan', 20)->nullable();
            $table->string('kabupaten', 30)->nullable();

            $table->string('kode_pos', 40)->nullable();
            $table->enum('status_verifikasi', ['menunggu', 'diterima', 'ditolak'])->nullable();
            $table->string('file_zip_dokumen', 80)->nullable();
            $table->string('id_desa', 255)->unique()->nullable(); // tambahkan ini DI SINI
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
