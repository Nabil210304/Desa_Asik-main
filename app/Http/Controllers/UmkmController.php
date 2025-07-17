<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UmkmDesa;
use App\Models\ProfilDesa;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;
 // kalau pakai Alert
 use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\File;
class UmkmController extends Controller
{
public function index(Request $request)
{
    $perPage = 3;
    $page = $request->query('page', 1);

    // Ambil query filter dari request
    $nama = $request->query('nama_umkm');
    $lokasi = $request->query('lokasi_umkm');
    $kategori = $request->query('kategori_umkm');

    // Query builder untuk filtering
    $query = UmkmDesa::query();

    if ($nama) {
        $query->where('nama_umkm', 'like', '%' . $nama . '%');
    }
    if ($lokasi) {
        $query->where('lokasi_umkm', 'like', '%' . $lokasi . '%');
    }
    if ($kategori) {
        $query->where('kategori_umkm', $kategori);
    }

    // Ambil data dulu sesuai filter tanpa eager loading foto
    $filteredUmkms = $query->get();

    // Ambil foto_banner dari tabel foto_umkms berdasarkan id_umkm (sebaiknya dengan relasi, tapi jika belum ada)
    $filteredUmkms = $filteredUmkms->map(function ($item) {
        $foto = DB::table('foto_umkms')->where('id', $item->id_umkm)->first();
        $item->foto_banner = $foto->foto_banner ?? null;
        return $item;
    })->filter(function ($item) {
        return !is_null($item->foto_banner); // hanya yang punya foto
    })->values();

    $total = $filteredUmkms->count();
    $umkms = $filteredUmkms->slice(($page - 1) * $perPage, $perPage)->values();
    $totalPages = ceil($total / $perPage);

    return view('umkm.umkm', [
        'umkms' => $umkms,
        'page' => $page,
        'totalPages' => $totalPages,
    ]);
}



 public function tambahUmkm() {
     $data_desa = ProfilDesa::all();
        return view('umkm.tambahUmkm',compact('data_desa'));
    }
    public function detail($id_umkm) {

        return view('umkm.umkmdetail');
    }

public function simpanUmkmBaru(Request $request)
{
    $request->validate([
        'nama_umkm' => 'required|string|max:255',
        'ringkasan_umkm' => 'required|string',
        'desa_id' => 'required',
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
        'id_desa' => $request->desa_id,
        'alamat_lengkap' => $request->alamat_lengkap,
        'nomor_izin_berusaha' => $request->nomor_izin_berusaha,
        'no_telepon' => $request->no_telepon,
        'kategori_umkm' => $request->kategori_umkm,
        'waktu_operasional' => $request->waktu,
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
            ]);

            $isFirst = false;
        }
    }

    // Simpan produk UMKM
    foreach ($request->produk_umkm as $produk) {
        DB::table('produk_umkms')->insert([
            'id' => $idUmkm,
            'produk' => $produk,

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

            ]);
        }
    } elseif (!empty($namaPenghargaan)) {
        foreach ($namaPenghargaan as $name) {
            if ($name) {
                DB::table('penghargaan_umkms')->insert([
                    'id' => $idUmkm,
                    'nama' => $name,
                    'foto' => null,

                ]);
            }
        }
    }

    Alert::success('Sukses', 'UMKM berhasil disimpan!');
    return redirect('/manipulasi');
}



    public function vdetail($id_umkm)
   {
      // Ambil data UMKM utama
        $umkm = DB::table('umkm_desa')->where('id_umkm', $id_umkm)->first();

        if (!$umkm) {
            abort(404, 'UMKM tidak ditemukan');
        }

        // Ambil ulasan berdasarkan id_umkm


        // Ambil penghargaan, foto, produk, dan foto ulasan berdasarkan id (yang berisi id_umkm)
        $penghargaan = DB::table('penghargaan_umkms')->where('id', $id_umkm)->get();

        $produk = DB::table('produk_umkms')->where('id', $id_umkm)->get();
        $fotoUlasan = DB::table('foto_ulasan_umkms')->where('id', $id_umkm)->get();
        $fotoProduk = DB::table('foto_umkms')
    ->where('id', $id_umkm)
    ->whereNotNull('foto_produk')
    ->pluck('foto_produk'); // Ambil array berisi semua foto produk

$fotoUtama = DB::table('foto_umkms')
    ->where('id', $id_umkm)
    ->whereNotNull('foto_banner')
    ->first(); // Ambil satu foto banner yang tidak null

// buat untuk ulasan
$ulasanDenganEmail = DB::table('ulasan_umkm')
    ->join('users', 'ulasan_umkm.id_user', '=', 'users.id_user')
    ->where('ulasan_umkm.id_umkm', $id_umkm)
    ->select(
        'ulasan_umkm.id', // <-- Tambahkan ini
        'ulasan_umkm.ulasan',
          'ulasan_umkm.photos',
        'ulasan_umkm.rating',
        'ulasan_umkm.created_at',
        'ulasan_umkm.class',
        'users.email',
        'users.alamat'
    )
    ->get();
;
$createdAtUserComments = DB::table('foto_ulasan_umkms')
    ->where('id', $id_umkm)
    ->where('id_user', Auth::user()->id_user)
    ->distinct()
    ->pluck('created_at');
$rating = DB::table('ulasan_umkm')
            ->where('id_umkm', $id_umkm)
            ->avg('rating');

            $jumlah_positive = DB::table('ulasan_umkm')
    ->where('id_umkm', $id_umkm)
    ->where('class', 'Positive')
    ->count();

$total_ulasan = DB::table('ulasan_umkm')
    ->where('id_umkm', $id_umkm)
    ->count();

$proporsi_positive = $total_ulasan > 0
    ? round(($jumlah_positive / $total_ulasan) * 100, 2)
    : 0;

// Ambil foto-foto ulasan user login berdasarkan created_at tersebut
$photos = DB::table('foto_ulasan_umkms')
    ->where('id', $id_umkm)
    ->where('id_user', Auth::user()->id_user)
    ->whereIn('created_at', $createdAtUserComments)
    ->get();


        // Kirim ke view
     return view('umkm.umkmdetail', [
    'umkm' => $umkm,
    'ulasan' => $ulasanDenganEmail,
    'penghargaan' => $penghargaan,

    'produk' => $produk,
    'fotoUlasan' => $fotoUlasan,
    'fotoUtama' => $fotoUtama,
    'fotos' => $photos,
    'fotoProduk' => $fotoProduk,
    'proporsi_positive'=>$proporsi_positive,
    'total_ulasan'=>$total_ulasan,
    'rating'=>$rating

]);

    }

    public function view_admin_list_umkm(){
         $data = DB::table('umkm_desa')->get(); // Ambil semua data dari tabel umks_desa
    return view('umkm.list_umkm', ['data' => $data]);

    }

    public function simpan_ulasan_umkm(Request $request){
        $validated = $request->validate([
            'id_umkm' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto_ulasan.*' => 'nullable|image|mimes:jpeg,png,jpg|max:20048', // max 2MB
        ]);

        // Inisialisasi variabel $photos sebagai array kosong
        $photos = [];

        if ($request->hasFile('foto_ulasan')) {
            foreach ($request->file('foto_ulasan') as $file) {
                if ($file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('foto_ulasan'), $filename);
                    $path = 'foto_ulasan/' . $filename;

                    $photos[] = [
                        'foto' => $path,
                        'created_at' => now()->toDateTimeString(),
                    ];
                }
            }
        }

        $response = Http::post('https://modeldesagogogopal.onrender.com/sentimen', [
            'ulasan' => $request->ulasan,
        ]);

        if ($response->successful()) {
            $dataSentimen = $response->json();
            $kelas=$dataSentimen['class'];

            // Simpan ulasan ke database
            DB::table('ulasan_umkm')->insert([
                'id_umkm' => $validated['id_umkm'],
                'rating' => $validated['rating'],
                'ulasan' => $validated['ulasan'],
                'id_user' =>$request->id_user,
                'class'=>$kelas,
                'photos' => json_encode($photos),
                'created_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
        } else {
            return redirect()->back()->with('error', 'Gagal mendapatkan hasil sentimen dari API Flask.');
        }
    }


public function update(Request $request, $idUmkm)
{
    // 1. Validasi Input (dapat disesuaikan sesuai kebutuhan)
    $request->validate([
        'nama_umkm' => 'required|string|max:255',
        'ringkasan_umkm' => 'required|string',
        'desa_id' => 'required',
        'alamat_lengkap' => 'required|string',
        'nomor_izin_berusaha' => 'required|string',
        'no_telepon' => 'required|string',
        'kategori_umkm' => 'required|string',
        'waktu' => 'required',
        'map' => 'required',
        'produk_umkm.*' => 'nullable|string',
        'foto_produk.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'foto_penghargaan.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'nama_penghargaan.*' => 'nullable|string',
        'jenis_sosmed.*' => 'nullable|string',
        'link_sosmed.*' => 'nullable|string',
    ]);

    try {
        // Mulai transaksi database untuk memastikan semua query berhasil
        DB::beginTransaction();

        // === KUMPULKAN SEMUA FILE LAMA UNTUK DIHAPUS DARI SERVER NANTI ===
        $old_foto_produk = DB::table('foto_umkms')->where('id', $idUmkm)->pluck('foto_produk');
        $old_foto_penghargaan = DB::table('penghargaan_umkms')->where('id', $idUmkm)->pluck('foto');

        // === PROSES DATA SOSIAL MEDIA ===
        $sosmed = [
            'facebook' => null, 'instagram' => null,
            'tiktok' => null, 'twitter' => null,
        ];
        if ($request->jenis_sosmed) {
            foreach ($request->jenis_sosmed as $index => $jenis) {
                if (isset($request->link_sosmed[$index])) {
                    $sosmed[$jenis] = $request->link_sosmed[$index];
                }
            }
        }

        // === UPDATE DATA UTAMA UMKM DI TABEL umkm_desa ===
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
            'sosmed_facebook' => $sosmed['facebook'],
            'sosmed_instagram' => $sosmed['instagram'],
            'sosmed_tiktok' => $sosmed['tiktok'],
            'sosmed_twitter' => $sosmed['twitter'],

        ]);

        // === HAPUS DAN BUAT ULANG DATA RELASI ===

        // 2. Produk UMKM
        DB::table('produk_umkms')->where('id', $idUmkm)->delete();
        if ($request->has('produk_umkm')) {
            foreach ($request->produk_umkm as $produk) {
                if (!empty($produk)) {
                    DB::table('produk_umkms')->insert([
                        'id' => $idUmkm,
                        'produk' => $produk,

                    ]);
                }
            }
        }

        // 3. Foto Produk
        DB::table('foto_umkms')->where('id', $idUmkm)->delete();
        if ($request->hasFile('foto_produk')) {
             $isFirst = true;
            foreach ($request->file('foto_produk') as $file) {
                 if ($file && $file->isValid()) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('foto_umkm'), $filename);
                    $path = 'foto_umkm/' . $filename;

                    DB::table('foto_umkms')->insert([
                        'id' => $idUmkm,
                        // Foto pertama dijadikan foto_banner
                        'foto_banner' => $isFirst ? $path : null,
                        'foto_produk' => $path,

                    ]);
                    $isFirst = false;
                }
            }
        }

        // 4. Penghargaan
        DB::table('penghargaan_umkms')->where('id', $idUmkm)->delete();
        if ($request->has('nama_penghargaan')) {
            foreach ($request->nama_penghargaan as $index => $nama) {
                 if (!empty($nama)) {
                    $path = null;
                    if ($request->hasFile('foto_penghargaan') && isset($request->file('foto_penghargaan')[$index])) {
                        $file = $request->file('foto_penghargaan')[$index];
                         if ($file && $file->isValid()) {
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('foto_penghargaan'), $filename);
                            $path = 'foto_penghargaan/' . $filename;
                        }
                    }
                    DB::table('penghargaan_umkms')->insert([
                        'id' => $idUmkm,
                        'penghargaan' => $nama,
                        'foto' => $path,

                    ]);
                }
            }
        }

        // Jika semua query berhasil, commit transaksi
        DB::commit();

        // === HAPUS FILE-FILE LAMA DARI SERVER SETELAH DB SUKSES DI-UPDATE ===
        foreach ($old_foto_produk as $file_path) {
            if ($file_path && File::exists(public_path($file_path))) {
                File::delete(public_path($file_path));
            }
        }
        foreach ($old_foto_penghargaan as $file_path) {
            if ($file_path && File::exists(public_path($file_path))) {
                File::delete(public_path($file_path));
            }
        }

        Alert::success('Sukses', 'Data UMKM berhasil diperbarui!');
        return redirect('/manipulasi'); // Arahkan ke halaman daftar UMKM

    } catch (\Exception $e) {
        // Jika terjadi error, batalkan semua query
        DB::rollBack();

        // Tampilkan pesan error
        Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        return redirect()->back();
    }
}

public function cari(Request $request)
{
    $perPage = 3;
    $page = $request->query('page', 1);
    $resultUmkms = collect();

    $hasUserId = $request->filled('send_user_id');
    $hasSearch = $request->filled('nama_umkm');

    // ========== 1. Jika ada send_user_id (ambil rekomendasi dari Flask) ==========
    if ($hasUserId) {
        $ulasanData = DB::table('ulasan_umkm')
            ->where('id_user', $request->send_user_id)
            ->where('rating', '>=', 3)
            ->get();

        $idUmkmList = $ulasanData->pluck('id_umkm')->unique()->toArray();

        if (!empty($idUmkmList)) {
            $ulasanData = DB::table('produk_umkms')
                ->join('umkm_desa', 'produk_umkms.id', '=', 'umkm_desa.id_umkm')
                ->whereIn('produk_umkms.id', $idUmkmList)
                ->select('umkm_desa.id_umkm', 'umkm_desa.nama_umkm', 'umkm_desa.ringkasan_umkm', 'produk_umkms.produk')
                ->get();

            // Kirim ke Flask
            $umkmData = DB::table('produk_umkms')
                ->join('umkm_desa', 'produk_umkms.id', '=', 'umkm_desa.id_umkm')
                ->select('umkm_desa.nama_umkm', 'umkm_desa.id_umkm', 'umkm_desa.ringkasan_umkm', 'produk_umkms.produk')
                ->get();

            $response = Http::post('https://modeldesagogogopal.onrender.com/terima-data', [
                'ulasan_data' => $ulasanData,
                'umkmData' => $umkmData
            ]);

            $json = $response->json();

            $idRekomendasi = collect($json['rekomendasi'])->flatMap(function ($item) {
                return collect($item['rekomendasi_umkm'])->pluck('id_umkm');
            })->unique()->toArray();

            $rekomUmkm = UmkmDesa::whereIn('id_umkm', $idRekomendasi)->get();
            $rekomUmkm = $rekomUmkm->map(function ($item) {
                $foto = DB::table('foto_umkms')->where('id', $item->id_umkm)->first();
                $item->foto_banner = $foto->foto_banner ?? null;
                return $item;
            })->filter(fn($item) => !is_null($item->foto_banner));

            $resultUmkms = $resultUmkms->merge($rekomUmkm);
        }
    }

    // ========== 2. Jika ada nama_umkm (cari langsung) ==========
    if ($hasSearch) {
        $query = $request->input('nama_umkm');
        $searchUmkm = DB::table('umkm_desa')
            ->where('nama_umkm', 'like', '%' . $query . '%')
            ->get()
            ->map(function ($item) {
                $foto = DB::table('foto_umkms')->where('id', $item->id_umkm)->first();
                $item->foto_banner = $foto->foto_banner ?? null;
                return $item;
            })
            ->filter(fn($item) => !is_null($item->foto_banner));

        $resultUmkms = $resultUmkms->merge($searchUmkm);
    }

    // ========== 3. Gabungkan hasil dan hilangkan duplikat berdasarkan id_umkm ==========
    $resultUmkms = $resultUmkms->unique('id_umkm')->values();

    $total = $resultUmkms->count();
    $totalPages = ceil($total / $perPage);
    $umkms = $resultUmkms;

    return view('umkm.Search_umkm', [
        'umkms' => $umkms,

    ]);
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
    return view('umkm.vedit', compact(
        'umkm',
        'penghargaan',
        'produk',
        'data_desa',
        'fotoProduk',
        'fotoUtama'
    ));
}

public function destroy($idUmkm)
    {
        try {
            // Mulai transaksi database untuk memastikan semua proses berjalan atau tidak sama sekali
            DB::beginTransaction();

            // 1. Kumpulkan semua path file gambar yang akan dihapus dari server
            $foto_produk = DB::table('foto_umkms')->where('id', $idUmkm)->pluck('foto_produk');
            $foto_penghargaan = DB::table('penghargaan_umkms')->where('id', $idUmkm)->pluck('foto');

            // Ambil juga foto dari ulasan (disimpan dalam format JSON)
            $ulasan_photos_json = DB::table('ulasan_umkm')->where('id_umkm', $idUmkm)->pluck('photos');

            // 2. Hapus semua data dari database yang terkait dengan id_umkm
            DB::table('produk_umkms')->where('id', $idUmkm)->delete();
            DB::table('foto_umkms')->where('id', $idUmkm)->delete();
            DB::table('penghargaan_umkms')->where('id', $idUmkm)->delete();
            DB::table('ulasan_umkm')->where('id_umkm', $idUmkm)->delete();

            // Hapus data utama UMKM di akhir
            DB::table('umkm_desa')->where('id_umkm', $idUmkm)->delete();

            // 3. Jika semua query database berhasil, commit transaksi
            DB::commit();

            // 4. Hapus file fisik dari server setelah transaksi berhasil
            foreach ($foto_produk as $path) {
                if ($path && File::exists(public_path($path))) {
                    File::delete(public_path($path));
                }
            }
            foreach ($foto_penghargaan as $path) {
                if ($path && File::exists(public_path($path))) {
                    File::delete(public_path($path));
                }
            }
            foreach ($ulasan_photos_json as $json_string) {
                $photos = json_decode($json_string, true);
                if (is_array($photos)) {
                    foreach ($photos as $photo) {
                        if (isset($photo['foto']) && File::exists(public_path($photo['foto']))) {
                             File::delete(public_path($photo['foto']));
                        }
                    }
                }
            }

            Alert::success('Sukses', 'UMKM berhasil dihapus!');
            return redirect()->back();

        } catch (\Exception $e) {
            // Jika ada kesalahan, batalkan semua perubahan di database
            DB::rollBack();

            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus UMKM: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
