<?php

namespace App\Http\Controllers;
use App\Models\BeritaDesa;
use \App\Models\UlasanBerita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\ProfilDesa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
class BeritaController extends Controller
{
    public function beritaDetail($id)
    {
    $berita = BeritaDesa::findOrFail($id);
    return view('berita.beritadetail', compact('berita'));
    }

    public function listBerita()
    {
        $beritas = BeritaDesa::with('desa')->paginate(10);
        return view('berita.listberita', compact('beritas'));
    }

    public function tambahBerita()
    {
          $data_desa = ProfilDesa::all();
         // Debug: pastikan data desa ada
        // Tampilkan form tambah berita
        return view('berita.tambahberita',compact('data_desa')); // Pastikan view ini ada
    }

    public function index(Request $request) {
     $perPage = 3; // Jumlah berita per halaman
    $page = $request->query('page', 1);

    // Ambil semua berita dulu
    $beritaSemua = BeritaDesa::orderByDesc('created_at')->get();

    // Misalnya kamu mau nambah ringkasan/cuplikan isi
    $beritaSemua = $beritaSemua->map(function ($item) {
        $item->ringkasan = Str::limit(strip_tags($item->isi), 100); // Buat cuplikan 100 karakter
        return $item;
    });

    $total = $beritaSemua->count();
    $currentItems = $beritaSemua->slice(($page - 1) * $perPage, $perPage)->values();

    $paginator = new LengthAwarePaginator(
        $currentItems,
        $total,
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('berita.berita', ['beritas' => $paginator]);
    }

public function cariBerita(Request $request)
{
    $request->validate([

        'berita' => 'required|string',

    ]);

    $keyword = $request->query('berita', '');
    $perPage = 3; // samakan dengan index
    $page = $request->query('page', 1);

    // Cari berita yang judulnya mirip keyword, ambil dulu semua hasilnya (karena mau bikin ringkasan)
    $beritaSemua = BeritaDesa::where('judul', 'like', "%{$keyword}%")
        ->orderByDesc('created_at')
        ->get();

    // Buat ringkasan isi berita seperti di index
    $beritaSemua = $beritaSemua->map(function ($item) {
        $item->ringkasan = Str::limit(strip_tags($item->isi), 100);
        return $item;
    });

    $total = $beritaSemua->count();

    // Slice data sesuai halaman
    $currentItems = $beritaSemua->slice(($page - 1) * $perPage, $perPage)->values();

    // Buat paginator manual
    $paginator = new LengthAwarePaginator(
        $currentItems,
        $total,
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('berita.berita', ['beritas' => $paginator]);
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
public function editBerita($id)
{
    $berita = BeritaDesa::findOrFail($id);
    return view('berita.editberita', compact('berita'));
}

public function updateBerita(Request $request, $id)
{

    $request->validate([
        'judul' => 'required|string|max:255',
        'isi_berita' => 'required|string',
        'referensi' => 'required|array',
        'foto' => 'nullable|image|max:2048',
    ]);

    $berita = BeritaDesa::findOrFail($id);

    $path = $berita->foto;
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('berita', 'public');
    }

    $berita->update([
        'judul' => $request->judul,
        'deskripsi' => $request->isi_berita,
        'foto' => $path,
        'referensi' => implode(', ', $request->referensi),
    ]);

    return redirect()->route('berita.detail', $berita->id_berita)->with('success', 'Berita berhasil diupdate!');
}
    public function simpanBerita(Request $request)
    {

        // Debug: log semua input
    Log::info('Request input:', $request->all());

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

        return redirect()->route('listberita')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function deleteBerita($id)
    {
        $berita = BeritaDesa::findOrFail($id);
        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }
        $berita->delete();
        return redirect('/listberita')->with('success', 'Berita berhasil dihapus!');
    }

    public function tambahUlasan(Request $request, $id_berita)
    {
        $request->validate([
            'ulasan' => 'required|string|max:1000',
        ]);

        UlasanBerita::create([
        'id_berita' => $id_berita,
        'id_user' => $request->id_user,//auth()->id(), // atau null jika guest
        'ulasan' => $request->ulasan,
        'created_at' => now(),
    ]);
        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
