@extends('login.masterlogin')

@section('title', 'Atur Ulang Kata Sandi')

@section('navbar')
@endsection  <!-- Menghapus navbar -->

@section('footer')
@endsection  <!-- Menghapus footer -->

@section('content')
<div class="flex flex-col items-center justify-center h-screen text-center">
    <a href="{{ url('/verif') }}" class="absolute top-8 left-8 text-3xl text-black">
        <i class="fa fa-angle-left"></i>
    </a>
    <h1 class="text-4xl font-bold">Atur Ulang Kata Sandi</h1>
    <p class="text-lg font-semibold mt-4">Kata sandi Anda telah berhasil diatur ulang. Klik konfirmasi untuk mengatur kata sandi baru</p>

    <a href="{{ url('/repassword') }}">
        <button class="mt-6 px-6 py-3 bg-green-600 text-white text-lg font-semibold rounded-md hover:bg-green-700">Konfirmasi</button>
    </a>
</div>
@endsection
