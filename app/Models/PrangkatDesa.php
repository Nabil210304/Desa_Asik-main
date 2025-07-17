<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrangkatDesa extends Model
{
    protected $table = 'prangkat_desa';
    public $timestamps = false;

    protected $fillable = ['id', 'id_desa', 'nama', 'jabatan', 'periode', 'link_ig', 'email'];

    public function desa()
    {
        return $this->belongsTo(User::class, 'id_desa', 'id_desa');
    }

}
