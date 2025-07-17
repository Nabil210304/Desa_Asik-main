<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanBerita extends Model
{
    protected $table = 'ulasan_berita';
    public $timestamps = false;

    protected $fillable = ['id_berita', 'id_user', 'ulasan', 'created_at'];

    public function berita()
    {
        return $this->belongsTo(BeritaDesa::class, 'id_berita');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
