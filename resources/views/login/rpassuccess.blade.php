@extends('login.masterlogin')

@section('title', 'Atur Ulang Kata Sandi')

@section('navbar')
@endsection  <!-- Menghapus navbar -->

@section('footer')
@endsection  <!-- Menghapus footer -->

@section('content')
<div class="flex flex-col items-center justify-center h-screen text-center">
    <a href="{{ url('/repassword') }}" class="absolute top-8 left-8 text-3xl text-black">
        <i class="fa fa-angle-left"></i>
    </a>
    <img src="{{ asset('image/verified.gif') }}" alt="Success" class="w-24 h-24 mb-4">
    <h1 class="text-4xl font-bold">Successful</h1>
    <p class="text-lg font-semibold mt-4">Selamat! Kata Sandi Anda telah diubah. Klik lanjutkan untuk Masuk</p>

    <a href="{{ url('/rpassuccess') }}">
        <button class="mt-6 px-6 py-3 bg-green-600 text-white text-lg font-semibold rounded-md hover:bg-green-700">Konfirmasi</button>
    </a>
</div>
@endsection
