<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'id_user' => Str::uuid()->toString(),
            'name' => 'Admin Desa',
            'email' => 'admin@desa.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'), // gunakan hash untuk password
            'remember_token' => Str::random(10),
            'nik' => '3271012345678901',
            'sk_pengangkatan' => 'sk_pengangkatan.pdf',
            'no_sk' => 'SK-001',
            'tgl_pelatikan' => '2023-01-01',
            'tempat_lahir' => 'Bandung', // tambahkan ini
            'kode_pos' => '40123',
            'no_hp' => '081234567890',
            'role' => 3,
            'alamat' => 'Jl. Contoh No. 123',
            'nama_desa' => 'Desa Contoh',
            'kecamatan' => 'Cimahi',
            'kabupaten' => 'Bandung',
            'status_verifikasi' => 'diterima',
            'file_zip_dokumen' => 'dokumen_admin.zip',
            'id_desa' => Str::uuid()->toString(), // harus unik
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
