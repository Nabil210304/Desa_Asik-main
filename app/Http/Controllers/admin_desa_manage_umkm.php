<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\UmkmDesa;
use App\Models\ProfilDesa;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;
 // kalau pakai Alert
 use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\File;
class admin_desa_manage_umkm extends Controller
{
    //
        public function index($id)
{ $umkm = DB::table('umkm_desa')->where('id_desa', $id)->get();

    return view('admin_desa.umkm_saya', compact('umkm','id'));
}
public  function tambah($id){
 return view('admin_desa.tambah_umkm', compact('id'));
}

public function simpanUmkmBaru(Request $request)
{
    
    $request->validate([
        'nama_umkm' => 'required|string|max:255',
        'ringkasan_umkm' => 'required|string',
        
        'alamat_lengkap' => 'required|string',
        'nomor_izin_berusaha' => 'required|string',
        'no_telepon' => 'required|string',
        'kategori_umkm' => 'required|string',

        'produk_umkm' => 'required|array',
        'produk_umkm.*' => 'required|string',

        'foto_umkm' => 'nullable|array',
        'foto_umkm.*' => 'image|mimes:jpeg,jpg,png|max:2048',

        'foto_penghargaan' => 'nullable|array',
        'foto_penghargaan.*' => 'image|mimes:jpeg,jpg,png|max:2048',

        'nama_penghargaan' => 'nullable|array',
        'nama_penghargaan.*' => 'nullable|string',
        'waktu' => 'required',

        'sosmed_umkm' => 'nullable|array',
        'sosmed_umkm.*.platform' => 'nullable|string',
        'sosmed_umkm.*.url' => 'nullable|url',

        'tambah_penjualan_produk' => 'nullable|array',
        'tambah_penjualan_produk.*' => 'nullable|string',

        'jumlah_penjualan_perbulan' => 'nullable|array',
        'jumlah_penjualan_perbulan.*' => 'nullable|numeric',
        'kategori_umkm'=>'required',
         'map'=>'required'
    ]);

    // Siapkan data sosial media default
    $sosmed = [
        'facebook' => null,
        'instagram' => null,
        'tiktok' => null,
        'twitter' => null,
    ];

    // Isi sosial media jika ada input
    if ($request->has('sosmed_umkm')) {
        foreach ($request->sosmed_umkm as $item) {
            $platform = strtolower($item['platform']);
            if (array_key_exists($platform, $sosmed)) {
                $sosmed[$platform] = $item['url'];
            }
        }
    }

    // Buat ID UMKM unik
    $idUmkm = 'UMKM-' . now()->format('Ymd') . '-' . Str::random(8);

    // Simpan data utama UMKM
    $umkmId = DB::table('umkm_desa')->insertGetId([
        'id_umkm' => $idUmkm,
        'nama_umkm' => $request->nama_umkm,
        'ringkasan_umkm' => $request->ringkasan_umkm,
        'id_desa' => $request->id_desa,
        'alamat_lengkap' => $request->alamat_lengkap,
        'nomor_izin_berusaha' => $request->nomor_izin_berusaha,
        'no_telepon' => $request->no_telepon,
        'kategori_umkm' => $request->kategori_umkm,
        'waktu_operasional' => $request->waktu,
           'kategori_umkm' => $request->kategori_umkm,
        'map' => $request->map,

        'sosmed_facebook' => $sosmed['facebook'],
        'sosmed_instagram' => $sosmed['instagram'],
        'sosmed_tiktok' => $sosmed['tiktok'],
        'sosmed_twitter' => $sosmed['twitter'],
    ]);

    // Simpan foto UMKM
    $isFirst = true;
    if ($request->hasFile('foto_umkm')) {
        foreach ($request->file('foto_umkm') as $file) {
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_umkm'), $filename);
            $path = 'foto_umkm/' . $filename;

            DB::table('foto_umkms')->insert([
                'id' => $idUmkm,
                'foto_banner' => $isFirst ? $path : null,
                'foto_produk' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $isFirst = false;
        }
    }

    // Simpan produk UMKM
    foreach ($request->produk_umkm as $produk) {
        DB::table('produk_umkms')->insert([
            'id' => $idUmkm,
            'produk' => $produk,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Simpan penghargaan UMKM dan foto penghargaan
    $fotoPenghargaan = $request->file('foto_penghargaan', []);
    $namaPenghargaan = $request->input('nama_penghargaan', []);

    if (!empty($fotoPenghargaan)) {
        foreach ($fotoPenghargaan as $index => $file) {
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_penghargaan'), $filename);
            $path = 'foto_penghargaan/' . $filename;

            DB::table('penghargaan_umkms')->insert([
                'id' => $idUmkm,
                'penghargaan' => $namaPenghargaan[$index] ?? null,
                'foto' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    } elseif (!empty($namaPenghargaan)) {
        foreach ($namaPenghargaan as $name) {
            if ($name) {
                DB::table('penghargaan_umkms')->insert([
                    'id' => $idUmkm,
                    'nama' => $name,
                    'foto' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

   
     return redirect()->back()->with('success', 'UMKM berhasil disimpan!');
}
public function update(Request $request, $idUmkm)
{
    // Validasi dasar bisa ditambahkan di sini

    // === UPDATE DATA UTAMA UMKM ===
    DB::table('umkm_desa')->where('id_umkm', $idUmkm)->update([
        'nama_umkm' => $request->nama_umkm,
        'ringkasan_umkm' => $request->ringkasan_umkm,
        'id_desa' => $request->desa_id,
        'alamat_lengkap' => $request->alamat_lengkap,
        'nomor_izin_berusaha' => $request->nomor_izin_berusaha,
        'no_telepon' => $request->no_telepon,
        'kategori_umkm' => $request->kategori_umkm,
        'waktu_operasional' => $request->waktu,
        'map' => $request->map,
        'sosmed_facebook' => $request->sosmed['facebook'] ?? null,
        'sosmed_instagram' => $request->sosmed['instagram'] ?? null,
        'sosmed_tiktok' => $request->sosmed['tiktok'] ?? null,
        'sosmed_twitter' => $request->sosmed['twitter'] ?? null,
    
    ]);

    // === UPDATE FOTO UMKM (jika diganti) ===
    if ($request->hasFile('foto_umkm')) {
        foreach ($request->file('foto_umkm') as $index => $file) {
            $idFoto = $request->id_foto_umkm[$index] ?? null;
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_umkm'), $filename);
            $path = 'foto_umkm/' . $filename;

            if ($idFoto) {
                $old = DB::table('foto_umkms')->where('id_foto', $idFoto)->first();
                if ($old && $old->foto_produk && File::exists(public_path($old->foto_produk))) {
                    File::delete(public_path($old->foto_produk));
                }

                DB::table('foto_umkms')->where('id_foto', $idFoto)->update([
                    'foto_produk' => $path,
                    'updated_at' => now(),
                ]);
            }
        }
    }

    // === UPDATE PENGHARGAAN (jika ada) ===
    $fotoPenghargaan = $request->file('foto_penghargaan', []);
    $namaPenghargaan = $request->input('nama_penghargaan', []);
    $idPenghargaan = $request->input('id_penghargaan_umkm', []);

    foreach ($namaPenghargaan as $index => $nama) {
        $id = $idPenghargaan[$index] ?? null;
        $data = [
            'penghargaan' => $nama,
            'updated_at' => now(),
        ];

        // Ganti foto jika dikirim
        if (!empty($fotoPenghargaan[$index])) {
            $file = $fotoPenghargaan[$index];
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_penghargaan'), $filename);
            $path = 'foto_penghargaan/' . $filename;

            if ($id) {
                $old = DB::table('penghargaan_umkms')->where('id_penghargaan', $id)->first();
                if ($old && $old->foto && File::exists(public_path($old->foto))) {
                    File::delete(public_path($old->foto));
                }
            }

            $data['foto'] = $path;
        }

        if ($id) {
            DB::table('penghargaan_umkms')->where('id_penghargaan', $id)->update($data);
        } else {
            DB::table('penghargaan_umkms')->insert(array_merge($data, [
                'id' => $idUmkm,
                'created_at' => now(),
            ]));
        }
    }
  return redirect()->back()->with('success', 'UMKM berhasil diupadte');
}

public function destroy($idUmkm)
{
    try {
        DB::beginTransaction();

        // === HAPUS FOTO UMKM ===
        $fotoUmkm = DB::table('foto_umkms')->where('id', $idUmkm)->get();
        foreach ($fotoUmkm as $foto) {
            if ($foto->foto_produk && File::exists(public_path($foto->foto_produk))) {
                File::delete(public_path($foto->foto_produk));
            }
        }
        DB::table('foto_umkms')->where('id', $idUmkm)->delete();

        // === HAPUS FOTO PENGHARGAAN ===
        $penghargaan = DB::table('penghargaan_umkms')->where('id', $idUmkm)->get();
        foreach ($penghargaan as $item) {
            if ($item->foto && File::exists(public_path($item->foto))) {
                File::delete(public_path($item->foto));
            }
        }
        DB::table('penghargaan_umkms')->where('id', $idUmkm)->delete();

        // === HAPUS PRODUK UMKM ===
        DB::table('produk_umkms')->where('id', $idUmkm)->delete();

        // === HAPUS ULASAN UMKM ===
        DB::table('ulasan_umkm')->where('id_umkm', $idUmkm)->delete();

        // === HAPUS DATA UTAMA UMKM ===
        DB::table('umkm_desa')->where('id_umkm', $idUmkm)->delete();

        DB::commit();

        // === ALERT BERHASIL ===
       return redirect()->back()->with('success', 'UMKM berhasil di hapus');

    } catch (\Exception $e) {
        DB::rollBack();

        // === ALERT GAGAL ===
        Alert::error('Gagal', 'Terjadi kesalahan saat menghapus UMKM!');
        return redirect()->back()->with('error', $e->getMessage());
    }
}

public function vedit($id_umkm)
{
    $data_desa = ProfilDesa::all();
    // Ambil data utama UMKM berdasarkan id_umkm
    $umkm = DB::table('umkm_desa')->where('id_umkm', $id_umkm)->first();

    if (!$umkm) {
        abort(404, 'UMKM tidak ditemukan');
    }

    // Ambil data lainnya berdasarkan id_umkm (bukan 'id' ya)
    $penghargaan = DB::table('penghargaan_umkms')->where('id', $id_umkm)->get();
    $produk = DB::table('produk_umkms')->where('id', $id_umkm)->get();
   
    $fotoProduk = DB::table('foto_umkms')
        ->where('id', $id_umkm)
        ->whereNotNull('foto_produk')
        ->pluck('foto_produk');

    $fotoUtama = DB::table('foto_umkms')
        ->where('id', $id_umkm)
        ->whereNotNull('foto_banner')
        ->first();

    // Kirim semua data ke view
    return view('admin_desa.edit_umkm', compact(
        'umkm',
        'penghargaan',
        'produk',
        'data_desa',
        'fotoProduk',
        'id_umkm',
        'fotoUtama'
    ));
}

}
