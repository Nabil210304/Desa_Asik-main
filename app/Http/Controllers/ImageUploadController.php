<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\PhpWord;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpWord\IOFactory;
class ImageUploadController extends Controller
{

        public function home()
        {
            // Ambil semua data surat dan gambar-gambarnya
            $surats = DB::table('surats')

                ->get();

            return view('super_admin_dokumen', compact('surats'));
        }
           public function home_desa($id)
{
    // Ambil semua data surat yang memiliki id_desa = $id
    $surats = DB::table('surats')
        ->where('id_desa', $id) // <-- perbaiki di sini
        ->get();

    return view('welcome', compact('surats'));
}


        public function uploadGambar(Request $request)
    {
        $request->validate(['image' => 'required|image']);
        $path = $request->file('image')->store('quill_uploads', 'public');
        return response()->json(['url' => asset('storage/'.$path)]);
    }

    public function tambah(Request $request)
    {
        DB::table('surats')->where('id_surat', $request->id_surat)->update([
            'konten' => $request->konten,
            'updated_at' => now()
        ]);

        return redirect('/home')->with('success', 'Konten berhasil disimpan');

    }

    public function upload(Request $request)
    {
        // Debug dulu


        if ($request->hasFile('file')) {
            // Simpan file dan ambil path-nya
            $path = $request->file('file')->store('public/uploads');
            $url = Storage::url($path);

            return response()->json(['location' => $url]);
        }

        return response()->json(['error' => 'Gagal upload file'], 400);
    }

public function tambah_dokument(Request $request)
{
    // 1. Generate ID dokumen secara UUID
    $id_dokumen = Str::uuid()->toString();

    // 2. Ambil user yang sedang login
    $user = Auth::user();

    // 3. Tentukan id_desa berdasarkan role
    $id_desa = ($user->role == 3) ? $user->id_user : $request->id_user;

    // 4. Simpan data surat
    DB::table('surats')->insert([
        'id_surat'   => $id_dokumen,
        'id_desa'    => $id_desa,
        'nama'       => $request->nama,
        'konten'     => $request->konten,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // 5. Simpan gambar-gambar jika ada
    if ($request->hasFile('gambar')) {
        foreach ($request->file('gambar') as $gambar) {
            $ext = $gambar->getClientOriginalExtension();
            $namaFile = 'img_' . Str::uuid()->toString() . '.' . $ext;
            $path = $gambar->storeAs('uploads/gambar', $namaFile, 'public');

            DB::table('gambar_dokumens')->insert([
                'id_surat'   => $id_dokumen,
                'gambar'     => $path,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    return redirect()->back()->with('success', 'Dokumen dan gambar berhasil disimpan.');
}
    public function edit($id)
    {


        $gambar = DB::table('gambar_dokumens')
            ->where('id_surat', $id)
            ->get();

        $surat = DB::table('surats')->where('id_surat', $id)->first();

        if (!$surat) {
            abort(404); // atau redirect back
        }

        return view('template', [
            'gambar' => $gambar,
            'id_surat' => $id,
            'konten' => $surat->konten,
        ]);
    }


    public function print($id)
    {
        // Ambil data surat
        $document = DB::table('surats')->where('id_surat', $id)->first();

        if (!$document) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan');
        }

        // Ambil konten dari database
        $konten = $document->konten;

        // Parsing konten dan konversi <img> ke base64
        libxml_use_internal_errors(true); // Untuk hindari warning dari HTML
        $doc = new \DOMDocument();
        $doc->loadHTML('<?xml encoding="utf-8" ?>' . $konten);

        $images = $doc->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            // Jika path relatif dan mengarah ke storage
            if (str_starts_with($src, '../../storage')) {
                $relativePath = str_replace('../../storage', 'storage', $src);
                $fullPath = public_path($relativePath);

                if (file_exists($fullPath)) {
                    $type = pathinfo($fullPath, PATHINFO_EXTENSION);
                    $data = file_get_contents($fullPath);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $img->setAttribute('src', $base64);
                }
            }

            // Jika path mulai dari /storage (lebih umum juga dipakai)
            elseif (str_starts_with($src, '/storage')) {
                $fullPath = public_path(ltrim($src, '/'));

                if (file_exists($fullPath)) {
                    $type = pathinfo($fullPath, PATHINFO_EXTENSION);
                    $data = file_get_contents($fullPath);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $img->setAttribute('src', $base64);
                }
            }
        }

        $kontenBaru = $doc->saveHTML();

        // Inisialisasi DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($kontenBaru);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream("dokumen-{$id}.pdf", ['Attachment' => 0]);
    }
    public function pengaturan($id)
    {
        $surat = DB::table('surats')->where('id_surat', $id)->first();
        $gambars = DB::table('gambar_dokumens')->where('id_surat', $id)->get();

        return view('edit', [
            'surat' => $surat,
            'gambars' => $gambars
        ]);
    }


    public function update_surat(Request $request, $id)
    {
        DB::table('surats')->where('id_surat', $id)->update([
            'nama' => $request->input('judul')
        ]);

        // Simpan gambar baru jika ada
        if ($request->hasFile('gambar_baru')) {
            foreach ($request->file('gambar_baru') as $file) {
                $path = $file->store('surat', 'public');

                DB::table('gambar_dokumens')->insert([
                    'id_surat' => $id,
                    'gambar' => $path
                ]);
            }
        }

        return redirect('/home')->with('success', 'Konten berhasil disimpan');
    }

    public function hapusGambar_surat($id)
    {
        $gambar = DB::table('gambar_surat')->where('id', $id)->first();

        if ($gambar) {
            Storage::disk('public')->delete($gambar->gambar);
            DB::table('gambar_surat')->where('id', $id)->delete();

            return response()->json(['message' => 'Gambar berhasil dihapus']);
        }

        return response()->json(['message' => 'Gambar tidak ditemukan'], 404);
    }
    public function hapusSurat($id)
{
    // Ambil semua gambar terkait surat
    $gambars = DB::table('gambar_dokumens')->where('id_surat', $id)->get();

    // Hapus file gambar dari storage
    foreach ($gambars as $gambar) {
        if (Storage::disk('public')->exists($gambar->gambar)) {
            Storage::disk('public')->delete($gambar->gambar);
        }
    }

    // Hapus gambar dari database
    DB::table('gambar_dokumens')->where('id_surat', $id)->delete();

    // Hapus surat dari database
    DB::table('surats')->where('id_surat', $id)->delete();

    return redirect('/home')->with('success', 'Surat dan gambar berhasil dihapus.');
}

}
