<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmDesa extends Model
{
    protected $table = 'umkm_desa';
    protected $primaryKey = 'id_umkm';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_umkm',
        'id_desa',
        'nama_umkm',
        'ringkasan_umkm',
        'foto_umkm',
        'foto_penghargaan',
        'nama_penghargaan',
        'kategori_umkm',
        'produk_umkm',
        'sosmed_facebook',
        'sosmed_instagram',
        'sosmed_tiktok',
        'sosmed_twitter',
        'alamat_lengkap',
        'nomor_izin_berusaha',
        'no_telepon',
        'tambah_penjualan_produk',
        'jumlah_penjualan_perbulan',
    ];

    protected $casts = [
        'foto_penghargaan' => 'array',
        'nama_penghargaan' => 'array',
        'produk_umkm' => 'array',
        'tambah_penjualan_produk' => 'array',
        'jumlah_penjualan_perbulan' => 'array',
    ];

    public function desa()
    {
        return $this->belongsTo(User::class, 'id_desa', 'id_desa');
    }

    public function ulasan()
    {
        return $this->hasMany(UlasanUmkm::class, 'id_umkm');
    }
}
