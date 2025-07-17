@extends('login.masterlogin')

@section('title', 'Atur Ulang Kata Sandi')

@section('navbar')
@endsection  <!-- Menghapus navbar -->

@section('footer')
@endsection  <!-- Menghapus footer -->

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6">
        <a href="{{ url('/reqaccepted') }}" class="absolute top-8 left-8 text-3xl text-black">
            <i class="fa fa-angle-left"></i>
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Atur Ulang Kata Sandi</h2>
        <p class="text-gray-600">Buat kata sandi baru, Pastikan sandi tersebut berbeda dari kata sandi yang sebelumnya demi keamanan</p>
        <form class="mt-8 space-y-6" action="/repassword" method="POST">
            @csrf
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input type="password" name="password" id="password" placeholder="Masukan Kata Sandi Baru" class="block w-full pr-10 border-gray-300 rounded-md">
            </div>
            <div>
                <label for="confirm-password" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Masukan kembali Kata Sandi Baru" class="block w-full pr-10 border-gray-300 rounded-md">
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">Perbarui Kata Sandi</button>
            </div>
        </form>
    </div>
</div>
@endsection
