@extends('layouts.master')

@section('title', 'Profil Desa')

@section('content')
<section class="relative">
    <img alt="Background image of a village" class="w-full h-64 object-cover" height="400" src="image/image 2.png" width="1200"/>
    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-center text-white px-4">
        <h2 class="text-3xl font-bold mb-4">
            Jelajahi Desa Bersama Kami
        </h2>
    </div>
</section>

<div class="flex justify-center p-4 relative">
    <div id="filter-overlay" class="fixed inset-0 bg-black opacity-50 hidden z-40"></div>

    <div class="flex flex-col w-full max-w-2xl bg-[#1A936F] p-6 rounded-xl shadow-lg">
        <form method="get" action="/serach_desa" class="bg-white rounded-full px-4 py-2 w-full shadow-sm relative flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
            @csrf
            <button onclick="filterToggle()" type="button" class="absolute left-2 top-1/2 transform -translate-y-1/2 p-2 hover:bg-green-100 rounded-full transition">
                <i class="fas fa-filter text-green-500"></i>
            </button>

            <input name="nama" placeholder="Search ..." type="text"
              class="flex-1 w-full pl-10 pr-3 py-2 rounded-full outline-none text-gray-700 text-sm sm:text-base" />

            <button type="submit"
              class="bg-[#1A936F] text-white p-3 rounded-full hover:bg-green-600 transition flex items-center justify-center" >
              <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div id="filter-form" class="fixed inset-0 flex items-center justify-center p-4 sm:p-0 hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 sm:w-full max-w-md relative overflow-y-auto max-h-full">
            <button onclick="filterClose()" class="absolute top-4 left-4 text-gray-600 hover:text-red-500" type="button" aria-label="Close Filter">
                <i class="fas fa-times"></i>
            </button>
            <div class="flex justify-center mb-4">
                <img src="/image/Group 23.png" alt="Logo UMKM" class="rounded-full w-24 h-24" />
            </div>
            <h3 class="text-center text-lg font-bold mb-4">Sesuaikan Yang Kamu Mau</h3>

            <form method="GET" action="/filter_desa" class="space-y-4">

                 {{-- Pilih Kabupaten --}}
    <select name="kabupaten" class="border rounded px-3 py-2 w-full">
        <option value="">Pilih Kabupaten</option>
        @foreach ($listKabupaten as $kabupaten)
            <option value="{{ $kabupaten }}" {{ request('kabupaten') == $kabupaten ? 'selected' : '' }}>
                {{ $kabupaten }}
            </option>
        @endforeach
    </select>

    {{-- Pilih Kecamatan --}}
    <select name="kecamatan" class="border rounded px-3 py-2 w-full">
        <option value="">Pilih Kecamatan</option>
        @foreach ($listKecamatan as $kecamatan)
            <option value="{{ $kecamatan }}" {{ request('kecamatan') == $kecamatan ? 'selected' : '' }}>
                {{ $kecamatan }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition w-full">
        Filter
    </button>
</form>

           @auth
    @if (auth()->user()->role == 3)
        <a href="/admin/manipulasi_desa" class="mt-6 w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition block text-center">
            Manipulasi Desa
        </a>
    @endif
@endauth

        </div>
    </div>
</div>

<section class="py-12 px-4">
    <h3 class="text-center text-2xl font-bold mb-8">
        Desa Yang Terdaftar di Kami
    </h3>

    <div class="flex flex-wrap justify-center gap-8">
        @foreach($dataDesa as $desa)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full md:w-80 flex flex-col h-full border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <img alt="Image of " class="w-full h-40 object-cover max-w-full" src="{{ $desa->foto }}"/>
                <div class="p-4 flex flex-col justify-between h-full">
                    <h4 class="text-xl font-bold mb-2">
                        {{ $desa->nama_desa }}
                    </h4>
                    <p class="text-gray-600 min-h-[70px] line-clamp-3">
                        {{ $desa->deskripsi }}
                    </p>
                    <a href="/desa/{{$desa->id_prangkat_desa}}"
                       class="bg-[#1A936F] text-white px-6 py-3 w-full rounded-lg shadow-md font-bold flex items-center justify-center gap-2 mt-4 transition-all duration-300 hover:bg-green-600 active:scale-95">
                        Lihat <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @endforeach

        @if($dataDesa->isEmpty())
            <p class="text-center text-gray-500">Tidak ada desa ditemukan.</p>
        @endif
    </div>
</section>

<section class="py-8 px-4">
    @php
        $page = $dataDesa->currentPage();
        $totalPages = $dataDesa->lastPage();
    @endphp

    <div class="flex justify-center items-center space-x-2 flex-wrap mt-6">
        @if ($page > 1)
            <a href="{{ request()->fullUrlWithQuery(['page' => $page - 1]) }}" class="bg-[#1A936F] text-white px-4 py-2 rounded-md shadow-md flex items-center gap-2">
                <i class="fas fa-chevron-left"></i> Prev
            </a>
        @endif

        @for ($i = 1; $i <= $totalPages; $i++)
            <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" class="px-4 py-2 rounded-md shadow-md {{ $page == $i ? 'bg-[#1A936F] text-white' : 'bg-gray-100 hover:bg-gray-300' }}">
                {{ $i }}
            </a>
        @endfor

        @if ($page < $totalPages)
            <a href="{{ request()->fullUrlWithQuery(['page' => $page + 1]) }}" class="bg-[#1A936F] text-white px-4 py-2 rounded-md shadow-md flex items-center gap-2">
                Next <i class="fas fa-chevron-right"></i>
            </a>
        @endif
    </div>
</section>

<script>
  function filterToggle() {
    document.getElementById('filter-form').classList.remove('hidden');
    document.getElementById('filter-overlay').classList.remove('hidden');
  }

  function filterClose() {
    document.getElementById('filter-form').classList.add('hidden');
    document.getElementById('filter-overlay').classList.add('hidden');
  }
</script>
@endsection
