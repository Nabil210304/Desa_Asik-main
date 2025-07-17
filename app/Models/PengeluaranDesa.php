<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranDesa extends Model
{
    protected $table = 'pengeluaran_desa';
    public $timestamps = false;

    protected $fillable = [
        'id', 'id_desa', 'tipe', 'nama', 'kategori', 'jumlah', 'deskripsi',
        'bulan', 'tahun', 'kuitansi', 'status'
    ];

    public function desa()
    {
        return $this->belongsTo(User::class, 'id_desa', 'id_desa');
    }

}
