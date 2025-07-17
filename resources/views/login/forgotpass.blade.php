@extends('login.masterlogin')

@section('title', 'Atur Ulang Kata Sandi')

@section('navbar')
@endsection  <!-- Menghapus navbar -->

@section('footer')
@endsection  <!-- Menghapus footer -->

@section('content')
<div class="flex flex-col items-center justify-center h-screen text-center">
    <a href="{{ url('/') }}" class="absolute top-8 left-8 text-3xl text-black">
        <i class="fa fa-angle-left"></i>
    </a>
    <h1 class="text-4xl font-bold">Atur Ulang Kata Sandi</h1>
    <p class="text-lg font-semibold mt-4">Masukkan e-mail atau nomor HP yang terdaftar. Kami akan mengirimkan kode verifikasi untuk atur ulang kata sandi.</p>

    <form method="POST" action="/forgot-password">
        @csrf
        <label for="email" class="block mt-6 text-lg font-semibold">Masukkan e-mail Anda</label>
        <input type="email" id="email" name="email" class="w-4/5 md:w-1/2 p-3 mt-2 border border-gray-300 rounded-md text-center" placeholder="Masukkan e-mail Anda">
        <button type="submit" class="mt-4 px-6 py-3 bg-green-600 text-white text-lg font-semibold rounded-md hover:bg-green-700">Atur Ulang Kata Sandi</button>
    </form>

    @if(session('success'))
        <div class="text-green-600 mt-2">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="text-red-600 mt-2">{{ session('error') }}</div>
    @endif
</div>
@endsection
