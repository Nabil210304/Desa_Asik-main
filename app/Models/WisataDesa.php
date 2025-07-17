<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WisataDesa extends Model
{
    protected $table = 'Wisata_Desa';
    protected $primaryKey = 'id_wisata';
    public $timestamps = false;

    protected $fillable = ['id_desa','nama_wisata','deskripsi_wisata','foto_bacground_wisata','Jenis_wisata','lokasi','akses','gambar_wisata'];

   public function desa()
    {
      return $this->belongsTo(User::class, 'id_desa', 'id_desa');
    }
}
