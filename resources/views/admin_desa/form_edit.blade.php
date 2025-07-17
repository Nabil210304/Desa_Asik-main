@extends('layouts.master')

@section('title', 'Tambah Desa')

@section('navbar')
@endsection  <!-- Menghapus navbar -->

@section('content')
<div class="max-w-7xl mx-auto mb-10 mt-5 bg-white p-8 rounded-lg shadow-lg">

    {{-- ERROR HANDLER --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            <strong class="font-bold">⚠️ Ada yang salah:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            ✅ {{ session('success') }}
        </div>
    @endif
<form action ="/edit_pengeluaran/{{$id}}" method="post" enctype="multipart/form-data">
    @csrf
    @foreach($semuaData as $pengeluaran)
    <div class="pengeluaran-item flex flex-wrap gap-2 mb-4">
        <input type="number" name="tahun_pengeluaran" value="{{ $pengeluaran->tahun }}" class="border rounded p-2 w-32">

        <select name="bulan_pengeluaran" class="border rounded p-2 w-40">
            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $bulan)
                <option value="{{ $index + 1 }}" {{ $pengeluaran->bulan == $index + 1 ? 'selected' : '' }}>{{ $bulan }}</option>
            @endforeach
        </select>

        <input type="text" name="nama_pengeluaran" value="{{ $pengeluaran->nama }}" class="border rounded p-2 w-60">
        <input type="text" name="deskripsi" value="{{ $pengeluaran->deskripsi }}" class="border rounded p-2 w-60">

        <select name="kategori_pengeluaran" class="border rounded p-2 w-60">
            <option disabled>-- Pilih Kategori --</option>
            <option value="Pembangunan Infrastruktur Desa" {{ $pengeluaran->kategori == 'Pembangunan Infrastruktur Desa' ? 'selected' : '' }}>Pembangunan Infrastruktur Desa</option>
            <option value="Pemberdayaan Masyarakat" {{ $pengeluaran->kategori == 'Pemberdayaan Masyarakat' ? 'selected' : '' }}>Pemberdayaan Masyarakat</option>
            <option value="Kesehatan dan Lingkungan" {{ $pengeluaran->kategori == 'Kesehatan dan Lingkungan' ? 'selected' : '' }}>Kesehatan dan Lingkungan</option>
        </select>

        <input type="number" name="total_pengeluaran" value="{{ $pengeluaran->jumlah }}" class="border rounded p-2 w-56">
        
        <input type="file" name="bukti"  accept="application/pdf" class="border rounded p-2">
     <a href="{{ asset($pengeluaran->kuitansi) }}" target="_blank" class="text-blue-500 underline">Lihat bukti</a>
       
    </div>
@endforeach


        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Simpan</button>
    </form>
</div>

<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
document.getElementById('tambah-pengeluaran').addEventListener('click', function () {
    const wrapper = document.getElementById('pengeluaran-wrapper');
    const item = document.querySelector('.pengeluaran-item');
    const clone = item.cloneNode(true);

    // Kosongkan semua input pada clone
    clone.querySelectorAll('input, select').forEach(el => {
        if (el.type === 'file') return;
        el.value = '';
    });

    wrapper.appendChild(clone);
});

document.getElementById('pengeluaran-wrapper').addEventListener('click', function (e) {
    if (e.target.closest('.hapus-pengeluaran')) {
        const items = document.querySelectorAll('.pengeluaran-item');
        if (items.length > 1) {
            e.target.closest('.pengeluaran-item').remove();
        }
    }
});
</script>
@endsection
