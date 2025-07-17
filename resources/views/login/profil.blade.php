@extends('login.masterlogin')

@section('title', 'Profil')

@section('navbar')
@endsection <!-- Menghapus navbar -->

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <!-- Header -->
    <div class="flex items-center mb-4">
        <div>
            <a href="/home">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
        </div>
        <div class="ml-auto flex items-center space-x-3">
            <div class="text-right">
                <p class="text-lg text-green-500 font-semibold">Selamat Datang, {{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
            </div>
            <img alt="User profile picture" class="rounded-full h-10 w-10"
                 src="https://storage.googleapis.com/a1aa/image/CnYi8_U3E0lfO1sMfeGhcrYyo5qbNNpRT7kMZHJn6xo.jpg"/>
        </div>
    </div>

    <!-- Profile Card -->
    <form action="/profil/{{ Auth::user()->id_user }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-6">
        @csrf
        @method('PUT')

        <div class="bg-green-500 text-white rounded-t-lg p-4 text-center md:text-left">
            <h2 class="text-lg font-semibold">Halaman Profil Akun</h2>
        </div>

        <div class="flex flex-col md:flex-row items-center p-4 space-y-4 md:space-y-0 md:space-x-4">
            <img alt="Profile picture" class="rounded-full h-20 w-20"
                 src="https://storage.googleapis.com/a1aa/image/g0xc1UXwr5r0HJobhtrdaGbLFhIN5YskIbC6wa3L9wM.jpg"/>
            <div class="text-center md:text-left">
                <p class="font-semibold">{{ Auth::user()->nama }}</p>
                <p class="text-gray-500">{{ Auth::user()->email }}</p>
            </div>
      
        </div>

        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Nama Lengkap</label>
                    <input class="w-full border rounded p-2" name="name" type="text" value="{{ Auth::user()->name }}" required />
                </div>
                <div>
                    <label class="block text-gray-700">Nomor Telepon</label>
                    <input class="w-full border rounded p-2" name="no_hp" type="text" value="{{ Auth::user()->no_hp }}" />
                </div>
               
                <div>
                    <label class="block text-gray-700">Alamat</label>
                    <input class="w-full border rounded p-2" name="alamat" type="text" value="{{ Auth::user()->alamat }}" />
                </div>
               
            </div>
            <br>
                  <button type="submit" class="md:ml-auto bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
