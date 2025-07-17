@extends('layouts.master')

@section('title', 'Tambah Pemasukan')

@section('navbar')
@endsection

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

    <form action="/admin_desa_tambah_pemasukan/{{$id}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div id="pemasukan-wrapper">
            <label class="font-semibold">Pemasukan*</label>

            <div class="pemasukan-item flex flex-wrap gap-2 mb-4">
                <input type="text" name="tipe[]" placeholder="Tipe" class="border rounded p-2 w-40">
                <input type="text" name="nama[]" placeholder="Nama Pemasukan" class="border rounded p-2 w-60">
                  <select name="kategori[]" class="border rounded p-2 w-60">
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <option value="Pembangunan Infrastruktur Desa">Pembangunan Infrastruktur Desa</option>
                    <option value="Pemberdayaan Masyarakat">Pemberdayaan Masyarakat</option>
                    <option value="Kesehatan dan Lingkungan">Kesehatan dan Lingkungan</option>
                </select>

                <input type="number" name="jumlah[]" placeholder="Jumlah" class="border rounded p-2 w-40">
                <input type="text" name="deskripsi[]" placeholder="Deskripsi" class="border rounded p-2 w-60">
                <input type="text" name="tahun[]" placeholder="Tahun" class="border rounded p-2 w-32">
                <input type="file" name="kuitansi[]" accept="application/pdf" class="border rounded p-2">
                <button type="button" class="hapus-pemasukan bg-red-600 text-white px-3 py-2 rounded text-xl">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>

        <button type="button" id="tambah-pemasukan" class="bg-blue-600 text-white px-4 py-2 rounded mb-4">
            <i class="fas fa-plus"></i> Tambah Pemasukan
        </button>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Simpan</button>
    </form>
</div>

<script>
document.getElementById('tambah-pemasukan').addEventListener('click', function () {
    const wrapper = document.getElementById('pemasukan-wrapper');
    const item = document.querySelector('.pemasukan-item');
    const clone = item.cloneNode(true);

    clone.querySelectorAll('input').forEach(el => {
        if (el.type !== 'file') el.value = '';
    });

    wrapper.appendChild(clone);
});

document.getElementById('pemasukan-wrapper').addEventListener('click', function (e) {
    if (e.target.closest('.hapus-pemasukan')) {
        const items = document.querySelectorAll('.pemasukan-item');
        if (items.length > 1) {
            e.target.closest('.pemasukan-item').remove();
        }
    }
});
</script>
@endsection
