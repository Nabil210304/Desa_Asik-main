<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\HTTP;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class admin_desa_desa_saya extends Controller
{
  public function index($id_desa)
    {

    // Cek kalau data user ditemukan


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

    return view('admin_desa.desa_saya',compact('profil','pemasukan','pengeluaran','totalPemasukan',
    'totalPengeluaran',
    'saldo',
    'normal',
    'semuaa',
    'outliers'
));




        // Jika ditemukan
    }
    public function v_edit($id){
          $profil = DB::table('profil_desa')
            ->where('id_desa', $id)
            ->first();

            $id_desa = $profil->id_desa;
              $user = DB::table('users')
            ->where('id_user', $id)
            ->first();


   return view('admin_desa.v_edit',compact('profil','user'));
    }
    public function tambah(Request $request){
        dd($request->all());
    }
    public function update(Request $request, $id_desa)
{
    // Validasi input
    $validated = $request->validate([
        'nama_desa' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'visi' => 'nullable|string',
        'misi' => 'nullable|string',
        'kecamatan' => 'nullable|string|max:255',
        'kabupaten' => 'nullable|string|max:255',
        'link_map' => 'nullable|string',
        'luas_km' => 'nullable|string|max:40',
        'kontak_desa' => 'nullable|string|max:255',
        'jumlah_laki_laki' => 'required|integer',
        'jumlah_perempuan' => 'required|integer',
        'jumlah_penduduk_kurang_10tahun' => 'required|string|max:50',
        'jumlah_penduduk_kurang_20tahun' => 'required|string|max:50',
        'jumlah_penduduk_kurang_50tahun' => 'required|string|max:50',
        'jumlah_penduduk_lebih_50tahun' => 'required|string|max:50',
        'nama_kepala_desa' => 'nullable|string|max:255',
        'nama_wakil_desa' => 'nullable|string|max:255',
        'sosmed_kepala_ig' => 'nullable|string',
        'sosmed_kepala_email' => 'nullable|string',
        'sosmed_kepala_linkedin' => 'nullable|string',
        'sosmed_wakil_ig' => 'nullable|string',
        'sosmed_wakil_email' => 'nullable|string',
        'sosmed_wakil_linkedin' => 'nullable|string',

        'foto_kepala_desa' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        'foto_wakil_desa' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',

        'foto' => 'nullable|image|mimes:jpg,jpeg,png',
        'foto2' => 'nullable|image|mimes:jpg,jpeg,png',
        'foto3' => 'nullable|image|mimes:jpg,jpeg,png',
        'foto4' => 'nullable|image|mimes:jpg,jpeg,png',
        'foto5' => 'nullable|image|mimes:jpg,jpeg,png',
        'foto6' => 'nullable|image|mimes:jpg,jpeg,png',
    ]);

    // Data dasar
    $dataUpdate = [
        'nama_desa' => $validated['nama_desa'],
        'deskripsi' => $validated['deskripsi'] ?? null,
        'visi' => $validated['visi'] ?? null,
        'misi' => $validated['misi'] ?? null,
        'kecamatan' => $validated['kecamatan'] ?? null,
        'kabupaten' => $validated['kabupaten'] ?? null,
        'link_map' => $validated['link_map'] ?? null,
        'luas_km' => $validated['luas_km'] ?? null,
        'kontak_desa' => $validated['kontak_desa'] ?? null,
        'jumlah_laki_laki' => $validated['jumlah_laki_laki'],
        'jumlah_perempuan' => $validated['jumlah_perempuan'],
        'jumlah_penduduk_kurang_10tahun' => $validated['jumlah_penduduk_kurang_10tahun'],
        'jumlah_penduduk_kurang_20tahun' => $validated['jumlah_penduduk_kurang_20tahun'],
        'jumlah_penduduk_kurang_50tahun' => $validated['jumlah_penduduk_kurang_50tahun'],
        'jumlah_penduduk_lebih_50tahun' => $validated['jumlah_penduduk_lebih_50tahun'],
        'nama_kepala_desa' => $validated['nama_kepala_desa'] ?? null,
        'nama_wakil_kepala_desa' => $validated['nama_wakil_desa'] ?? null,

        'link_ig' => $validated['sosmed_kepala_ig'] ?? null,
        'email' => $validated['sosmed_kepala_email'] ?? null,
        'linkedin' => $validated['sosmed_kepala_linkedin'] ?? null,

        'link_ig_wakil' => $validated['sosmed_wakil_ig'] ?? null,
        'email_wakil' => $validated['sosmed_wakil_email'] ?? null,
        'linkedin_wakil' => $validated['sosmed_wakil_linkedin'] ?? null,
    ];

    // Siapkan array tambahan untuk foto-foto umum
    $dataFoto = [];

    for ($i = 1; $i <= 6; $i++) {
        $key = $i === 1 ? 'foto' : 'foto' . $i;

        if ($request->hasFile($key)) {
            $file = $request->file($key);

            $filename = uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $destination = public_path('foto_desa');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $dataFoto[$key] = 'foto_desa/' . $filename;
        }
    }

    // Gabungkan foto ke dalam data update
    $dataUpdate = array_merge($dataUpdate, $dataFoto);

    // Upload foto kepala desa (jika ada)
    if ($request->hasFile('foto_kepala_desa')) {
        $file = $request->file('foto_kepala_desa');
        $filename = 'kepala_' . md5($file->getClientOriginalName() . microtime()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/foto_kepala_desa'), $filename);
        $dataUpdate['foto_kades'] = 'uploads/foto_kepala_desa/' . $filename;
    }

    // Upload foto wakil desa (jika ada)
    if ($request->hasFile('foto_wakil_desa')) {
        $file = $request->file('foto_wakil_desa');
        $filename = 'wakil_' . md5($file->getClientOriginalName() . microtime()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/foto_wakil_desa'), $filename);
        $dataUpdate['foto_wades'] = 'uploads/foto_wakil_desa/' . $filename;
    }

    // Update ke database
    DB::table('profil_desa')
        ->where('id_desa', $id_desa)
        ->update($dataUpdate);

    return redirect('/home')->with('success', 'Data desa berhasil diupdate');
}
public function tabel_pengeluaran($id){
      $pengluaran = DB::table('pengeluaran_desa')->where('id_desa', $id)->get();
          return view('admin_desa.tabel_pengeluaran',compact('pengluaran','id'));

}
public function form_pengeluaran($id){

     return view('admin_desa.form_pengeluaran',compact('id'));


}
public function tambah_pengeluaran(Request $request, $id)
{
    // Simpan file bukti_pengeluaran ke public/bukti
    $files = $request->file('bukti_pengeluaran');
    $pathBukti = [];

    if ($files && is_array($files)) {
        foreach ($files as $file) {
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti'), $namaFile);
            $pathBukti[] = 'bukti/' . $namaFile;
        }
    }

    // Siapkan data yang akan dikirim ke Flask atau disimpan
    $dataDikirim = [];
    foreach ($request->tahun_pengeluaran as $i => $tahun) {
        $dataDikirim[] = [
            'id_desa'   => $id,
            'tahun'     => $tahun,
              'tipe'      => $request->kategori_pengeluaran[$i],
            'bulan'     => $request->bulan_pengeluaran[$i],
            'nama'      => $request->nama_pengeluaran[$i],
            'kategori'  => $request->kategori_pengeluaran[$i],
            'jumlah'    => $request->total_pengeluaran[$i],
            'deskripsi' => $request->deskripsi[$i],
            'kuitansi'  => $pathBukti[$i] ?? null,
        ];
    }

    // Cek apakah ada data lama
    $dataLama = DB::table('pengeluaran_desa')->where('id_desa', $id)->get();

    if ($dataLama->isEmpty()) {
        // Kirim data baru ke Flask
        $response = Http::post('http://127.0.0.1:5000/anomali', $dataDikirim);
      $hasil = $response->json();
        if ($response->successful()) {


            foreach ($hasil as $item) {
                if (is_string($item)) {
                    $item = json_decode($item, true);
                }

                if (is_array($item)) {
                    DB::table('pengeluaran_desa')->insert($item);
                }
            }
        } else {
        dd($hasil);
        }
    } else {

        // Simpan data baru langsung
        foreach ($dataDikirim as $data) {
            DB::table('pengeluaran_desa')->insert($data);
        }

        // Kirim semua data lama ke Flask
        $semuaData = DB::table('pengeluaran_desa')->where('id_desa', $id)->get();
        $response = Http::post('http://127.0.0.1:5000/anomali', $semuaData->toArray());

        if ($response->successful()) {
            // Hapus semua data lama
            DB::table('pengeluaran_desa')->where('id_desa', $id)->delete();

            // Simpan ulang dari response Flask
            foreach ($response->json() as $item) {
                if (is_string($item)) {
                    $item = json_decode($item, true);
                }

                if (is_array($item)) {
                    DB::table('pengeluaran_desa')->insert($item);
                }
            }
        } else {
            return redirect()->back()->with('error', 'Gagal menghubungi Flask saat update: ' . $response->body());
        }
    }

    return redirect('data_pengeluaran_desa/' . $id)->with('success', 'Data berhasil disimpan');
}


public function v_edit_pengluaran($id)
{

      $semuaData = DB::table('pengeluaran_desa')->where('id', $id)->get();

   return view('admin_desa.form_edit',compact('semuaData','id'));
}

  public function proses_edit_pengluaran(Request $request,$id)
{

   $data = [
    'tahun'     => $request->tahun_pengeluaran,
    'bulan'     => $request->bulan_pengeluaran,
    'nama'      => $request->nama_pengeluaran,
    'deskripsi' => $request->deskripsi,
    'kategori'  => $request->kategori_pengeluaran,
    'tipe'      => $request->kategori_pengeluaran,
    'jumlah'    => $request->total_pengeluaran,
];

if ($request->hasFile('bukti')) {
    $file = $request->file('bukti');

    $namaFile = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('bukti'), $namaFile);
    $data['kuitansi'] = 'bukti/' . $namaFile;
}


DB::table('pengeluaran_desa')->where('id', $id)->update($data);


     $semuaData = DB::table('pengeluaran_desa')->where('id', $id)->get();
     $satudata = DB::table('pengeluaran_desa')->where('id', $id)->first();
$back = $satudata->id_desa;

        $response = Http::post('http://127.0.0.1:5000/anomali', $semuaData->toArray());

        if ($response->successful()) {
            // Hapus semua data lama
            DB::table('pengeluaran_desa')->where('id', $id)->delete();

            // Simpan ulang dari response Flask
            foreach ($response->json() as $item) {
                if (is_string($item)) {
                    $item = json_decode($item, true);
                }

                if (is_array($item)) {
                    DB::table('pengeluaran_desa')->insert($item);
                }
            }
        } else {
            return redirect()->back()->with('error', 'Gagal menghubungi Flask saat update: ' . $response->body());
        }


    return redirect('/data_pengeluaran_desa/' . $back)->with('success', 'Data berhasil disimpan');


}
public function hapus(Request $request,$id){

    // Ambil id_desa sebelum menghapus data
    $deletedData = DB::table('pengeluaran_desa')->where('id', $id)->first();
    $back = $deletedData ? $deletedData->id_desa : $request->id_desa;

    DB::table('pengeluaran_desa')->where('id', $id)->delete();
    $semuaData = DB::table('pengeluaran_desa')->where('id_desa', $back)->get();

    $response = Http::post('http://127.0.0.1:5000/anomali', $semuaData->toArray());

    if ($response->successful()) {
        // hapus sekali saja
        DB::table('pengeluaran_desa')
            ->where('id_desa', $back)
            ->delete();

        foreach ($response->json() as $item) {
            if (is_string($item)) $item = json_decode($item, true);
            if (is_array($item)) DB::table('pengeluaran_desa')->insert($item);
        }
    } else {
        return redirect()->back()->with('error', 'Gagal menghubungi Flask saat update: ' . $response->body());
    }

    return redirect('/data_pengeluaran_desa/' . $back)->with('success', 'Data berhasil disimpan');

}
public function tabel_pemasukan($id){

      $pemasukan = DB::table('pemasukans')->where('id_desa', $id)->get();
          return view('admin_desa.tabel_pemasukan',compact('pemasukan','id'));

}
public function form_pemasukan($id){

 return view('admin_desa.form_pemasukan',compact('id'));
}

    public function tambah_pemasukan(Request $request, $id)
{
    $request->validate([
        'tipe.*' => 'required',
        'nama.*' => 'required',
        'kategori.*' => 'required',
        'jumlah.*' => 'required|numeric',
        'deskripsi.*' => 'required',
        'tahun.*' => 'required',
        'kuitansi.*' => 'nullable|file|mimes:pdf|max:2048'
    ]);

    $data = [];

    foreach ($request->tipe as $i => $tipe) {
        $fileName = null;

        if ($request->hasFile('kuitansi') && isset($request->kuitansi[$i])) {
            $file = $request->kuitansi[$i];
            $fileName = 'pemasukan_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('pemasukan'), $fileName);
        }

        $data[] = [
            'id_desa'   => $id,
            'tipe'      => $tipe,
            'nama'      => $request->nama[$i],
            'kategori'  => $request->kategori[$i],
            'jumlah'    => $request->jumlah[$i],
            'deskripsi' => $request->deskripsi[$i],
            'tahun'     => $request->tahun[$i],
            'kuitansi'  => $fileName
        ];
    }

    DB::table('pemasukans')->insert($data);

    return redirect('/v_data_pemasukan/'.$id)->with('success', 'Data pemasukan berhasil ditambahkan.');
}



public function v_edit_pemasukan($id)
{

      $semuaData = DB::table('pemasukans')->where('id', $id)->get();

   return view('admin_desa.form_edit_pemasukan',compact('semuaData','id'));
}

  public function proses_edit_pemasukan(Request $request,$id)
{

   $data = [
    'tahun'     => $request->tahun_pengeluaran,

    'nama'      => $request->nama_pengeluaran,
    'deskripsi' => $request->deskripsi,
    'kategori'  => $request->kategori_pengeluaran,
    'tipe'      => $request->kategori_pengeluaran,
    'jumlah'    => $request->total_pengeluaran,
];

if ($request->hasFile('bukti')) {
    $file = $request->file('bukti');

    $namaFile = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('bukti'), $namaFile);
    $data['kuitansi'] = 'bukti/' . $namaFile;
}


DB::table('pemasukans')->where('id', $id)->update($data);



     $satudata = DB::table('pemasukans')->where('id', $id)->first();
$back = $satudata->id_desa;


    return redirect('/v_data_pemasukan/' . $back)->with('success', 'Data berhasil disimpan');


}
public function hapus_pemasukan(Request $request,$id){

    DB::table('pemasukans')->where('id', $id)->delete();



    return redirect()->back()->with('success', 'Data berhasil disimpan');



}



}
