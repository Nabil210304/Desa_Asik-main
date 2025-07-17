<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Support\Facades\Response;
use App\Mail\VerifikasiAdminDesa;
class super_admin_manege_user extends Controller
{
    //
    public function index(){
         $users = User::all(); // mengambil semua data dari tabel users
    return view('super_admin.manage_user', compact('users')); // kirim ke view (ganti 'nama_view' sesuai kebutuhan)
    }
       public function v_edit($id){
      $user = User::find($id); // ambil satu data user berdasarkan ID

    // Cek jika data tidak ditemukan (opsional tapi disarankan)
    if (!$user) {
        return redirect()->back()->with('error', 'User tidak ditemukan');
    }

    return view('super_admin.v_edit', compact('user'));
    }
    public function download_gambar($id){
  
    $user = User::findOrFail($id);

    if (!$user->sk_pengangkatan) {
        return abort(404, 'User belum mengupload gambar.');
    }

 $filePath = public_path('sk/' . $user->sk_pengangkatan); // contoh: 'uploads/ktp.png'

    if (File::exists($filePath)) {
        return response()->download($filePath);
    } else {
        return abort(404, 'File tidak ditemukan.');
    }
    }
    public function edit(Request $request,$id){
     $user = User::where('id_user', $id)->firstOrFail();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
        'nik' => 'required|string|max:255',
        'tgl_pelantikan' => 'required|date',
        'no_hp' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:255',
        'role' => 'required|integer',
        'nama_desa' => 'nullable|string|max:50',
        'kecamatan' => 'nullable|string|max:20',
        'kabupaten' => 'nullable|string|max:30',
        'status_verifikasi' => 'nullable|in:menunggu,diterima,ditolak',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->nik = $request->nik;
    $user->tgl_pelatikan = $request->tgl_pelantikan;
    $user->kode_pos = $request->kode_pos;
    $user->no_hp = $request->no_hp;
    $user->alamat = $request->alamat;
    $user->role = $request->role;
    $user->nama_desa = $request->nama_desa;
    $user->kecamatan = $request->kecamatan;
    $user->kabupaten = $request->kabupaten;

    $statusLama = $user->status_verifikasi;
    $statusBaru = $request->status_verifikasi;

    $user->status_verifikasi = $statusBaru;

    // Kirim email jika status berubah ke diterima atau ditolak
    if ($statusBaru !== $statusLama && in_array($statusBaru, ['diterima', 'ditolak'])) {
        $pesan = '';
        $judul = '';
        
        if ($statusBaru === 'diterima') {
            $judul = 'Pendaftaran Admin Desa Diterima';
            $pesan = "Selamat {$user->name}, pendaftaran Anda sebagai admin desa telah *DITERIMA*. Silakan login ke sistem menggunakan akun Anda.";
        } else {
            $judul = 'Pendaftaran Admin Desa Ditolak';
            $pesan = "Maaf {$user->name}, pendaftaran Anda sebagai admin desa *DITOLAK*. Silakan periksa kembali data Anda atau hubungi admin pusat.";
        }

        Mail::to($user->email)->send(new VerifikasiAdminDesa($judul, $pesan));
    }

    $user->save();

    return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
    }
}
