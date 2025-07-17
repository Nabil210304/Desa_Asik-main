@extends('login.masterlogin')

@section('title', 'Home')

@section('content')
<main class="container mx-auto px-4 py-6 flex-grow">
<div class="max-w-4xl mx-auto bg-white p-8 mt-6 rounded-lg shadow-md">
    <!-- Header -->
    <div class="bg-[#1A936F] py-6 md:py-8 rounded-t-lg">
        <h1 class="text-white text-center text-2xl md:text-3xl font-bold">Pendaftaran Akun Masyarakat</h1>
    </div>

    <!-- Data Pribadi -->
    <h2 class="text-2xl font-bold text-gray-800 mt-6 mb-4">Data Pribadi</h2>

   <!-- Tampilkan pesan sukses -->
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Tampilkan pesan error global -->
@if($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/daftar_masyarakat" class="space-y-6">
    @csrf

    <!-- Baris 1 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="nama" class="block text-gray-700 font-semibold text-lg">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Nama Pendaftar Akun Masyarakat">
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="block text-gray-700 font-semibold text-lg">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Email Pendaftar Akun">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Baris 2 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="phone" class="block text-gray-700 font-semibold text-lg">Nomor Handphone Aktif</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Nomor Handphone Pendaftar Akun">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

         <div>
            <label for="alamat" class="block text-gray-700 font-semibold text-lg">Alamat</label>
            <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Nomor Handphone Pendaftar Akun">
            @error('alamat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="password" class="block text-gray-700 font-semibold text-lg">Kata Sandi</label>
            <input type="password" id="password" name="password" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Masukkan Kata Sandi Akun">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Baris 3 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="confirm-password" class="block text-gray-700 font-semibold text-lg">Konfirmasi Kata Sandi</label>
            <input type="password" id="confirm-password" name="password_confirmation" class="w-full mt-1 p-3 border rounded-md text-lg" placeholder="Masukkan Konfirmasi Kata Sandi Akun">
            @error('password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Tombol -->
    <div class="flex justify-center mt-6">
        <button type="submit" class="inline-block bg-[#1A936F] text-white font-bold no-underline py-2 px-5 rounded-full border-2 border-white text-[16px] shadow-md transition-all duration-300 ease-in-out hover:bg-white hover:text-[#178a5a]">
            Daftar
        </button>
    </div>
</form>

</div>
</main>
@endsection
