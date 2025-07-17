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


  
  

<section class="py-12 px-4">
     <a href="/profildesa" class="btn btn-secondary inline-flex items-center px-4 py-2 rounded hover:bg-gray-200">
    <i class="fas fa-arrow-left mr-2"></i> Kembali
</a>

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
                    <a href=""
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
        $currentPage = $dataDesa->currentPage();
        $lastPage = $dataDesa->lastPage();
    @endphp

    <div class="flex justify-center items-center mt-6">
        @if ($currentPage > 1)
            <a href="{{ $dataDesa->url($currentPage - 1) }}" class="bg-green-700 text-white px-4 py-2 rounded-l">Prev</a>
        @else
            <span class="bg-gray-300 text-white px-4 py-2 rounded-l cursor-not-allowed">Prev</span>
        @endif

        @for ($i = 1; $i <= $lastPage; $i++)
            @if ($i == $currentPage)
                <span class="bg-green-700 text-white px-4 py-2 border">{{ $i }}</span>
            @else
                <a href="{{ $dataDesa->url($i) }}" class="bg-white text-green-700 px-4 py-2 border">{{ $i }}</a>
            @endif
        @endfor

        @if ($currentPage < $lastPage)
            <a href="{{ $dataDesa->url($currentPage + 1) }}" class="bg-green-700 text-white px-4 py-2 rounded-r">Next</a>
        @else
            <span class="bg-gray-300 text-white px-4 py-2 rounded-r cursor-not-allowed">Next</span>
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
