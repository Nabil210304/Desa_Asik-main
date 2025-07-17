<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class super_admin_manage_desa extends Controller
{
    //
    public function tambah(Request $request){
   
        $request->validate([
            'id_perangkat_desa' => 'required|string',
            'nama_desa' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
        ]);
        $id_desa = Str::uuid()->toString(); 


        DB::table('profil_desa')->insert([
            'id_desa' => $id_desa, // Bisa disesuaikan jika sudah punya ID-nya sendiri
            'id_prangkat_desa' => $request->id_perangkat_desa,
            'nama_desa' => $request->nama_desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
 'jumlah_laki_laki' => 0,
            'jumlah_perempuan' => 0,
            'jumlah_penduduk_kurang_10tahun' => '0',
            'jumlah_penduduk_kurang_20tahun' => '0',
            'jumlah_penduduk_kurang_50tahun' => '0',
            'jumlah_penduduk_lebih_50tahun' => '0',
            'total_pemasukan' => 0,

            'foto' => null,
            'foto2' => null,
            'foto3' => null,
            'foto4' => null,
            'foto5' => null,
            'foto6' => null,
            'provinsi' => null,
            'deskripsi' => null,
            'link_map' => null,
            'luas_km' => null,
            'kontak_desa' => null,
            'file_bukti_pemasukan' => null,
        ]);
        DB::table('prangkat_desa')->insert([
'id_desa' => $id_desa,
'nama'=>' ',
'jabatan'=>' ',
'periode'=>' ',


        ]);
        
             DB::table('users')
            ->where('id_user', $request->id_perangkat_desa)
            ->update(['id_desa' => $id_desa]);
 return redirect('/data_user')->with('success', 'Data user berhasil diperbarui.');
    }
}
