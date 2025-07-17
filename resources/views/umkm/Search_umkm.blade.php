@extends('layouts.master')

@section('title', 'UMKM Spesifik')

@section('content')
<!-- Hero Section -->
<div class="relative min-h-screen">
  <img src="/image/umkm.png" alt="UMKM Pottery Workshop" class="absolute inset-0 w-full h-full object-cover opacity-50" />
  <div class="absolute inset-0 bg-black opacity-40"></div>

  <div class="relative z-10 flex items-start justify-start h-full px-8 sm:pl-16 pt-40">
    <div class="max-w-3xl">
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 text-white leading-tight">
        Kreasi Tanah Liat Sentuhan <span class="text-green-500">Seni</span> Warisan <span class="text-green-500">Tradisi</span>
      </h1>
      <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-white mb-8 leading-relaxed">
        Dikelola oleh Budi Santoso, pengrajin berpengalaman yang melestarikan budaya dan memberdayakan komunitas, dengan omzet Rp15 juta per bulan.
      </p>
      <a href="#" class="inline-block bg-green-500 text-white py-3 px-8 rounded-full text-lg sm:text-xl font-semibold hover:bg-green-600 transition duration-300">
        Kunjungi UMKM
      </a>
    </div>
  </div>
</div>

<!-- Search & Filter Section -->
<div class="container mx-auto px-8 py-4">
  <h2 class="text-center text-xl sm:text-2xl font-bold mb-4">Dukung UMKM Lokal, Temukan Yang Terbaik Untukmu</h2>

  <div class="flex justify-center p-4 relative">
    <div id="filter-overlay" class="fixed inset-0 bg-black opacity-50 hidden z-40"></div>
  </div>
</div>

<!-- UMKM Cards -->
<div class="container mx-auto px-8 py-4">
  <div class="mb-4">
    <a href="{{ url('/umkm') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-semibold">
      <i class="fas fa-arrow-left mr-2"></i> Kembali ke UMKM
    </a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
    @if ($umkms->isEmpty())
      <p class="text-red-500">Pencarian tidak ditemukan.</p>
    @else
      @foreach ($umkms as $umkm)
        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
          <img src="{{ asset($umkm->foto_banner) }}" alt="{{ $umkm->nama_umkm }}" class="w-full h-48 object-cover" />
          <div class="p-4 flex flex-col flex-grow">
            <div class="flex justify-between text-gray-600 text-sm mb-2">
              <span>{{ $umkm->waktu_operasional }}</span>
              <span>-</span>
            </div>
            <h4 class="text-lg font-bold mb-2">{{ $umkm->nama_umkm }}</h4>
            <p class="text-gray-600 text-sm mb-4 flex-grow">
              {{ Str::limit(preg_replace('/▶.*/', '', strip_tags($umkm->ringkasan_umkm)), 120, '...') }}
            </p>
            <div class="flex items-center mb-4 space-x-1">
              @for ($i = 0; $i < 4; $i++)
                <i class="fas fa-star text-yellow-500"></i>
              @endfor
              <i class="fas fa-star text-gray-300"></i>
            </div>
            <a href="{{ route('umkm.show', $umkm->id_umkm) }}" class="mt-auto inline-block w-full bg-green-500 hover:bg-green-600 text-white text-sm font-semibold text-center py-2 px-4 rounded-lg transition duration-300 ease-in-out">
              Lihat Detail
            </a>
          </div>
        </div>
      @endforeach
    @endif
  </div>

  
<!-- Filter Modal Script -->
<script>
  function filterToggle() {
    document.getElementById('filter-form').classList.remove('hidden');
    document.getElementById('filter-overlay').classList.remove('hidden');
  }

  function filterClose() {
    document.getElementById('filter-form').classList.add('hidden');
    document.getElementById('filter-overlay').classList.add('hidden');
  }

  const form = document.getElementById('searchForm');
  const checkbox = document.getElementById('sendUserIdCheckbox');
</script>

@endsection
