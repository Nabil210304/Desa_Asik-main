@extends('layouts.master')

@section('title', 'Tambah Desa')

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

    <!-- Tombol Kembali -->
    <a href="javascript:history.back()"
       class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-full shadow transition mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#1A936F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>

    <form action="/super_admin_tambahdesa" method="post">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="select-user">Pilih Calon Admin Desa*</label>
            <select id="select-user" class="w-full p-2 border border-gray-300 rounded">
                <option value="">-- Pilih User --</option>
                @foreach ($usersMenunggu as $u)
                    <option value="{{ $u->id_user }}"
                        data-id="{{ $u->id_user }}"
                        data-name="{{ $u->name }}"
                        data-email="{{ $u->email }}"
                        data-nik="{{ $u->nik }}"
                        data-tgl_pelantikan="{{ $u->tgl_pelantikan }}"
                        data-no_hp="{{ $u->no_hp }}"
                        data-alamat="{{ $u->alamat }}"
                        data-nama_desa="{{ $u->nama_desa }}"
                        data-kecamatan="{{ $u->kecamatan }}"
                        data-kabupaten="{{ $u->kabupaten }}"
                    >
                        {{ $u->name }} ({{ $u->email }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- ID Perangkat Desa --}}
        <div class="mb-3">
            <label class="block font-bold mb-1">ID Perangkat Desa</label>
            <input type="text" name="id_perangkat_desa" id="input-id" class="w-full p-2 border border-gray-300 rounded">
        </div>

        {{-- Nama Desa --}}
        <div class="mb-3">
            <label class="block font-bold mb-1">Nama Desa</label>
            <input type="text" name="nama_desa" id="input-nama_desa" class="w-full p-2 border border-gray-300 rounded">
        </div>

        {{-- Kecamatan --}}
        <div class="mb-3">
            <label class="block font-bold mb-1">Kecamatan</label>
            <input type="text" name="kecamatan" id="input-kecamatan" class="w-full p-2 border border-gray-300 rounded">
        </div>

        {{-- Kabupaten --}}
        <div class="mb-3">
            <label class="block font-bold mb-1">Kabupaten</label>
            <input type="text" name="kabupaten" id="input-kabupaten" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
            Simpan Perubahan
        </button>
    </form>

    {{-- JS isi otomatis --}}
    <script>
        document.getElementById('select-user').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];

            document.getElementById('input-id').value = selected.dataset.id || '';
            document.getElementById('input-nama_desa').value = selected.dataset.nama_desa || '';
            document.getElementById('input-kecamatan').value = selected.dataset.kecamatan || '';
            document.getElementById('input-kabupaten').value = selected.dataset.kabupaten || '';
        });
    </script>
</div>
@endsection
