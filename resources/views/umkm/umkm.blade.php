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

<div class="flex flex-col w-full max-w-2xl bg-[#1A936F] p-6 rounded-xl shadow-lg">
  <form method="get" action="/serach" class="bg-white rounded-full px-4 py-2 w-full shadow-sm relative flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
    @csrf
    <!-- Filter Button -->
    <button onclick="filterToggle()" type="button" class="absolute left-2 top-1/2 transform -translate-y-1/2 p-2 hover:bg-green-100 rounded-full transition">
      <i class="fas fa-filter text-green-500"></i>
    </button>

    <!-- Input Field -->
    <input name="nama_umkm" placeholder="Search ..." type="text"
      class="flex-1 w-full pl-10 pr-3 py-2 rounded-full outline-none text-gray-700 text-sm sm:text-base" />

    <!-- Checkbox -->
    <label class="flex items-center space-x-2 text-sm text-gray-700">
 <input
  type="checkbox"
  id="sendUserIdCheckbox"
  name="send_user_id"
  value="{{ Auth::user()->id_user }}"

      <span>Untuk  saya</span>
    </label>

    <!-- Submit Button -->
    <button type="submit"
      class="bg-[#1A936F] text-white p-3 rounded-full hover:bg-green-600 transition flex items-center justify-center" >
      <i class="fas fa-search"></i>
    </button>
  </form>
</div>
<!-- ketika ada route serach disni maka tambhakan button buntton a href ke umkm -->


  <!-- Filter Modal -->
  <div id="filter-form" class="fixed inset-0 flex items-center justify-center p-4 sm:p-0 hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 sm:w-full max-w-md relative overflow-y-auto max-h-full">
      <button onclick="filterClose()" class="absolute top-4 left-4 text-gray-600 hover:text-red-500" type="button" aria-label="Close Filter">
        <i class="fas fa-times"></i>
      </button>
      <div class="flex justify-center mb-4">
        <img src="/image/Group 23.png" alt="Logo UMKM" class="rounded-full w-24 h-24" />
      </div>
      <h3 class="text-center text-lg font-bold mb-4">Sesuaikan Yang Kamu Mau</h3>

      <form method="GET" action="{{ route('umkm.index') }}" class="space-y-4">

        <input type="text" name="nama_umkm" value="{{ request('nama_umkm') }}" placeholder="Cari Nama UMKM" class="border rounded px-3 py-2 w-full" />
        <input type="text" name="lokasi_umkm" value="{{ request('lokasi_umkm') }}" placeholder="Cari Lokasi UMKM" class="border rounded px-3 py-2 w-full" />
        <select name="kategori_umkm" class="border rounded px-3 py-2 w-full">
          <option value="">Pilih Kategori</option>
          <option value="Kerajinan" {{ request('kategori_umkm') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
          <option value="Makanan & minuman" {{ request('kategori_umkm') == 'Makanan & minuman' ? 'selected' : '' }}>Makanan & minuman</option>
          <option value="Pertanian & Perkebunan" {{ request('kategori_umkm') == 'Pertanian & Perkebunan' ? 'selected' : '' }}>Pertanian & Perkebunan</option>
          <option value="Eko Wisata" {{ request('kategori_umkm') == 'Eko Wisata' ? 'selected' : '' }}>Eko Wisata</option>
        </select>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition w-full">Filter</button>
      </form>
@auth
    @if (auth()->user()->role == 3)
      <a href="/manipulasi" class="mt-6 w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition block text-center">
        Manipulasi UMKM
      </a>
         @endif
@endauth
    </div>
  </div>
</div>

<!-- UMKM Cards -->
<div class="container mx-auto px-8 py-4">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
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
  </div>

  <!-- Pagination -->
  <div class="flex justify-center items-center space-x-2 flex-wrap">
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
</div>



</section>
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
