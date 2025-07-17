@extends('layouts.master')

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

         
        <a href="javascript:history.back()"
        class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-full shadow transition mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#1A936F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

<div class="container mt-4">
    <h1 class="text-2xl font-bold text-white bg-[#48A98C] p-4 rounded-t-lg">Menambahkan UMKM Baru</h1>
    <div class="mb-6"></div>


    <form action="/admin_desa_edit_user/{{$user->id_user}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Data Umum -->
        <div class="mb-3">
            <label for="name" class="font-semibold">Nama</label>
            <input type="text" class="w-full border rounded p-2 mt-1" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email"class="font-semibold">Email</label>
            <input type="email"  class="w-full border rounded p-2 mt-1" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="font-semibold">Password (kosongkan jika tidak diubah)</label>
            <input type="password"  class="w-full border rounded p-2 mt-1"name="password">
        </div>

        <!-- Data Pribadi -->
        <div class="mb-3">
            <label for="nik" class="font-semibold">NIK</label>
            <input type="text" class="w-full border rounded p-2 mt-1" name="nik" value="{{ old('nik', $user->nik) }}" required>
        </div>




        <div class="mb-3">
            <label for="tgl_pelantikan" class="font-semibold">Tanggal Pelantikan</label>
            <input type="date"  class="w-full border rounded p-2 mt-1" name="tgl_pelantikan" value="{{ old('tgl_pelatikan', $user->tgl_pelatikan) }}" required>
        </div>



        <!-- Kontak -->
        <div class="mb-3">
            <label for="no_hp" class="font-semibold">No HP</label>
            <input type="text"  class="w-full border rounded p-2 mt-1" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
        </div>

        <div class="mb-3">
            <label for="alamat" class="font-semibold">Alamat</label>
            <textarea  class="w-full border rounded p-2 mt-1" name="alamat">{{ old('alamat', $user->alamat) }}</textarea>
        </div>




   <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
    Simpan Perubahan
</button>

    </form>
    <br>
    <a href="/data_prangkat/{{$user->id_desa}}"
   class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
    Kembali
</a>

</div>
</div>
@endsection
