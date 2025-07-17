<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'id','nama_desa' ,'id_desa', 'foto', 'deskripsi', 'link_map', 'luas_km', 'kontak_desa',
        'id_prangkat_desa', 'jumlah_laki_laki', 'jumlah_perempuan', 'jumlah_penduduk_kurang_10tahun',
        'jumlah_penduduk_kurang_20tahun', 'jumlah_penduduk_kurang_50tahun', 'jumlah_penduduk_lebih_50tahun',
        'total_pemasukan', 'file_bukti_pemasukan','sosmed_kepala_facebook',
        'nama_kepala_desa','nama_wakil_desa',
        'foto_kepala_desa',
        'foto_wakil_desa',
        'sosmed_kepala_instagram',
        'sosmed_kepala_linkedin',
        'sosmed_wakil_facebook',
        'sosmed_wakil_instagram',
        'sosmed_wakil_linkedin',
        'provinsi','kabupaten','kecamatan'
    ];

    public function desa()
    {
        return $this->belongsTo(User::class, 'id_desa', 'id_desa');
    }

    public function perangkat()
    {
        return $this->belongsTo(PrangkatDesa::class, 'id_prangkat_desa');
    }
}
