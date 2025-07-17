<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanUmkm extends Model
{
    protected $table = 'ulasan_umkm';
    public $timestamps = false;

    protected $fillable = ['id_umkm', 'id_user', 'rating', 'ulasan', 'created_at'];

    public function umkm()
    {
        return $this->belongsTo(UmkmDesa::class, 'id_umkm');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
