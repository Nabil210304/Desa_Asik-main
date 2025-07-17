<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProfilDesa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ProfilDesaController extends Controller
{



    public function index(Request $request) {
         $datas = ProfilDesa::all();
     $perPage = 3; // Jumlah berita per halaman
    $page = $request->query('page', 1);

    // Ambil semua berita dulu

    // Misalnya kamu mau nambah ringkasan/cuplikan isi
    $datas = $datas->map(function ($item) {
        $item->deskripsi = Str::limit(strip_tags($item->deskripsi), 100); // Buat cuplikan 100 karakter
        return $item;
    });

    $total = $datas->count();
    $currentItems = $datas->slice(($page - 1) * $perPage, $perPage)->values();

    $paginator = new LengthAwarePaginator(
        $currentItems,
        $total,
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );
    $listKabupaten = ProfilDesa::select('kabupaten')->distinct()->pluck('kabupaten');
    $listKecamatan = ProfilDesa::select('kecamatan')->distinct()->pluck('kecamatan');

return view('profildesa.profildesa', [
    'dataDesa' => $paginator,
    'listKabupaten' => $listKabupaten,
    'listKecamatan' => $listKecamatan,
]);
    }
public function filterDesa(Request $request)
{
  // Ambil daftar kabupaten dan kecamatan unik untuk dropdown
    $listKabupaten = ProfilDesa::select('kabupaten')->distinct()->pluck('kabupaten');
    $listKecamatan = ProfilDesa::select('kecamatan')->distinct()->pluck('kecamatan');

    // Query dasar untuk data desa
    $query = ProfilDesa::query();

    // Filter berdasarkan kabupaten kalau ada inputnya
    if ($request->filled('kabupaten')) {
        $query->where('kabupaten', $request->kabupaten);
    }

    // Filter berdasarkan kecamatan kalau ada inputnya
    if ($request->filled('kecamatan')) {
        $query->where('kecamatan', $request->kecamatan);
    }

    // Ambil semua data yang sudah difilter
    $datas = $query->get();

    // Buat cuplikan isi/deskripsi
    $datas = $datas->map(function ($item) {
        $item->deskripsi = \Str::limit(strip_tags($item->deskripsi), 100);
        return $item;
    });

    // Manual pagination
    $perPage = 3;
    $page = $request->query('page', 1);
    $total = $datas->count();
    $currentItems = $datas->slice(($page - 1) * $perPage, $perPage)->values();

    $paginator = new LengthAwarePaginator(
        $currentItems,
        $total,
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    // Kirim ke view
    return view('profildesa.filter_desa', [
        'dataDesa' => $paginator,
        'listKabupaten' => $listKabupaten,
        'listKecamatan' => $listKecamatan,
    ]);
}
public function cari(Request $request)
{
    $request->validate([

        'nama' => 'required|string',

    ]);

    $keyword = $request->query('nama', '');
    $perPage = 3; // samakan dengan index
    $page = $request->query('page', 1);

    // Cari berita yang judulnya mirip keyword, ambil dulu semua hasilnya (karena mau bikin ringkasan)
    $datas = ProfilDesa::where('nama_desa', 'like', "%{$keyword}%")

        ->get();

    // Buat ringkasan isi berita seperti di index
     $datas = $datas->map(function ($item) {
        $item->deskripsi = \Str::limit(strip_tags($item->deskripsi), 100);
        return $item;
    });


    $total = $datas->count();

    // Slice data sesuai halaman
    $currentItems = $datas->slice(($page - 1) * $perPage, $perPage)->values();

    // Buat paginator manual
    $paginator = new LengthAwarePaginator(
        $currentItems,
        $total,
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );
  return view('profildesa.filter_desa', [
        'dataDesa' => $paginator,

    ]);
}


 public function filter_berita_desa(Request $request)
    {
     $idDesa = $request->query('id_desa');
    $tahun = $request->query('tahun');

    $perPage = 3;
    $page = $request->query('page', 1);

    // Ambil semua berita yang cocok
    $query = BeritaDesa::query();

    if ($idDesa) {
        $query->where('id_desa', $idDesa);

    }

    if ($tahun) {
        $query->whereYear('created_at', $tahun);
    }


    $beritaSemua = $query->orderByDesc('created_at')->get();

    // Ringkasan isi berita
    $beritaSemua = $beritaSemua->map(function ($item) {
        $item->ringkasan = Str::limit(strip_tags($item->isi), 100);
        return $item;
    });

    $total = $beritaSemua->count();

    // Slice sesuai halaman
    $currentItems = $beritaSemua->slice(($page - 1) * $perPage, $perPage)->values();

    // Buat paginator
    $paginator = new LengthAwarePaginator(
        $currentItems,
        $total,
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    // Kirim ke view
    return view('berita.berita', ['beritas' => $paginator]);
    }




  public function tabel() {
 $datas = ProfilDesa::all();

        return view('profildesa.tabeldesa',compact('datas'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $allDesa = $this->getAllDesa();

        $filtered = array_filter($allDesa, function ($desa) use ($query) {
            return stripos($desa['name'], $query) !== false;
        });

        return view('profildesa.profildesa', ['dataDesa' => $filtered]);
    }
public function detail_desa($id_perangkat_desa)
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
    private function getAllDesa()
    {
        return [
            [
                'name' => 'Desa Ciputri',
                'desc' => 'Temukan berbagai desa dengan pesona khasnya...',
                'image' => 'https://storage.googleapis.com/a1aa/image/ub2EA4LsBTbNwmUsE92r-j03EdrAaTKm5I1eYjv3USQ.jpg',
            ],
            [
                'name' => 'Desa Balamoa',
                'desc' => 'Desa ini terkenal dengan kegiatan gotong royong...',
                'image' => 'https://storage.googleapis.com/a1aa/image/d-5LEhTV24q-tNEE_XJARHidZRyEKw_ULXYYz1sWiBM.jpg',
            ],
            [
                'name' => 'Desa Pangkeh',
                'desc' => 'Desa ini memiliki berbagai produk kerajinan tangan...',
                'image' => 'https://storage.googleapis.com/a1aa/image/ChYA6kQyiiJDzSeSaF-zFvtHIUBkVcLbZNcSXODqkbs.jpg',
            ],
        ];
    }

    public function detail() {
        return view('profildesa.profildetail');
    }

    public function tutorial() {
        return view('profildesa.tutorial');
    }
      public function tambahDesa() {
         $usersMenunggu = User::where('status_verifikasi', 'menunggu')->get();


        return view('profildesa.tambahdesa', compact('usersMenunggu'));
    }


    public function simpanDesa(Request $request)
    {
            // Validasi input
            $request->validate([
                'nama_desa'=> 'nullable|string',
                'foto' => 'nullable|array',
                'provinsi' => 'required|string',
                'kabupaten' => 'required|string',
                'kecamatan' => 'required|string',
                'deskripsi' => 'nullable|string',
                'link_map' => 'nullable|url',
                'luas_km' => 'nullable|numeric',
                'kontak_desa' => 'nullable|string',
                'jumlah_laki_laki' => 'required|integer',
                'jumlah_perempuan' => 'required|integer',
                'jumlah_penduduk_kurang_10tahun' => 'required|integer',
                'jumlah_penduduk_kurang_20tahun' => 'required|integer',
                'jumlah_penduduk_kurang_50tahun' => 'required|integer',
                'jumlah_penduduk_lebih_50tahun' => 'required|integer',
                'nama_kepala_desa' => 'nullable|string|max:255',
                'nama_wakil_desa' => 'nullable|string|max:255',
                'foto_kepala_desa' => 'nullable|image',
                'foto_wakil_desa' => 'nullable|image',
                'sosmed_kepala.platform' => 'nullable|string',
                'sosmed_kepala.url' => 'nullable|url',
                'sosmed_wakil.platform' => 'nullable|string',
                'sosmed_wakil.url' => 'nullable|url',
            ]);

            // Upload foto jika ada
            $fotoArr = [];

            if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
            $path = $foto->store('foto_desa', 'public');
            $fotoArr[] = $path;
                }
            }

             // Upload foto kepala desa
            $fotoKepala = null;
            if ($request->hasFile('foto_kepala_desa')) {
            $fotoKepala = $request->file('foto_kepala_desa')->store('foto_desa', 'public');
            }

            // Upload foto wakil desa
            $fotoWakil = null;
            if ($request->hasFile('foto_wakil_desa')) {
            $fotoWakil = $request->file('foto_wakil_desa')->store('foto_desa', 'public');
            }

            // Proses array media sosial kepala desa
            $kepalaArr = collect($request->input('sosmed_kepala', []))
                ->mapWithKeys(fn($item) => [$item['platform'] => $item['url']])
                ->toArray();

            // Proses array media sosial wakil desa
            $wakilArr  = collect($request->input('sosmed_wakil', []))
                ->mapWithKeys(fn($item) => [$item['platform'] => $item['url']])
                ->toArray();

            // Simpan ke database
            ProfilDesa::create([
                'id_desa' => null,
                'nama_desa'=>$request->nama_desa,
                'foto' => json_encode($fotoArr),
                'foto_kepala_desa' => $fotoKepala,
                'foto_wakil_desa' => $fotoWakil,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'deskripsi' => $request->deskripsi,
                'link_map' => $request->link_map,
                'luas_km' => $request->input('luas_km'),
                'kontak_desa' => $request->kontak_desa,
                'jumlah_laki_laki' => $request->jumlah_laki_laki,
                'jumlah_perempuan' => $request->jumlah_perempuan,
                'jumlah_penduduk_kurang_10tahun' => $request->jumlah_penduduk_kurang_10tahun,
                'jumlah_penduduk_kurang_20tahun' => $request->jumlah_penduduk_kurang_20tahun,
                'jumlah_penduduk_kurang_50tahun' => $request->jumlah_penduduk_kurang_50tahun,
                'jumlah_penduduk_lebih_50tahun' => $request->jumlah_penduduk_lebih_50tahun,
                'nama_wakil_desa' => $request->input('nama_wakil_desa'),
                'nama_kepala_desa' =>  $request->input('nama_kepala_desa'),
                'id_prangkat_desa' => null,
                'total_pemasukan' => null,
                'file_bukti_pemasukan'=> null,

                // Media Sosial Kepala Desa
                'sosmed_kepala_facebook'  => $kepalaArr['facebook']  ?? null,
                'sosmed_kepala_instagram' => $kepalaArr['instagram'] ?? null,
                'sosmed_kepala_linkedin'  => $kepalaArr['linkedin']  ?? null,
                'sosmed_kepala_twitter'   => $kepalaArr['twitter']   ?? null,

                // Media Sosial Wakil Desa
                'sosmed_wakil_facebook'   => $wakilArr['facebook']   ?? null,
                'sosmed_wakil_instagram'  => $wakilArr['instagram']  ?? null,
                'sosmed_wakil_linkedin'   => $wakilArr['linkedin']   ?? null,
                'sosmed_wakil_twitter'    => $wakilArr['twitter']    ?? null,
            ]);

            return redirect()->back()->with('success', 'Profil Desa berhasil disimpan!');
        }
// app/Http/Controllers/KategoriController.php
public function destroy($id)
{
    // Temukan data atau gagal 404
    $kategori = ProfilDesa::findOrFail($id);

    // Hapus
    $kategori->delete();

    // Redirect dengan flash message
    return back()->with('success', 'Data  berhasil dihapus.');
}

}

