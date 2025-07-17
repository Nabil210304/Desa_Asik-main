<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WisataDesa;

class WisataController extends Controller
{
    public function index() {
        return view('wisata.wisata');
    }

    public function wisatadetail() {
        return view('wisata.wisatadetail');
    }

    public function simpanWisata(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_wisata'=> 'required|string',
            'deskripsi_wisata'=>'required|string',
            'foto_bacground_wisata' => 'required|image|mimes:jpg,jpeg,png',
            'Jenis_wisata' => 'required|string',
            'lokasi' => 'required|string',
            'akses' => 'required|string',
            'gambar_wisata'=> 'nullable|array',
        ]);

        // Foto UMKM utama
        $fotoBgWisataPath = $request->file('foto_bacground_wisata')->store('foto_wisata', 'public');

        // Gambar Wisata array
        $GambarWisataArr = [];
        if ($request->hasFile('gambar_wisata')) {
            foreach ($request->file('gambar_wisata') as $foto) {
                $GambarWisataArr[] = $foto->store('gambar_wisata', 'public');
            }
        }

     // Simpan ke DB
        WisataDesa::create([
        'nama_wisata'=> $request->nama_umkm,
        'deskripsi_wisata'=> $request->deskripsi_wisata,
        'foto_bacground_wisata' => $fotoBgWisataPath,
        'Jenis_wisata' => $request->Jenis_wisata,
        'lokasi' => $request->lokasi,
        'akses' => $request->akses,
        'gambar_wisata'=> $GambarWisataArr,
    ]);

    return redirect()->back()->with('success', 'Wisata berhasil disimpan!');
    }

}
