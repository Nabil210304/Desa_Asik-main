<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeritaDesa;
use \App\Models\UlasanBerita;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
class admin_desa_manage_berita extends Controller
{
    //
     public function index($id)
{ $beritas = DB::table('berita_desa')->where('id_desa', $id)->get();

    return view('admin_desa.berita_saya', compact('beritas','id'));
}
  public function vtambah() {


        return view('admin_desa.v_tambah_berita');
    }
    public function simpanBerita(Request $request)
    {

        // Validasi input
       $request->validate([
         'judul' => 'required|string|max:255',
         'isi_berita' => 'required|string',
         'referensi' => 'required|array',
         'foto' => 'required|image',
        ]);

        $path = null;
         if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('berita', 'public');
        }

        // Simpan berita
        BeritaDesa::create([
            //'id_desa' => auth()->user()->id_desa, // Pastikan user login punya id_desa
            'id_desa' => $request->id_desa,
            'judul' => $request->judul,
            'deskripsi' => $request->isi_berita,
            'foto' => $path,
            'created_at' => now(),
            'referensi' => implode(', ', $request->referensi), // Convert array to string
        ]);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan!');
    }
    public function editBerita($id)
{
    $berita = BeritaDesa::findOrFail($id);
    return view('admin_desa.editberita', compact('berita'));
}

}
