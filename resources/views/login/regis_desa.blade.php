@extends('login.masterlogin')

@section('title', 'Home')

@section('content')
<main class="container mx-auto px-4 py-6 flex-grow">
<div class="max-w-4xl mx-auto bg-white p-8 mt-6 rounded-lg shadow-md">

    <!-- Header -->
    <div class="bg-[#1A936F] py-6 md:py-8 rounded-t-lg">
        <h1 class="text-white text-center text-2xl md:text-3xl font-bold">Pendaftaran Akun Kepala Desa</h1>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/daftar_desa" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- DATA PRIBADI -->
        <h2 class="text-2xl font-bold text-gray-800 mt-6 mb-4">Data Pribadi</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama" class="block text-gray-700 font-semibold text-lg">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Nama Lengkap">
                @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="nik" class="block text-gray-700 font-semibold text-lg">NIK</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Nomor Induk Kependudukan">
                @error('nik') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-semibold text-lg">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Email Aktif">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="block text-gray-700 font-semibold text-lg">No. Handphone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="No. HP Aktif">
                @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="alamat" class="block text-gray-700 font-semibold text-lg">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Alamat Lengkap">
                @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- DATA DESA -->
        <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Data Desa</h2>
        


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="desa" class="block text-gray-700 font-semibold text-lg">Nama Desa</label>
                <input type="text" id="desa" name="desa" value="{{ old('desa') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Contoh: Desa Sukamaju">
                @error('desa') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="kode_pos" class="block text-gray-700 font-semibold text-lg">Kode Pos</label>
                <input type="text" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Contoh: Desa Sukamaju">
                @error('kode_pos') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
 <div>
    <label for="kabupaten" class="block text-gray-700 font-semibold text-lg">Nama Kabupaten</label>
    <input type="text" id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Contoh: Kabupaten Banyumas">
    @error('kabupaten') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>
        
            <div>
                <label for="kecamatan" class="block text-gray-700 font-semibold text-lg">Nama Kecamatan</label>
                <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Contoh: Kec. Sukamakmur">
                @error('kecamatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="sk_pengangkatan" class="block text-gray-700 font-semibold text-lg">Nomor SK Pengangkatan</label>
                <input type="text" id="sk_pengangkatan" name="sk_pengangkatan" value="{{ old('sk_pengangkatan') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Contoh: 123/XX/2023">
                @error('sk_pengangkatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="tanggal_pelantikan" class="block text-gray-700 font-semibold text-lg">Tanggal Pelantikan</label>
                <input type="date" id="tanggal_pelantikan" name="tanggal_pelantikan" value="{{ old('tanggal_pelantikan') }}" class="w-full mt-1 p-3 border rounded-md text-lg">
                @error('tanggal_pelantikan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="file_sk" class="block text-gray-700 font-semibold text-lg">Upload SK Pengangkatan (PDF/JPG)</label>
                <input type="file" id="file_sk" name="file_sk" accept=".pdf,.jpg,.jpeg,.png" class="w-full mt-1 p-3 border rounded-md text-lg">
                @error('file_sk') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- PASSWORD -->
        <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Keamanan Akun</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="password" class="block text-gray-700 font-semibold text-lg">Kata Sandi</label>
                <input type="password" id="password" name="password" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Masukkan kata sandi">
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 font-semibold text-lg">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Ulangi kata sandi">
                @error('password_confirmation') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
           

        <!-- TOMBOL -->
        <div class="flex justify-center mt-8">
            <button type="submit" class="bg-[#1A936F] text-white font-bold py-2 px-6 rounded-full shadow-md hover:bg-white hover:text-[#178a5a] border-2 border-white transition duration-300">
                Daftar
            </button>
        </div>
    </form>

</div>
</main>
@endsection
