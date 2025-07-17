<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdminDesa extends Model
{
    protected $table = 'user_admin_desa';
    protected $primaryKey = 'id_desa';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id_desa', 'nama_desa', 'alamat', 'kecamatan', 'kabupaten', 'provinsi', 'kode_pos', 'id_user', 'status_verifikasi', 'file_zip_dokumen'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function profilDesa()
    {
        return $this->hasOne(ProfilDesa::class, 'id_desa');
    }

    public function pengeluaran()
    {
        return $this->hasMany(PengeluaranDesa::class, 'id_desa');
    }

    public function umkm()
    {
        return $this->hasMany(UmkmDesa::class, 'id_desa');
    }

    public function berita()
    {
        return $this->hasMany(BeritaDesa::class, 'id_desa');
    }

    public function prangkatDesa()
    {
        return $this->hasMany(PrangkatDesa::class, 'id_desa');
    }
}
