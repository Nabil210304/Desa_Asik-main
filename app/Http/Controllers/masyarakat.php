<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class masyarakat extends Controller
{
    //
    public function  detail_desa($id_perangkat_desa)
    {
         
    $user = \DB::table('users')
        ->where('id_user', $id_perangkat_desa)
        ->first();

    // Cek kalau data user ditemukan
    if ($user) {
          $id_desa = $user->id_desa;
         
            // Ambil data profil_desa berdasarkan id_prangkat_desa
        $profil = DB::table('profil_desa')
            ->where('id_desa', $id_desa)
            ->first();
$pemasukan=DB::table('pemasukans')
            ->where('id_desa', $id_desa)
            ->get();
$pengeluaran=DB::table('pengeluaran_desa')
            ->where('id_desa',  $id_desa)
            ->get(); // Ambil id_desa dari hasil query
            $totalPemasukan = $pemasukan->sum('jumlah'); // Asumsinya kolom nominal adalah 'jumlah'
$semua = DB::table('pengeluaran_desa')
    ->where('id_desa',  $id_desa)
    ->select('jumlah', 'status')
    ->get();

$normal = $semua->where('status', '✅ Aman')->pluck('jumlah')->all();
// data normal
$outliers = $semua->where('status', '🧐 Perlu Diaudit')->pluck('jumlah')->all(); // data audit

$totalPengeluaran = $pengeluaran->sum('jumlah'); // Ganti 'jumlah' kalau nama kolom beda
$semuaa = DB::table('pengeluaran_desa')
    ->where('id_desa', $id_desa)
    ->select('jumlah', 'status', 'bulan', 'tahun')
    ->orderBy('tahun')
    ->orderBy('bulan')
    ->get();
// Hitung saldo
$saldo = $totalPemasukan - $totalPengeluaran;
            
    return view('super_admin.desa_saya',compact('profil','pemasukan','pengeluaran','totalPemasukan',
    'totalPengeluaran',
    'saldo',
    'normal',
    'semuaa',
    'outliers'
));
    } else {
        return response()->json([
                'message' => 'Data profil desa tidak ditemukan.'
            ], 404);
    }

    

        // Jika ditemukan
    }
   
}
