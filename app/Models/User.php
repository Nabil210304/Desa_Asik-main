<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Tambahan untuk email verification
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use MustVerifyEmailTrait;   // trait untuk mengirim dan mengecek verifikasi

    protected $table = 'users';
 protected $primaryKey = 'id_user'; // ganti dari default 'id'

    public $incrementing = false; // karena ID kamu berupa string (bukan integer)

    protected $keyType = 'string';

protected $fillable = [
    'id_user',
    'name',
    'email',
    'email_verified_at',
    'password',
    'remember_token',
    'no_hp',
    'role',
    'alamat',

    // kolom admin desa
    'id_desa',
    'nama_desa',
    'kecamatan',
    'kabupaten',
    'provinsi',
    'kode_pos',
    'status_verifikasi',
    'file_zip_dokumen',

    // kolom tambahan baru
    'nik',
    'sk_pengangkatan',
    'no_sk',
    'tgl_pelatikan',
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // constants role
    public const ROLE_USER       = 0;
    public const ROLE_ADMIN_DESA = 1;
    public const ROLE_SUPERADMIN = 2;






    // helper
    public function isAdminDesa(): bool
    {
        return $this->role === self::ROLE_ADMIN_DESA;
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPERADMIN;
    }

    // relasi-relasi seperti sebelumnya…
    public function umkms()
    {
        return $this->hasMany(UmkmDesa::class, 'id_desa', 'id');
    }

    public function beritas()
    {
        return $this->hasMany(BeritaDesa::class, 'id_desa', 'id');
    }

    public function profilDesa()
    {
        return $this->hasOne(ProfilDesa::class, 'id_desa', 'id');
    }

    public function perangkatDesas()
    {
        return $this->hasMany(PrangkatDesa::class, 'id_desa', 'id');
    }

    public function pengeluaranDesas()
    {
        return $this->hasMany(PengeluaranDesa::class, 'id_desa', 'id');
    }

    public function ulasanUmkms()
    {
        return $this->hasMany(UlasanUmkm::class, 'id_user', 'id');
    }

    public function ulasanBeritas()
    {
        return $this->hasMany(UlasanBerita::class, 'id_user', 'id_user');
    }
}
