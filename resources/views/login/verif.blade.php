@extends('login.masterlogin')

@section('title', 'Verifikasi Kode')

@section('navbar')
@endsection  <!-- Menghapus navbar -->

@section('footer')
@endsection  <!-- Menghapus footer -->

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen text-center p-4">
    <a href="{{ url('/') }}" class="absolute top-4 left-4 text-3xl text-black">
        <i class="fa fa-angle-left"></i>
    </a>
    <h1 class="text-3xl md:text-4xl font-bold">Silahkan Cek Email Anda</h1>
    <p class="text-base md:text-lg font-semibold mt-4 max-w-lg">
        Kami telah mengirimkan tautan atur ulang kata sandi ke user@gmail.com, silahkan masukkan verifikasi kode 5 digit yang ada dalam email.
    </p>

    <div class="flex gap-2 mt-6">
        <input type="text" maxlength="1" class="w-10 h-10 md:w-12 md:h-12 text-center border border-gray-300 rounded-md text-lg">
        <input type="text" maxlength="1" class="w-10 h-10 md:w-12 md:h-12 text-center border border-gray-300 rounded-md text-lg">
        <input type="text" maxlength="1" class="w-10 h-10 md:w-12 md:h-12 text-center border border-gray-300 rounded-md text-lg">
        <input type="text" maxlength="1" class="w-10 h-10 md:w-12 md:h-12 text-center border border-gray-300 rounded-md text-lg">
        <input type="text" maxlength="1" class="w-10 h-10 md:w-12 md:h-12 text-center border border-gray-300 rounded-md text-lg">
    </div>

    <a href="{{ url('/reqaccepted') }}">
        <button class="mt-6 px-5 md:px-6 py-3 bg-green-600 text-white text-lg font-semibold rounded-md hover:bg-green-700">Atur Ulang Kata Sandi</button>
    </a>

    <p class="mt-4 text-gray-600 text-sm md:text-base">Belum menerima email? <a href="#" class="text-green-600 font-semibold hover:underline">Kirim ulang email</a></p>
</div>
@endsection
