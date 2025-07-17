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

<div class="container mt-4">
    <h1 class="text-2xl font-bold text-white bg-[#48A98C] p-4 rounded-t-lg">Menambahkan UMKM Baru</h1>
    <div class="mb-6"></div>


    <form action="/super_admin_edit_user/{{$user->id_user}}" method="POST" enctype="multipart/form-data">
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
        <label class="font-semibold">File SK:</label>
        <div class="flex items-center gap-4 mt-2">
            <img src="{{ asset('sk/' . $user->sk_pengangkatan) }}" alt="Gambar Dokumen" class="w-32 h-auto rounded border">
            <div>
                <p>{{$user->sk_pengangkatan }}</p>
                <a href="{{ route('user.download.gambar', $user->id_user) }}" class="text-blue-500 underline">
        Download Gambar
    </a>
            </div>
        </div>
    </div>

        <div class="mb-3">
            <label for="tgl_pelantikan" class="font-semibold">Tanggal Pelantikan</label>
            <input type="date"  class="w-full border rounded p-2 mt-1" name="tgl_pelantikan" value="{{ old('tgl_pelatikan', $user->tgl_pelatikan) }}" required>
        </div>

        <div class="mb-3">
            <label for="kode_pos" class="font-semibold">Kode Pos</label>
            <input type="text"  class="w-full border rounded p-2 mt-1" name="kode_pos" value="{{ old('kode_pos', $user->kode_pos) }}">
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

        <!-- Role -->
        <div class="mb-3">
            <label for="role" class="font-semibold">Role</label>
            <select class="form-select" name="role" required>
                <option value="0" {{ $user->role == 1 ? 'selected' : '' }}>User Biasa</option>
                         <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>admin</option>
                <option value="1" {{ $user->role == 2 ? 'selected' : '' }}>Prangkat Desa</option>
                <option value="2" {{ $user->role == 3 ? 'selected' : '' }}>Superadmin</option>
            </select>
        </div>

        <!-- Desa -->
        <div class="mb-3">
            <label for="nama_desa" class="font-semibold">Nama Desa</label>
            <input type="text"   class="w-full border rounded p-2 mt-1" name="nama_desa" value="{{ old('nama_desa', $user->nama_desa) }}">
        </div>

        <div class="mb-3">
            <label for="kecamatan" class="font-semibold">Kecamatan</label>
            <input type="text"  class="w-full border rounded p-2 mt-1" name="kecamatan" value="{{ old('kecamatan', $user->kecamatan) }}">
        </div>

        <div class="mb-3">
            <label for="kabupaten"class="font-semibold">Kabupaten</label>
            <input type="text"   class="w-full border rounded p-2 mt-1" name="kabupaten" value="{{ old('kabupaten', $user->kabupaten) }}">
        </div>

        <!-- Verifikasi -->
        <div class="mb-3">
            <label for="status_verifikasi"class="font-semibold">Status Verifikasi</label>
            <select class="form-select" name="status_verifikasi">
                <option value="menunggu" {{ $user->status_verifikasi == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diterima" {{ $user->status_verifikasi == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $user->status_verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>


   <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
    Simpan Perubahan
</button>

    </form>
</div>
</div>
@endsection
