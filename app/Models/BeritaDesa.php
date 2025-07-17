<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaDesa extends Model
{
    protected $table = 'berita_desa';
    protected $primaryKey = 'id_berita';
    public $timestamps = false;

    protected $fillable = ['id_berita', 'id_desa', 'foto', 'deskripsi', 'judul', 'created_at','referensi'];

   public function desa()
    {
      return $this->belongsTo(User::class, 'id_desa', 'id_desa');
    }


    public function ulasan()
    {
        return $this->hasMany(UlasanBerita::class, 'id_berita');
    }
}
