@extends('layouts.master')

@section('title', 'Tambah Desa')

@section('content')

<body class="">
    <div class="relative h-screen">
    <img alt="banner web" class="absolute w-full h-full object-cover" src="{{ asset('image/baner_berita.png') }}"/>

    <div class="absolute overlayy" id="overlay"></div>

    <div class="relative z-10 flex items-center justify-start h-full pl-8">
       <div class="text-left max-w-lg px-4">

        <h1 class="text-4xl font-bold mb-4 text-white" style="color:yellow">
            1000+ Berita Desa
        </h1>

        <!-- Tambahkan background khusus untuk bagian ini -->
        <div class="relative bg-cover bg-center p-4 rounded-lg">
            <h1 class="text-4xl font-bold mb-4 text-white">
            Dapatkan Berita Terbaru dari Desa-Desa di Seluruh Indonesia,
            </h1>
            <p class="text-lg mb-6 text-white">
            Temukan kisah autentik dari desa-desa di seluruh Nusantara.
            Dari semangat gotong royong hingga pelestarian upacara adat
            </p>
        </div>
        </div>
    </div>
    </div>

    <!-- Search Section -->
    <section class="px-6 py-10 text-center">
    <h2 class="text-[#0f6f5e] font-semibold text-2x1 md:text-3xl max-w-[600px] mx-auto leading-snug">
        Cari Berita di Setiap Desa, Temukan Kisah yang Menginspirasi!
    </h2>
    <div class="flex justify-end items-center mt-4">
      @auth
    @if (auth()->user()->role == 3)
    <a href="{{ url('listberita') }}"
       class="flex justify-end inline-block bg-green-700 hover:bg-green-800 text-white font-semibold rounded-md px-5 py-2 shadow transition">
      List Berita
    </a>
        @endif
@endauth
    </div>

    <!-- Search Form -->
    <div class="flex flex-col w-full max-w-2xl bg-[#1A936F] p-6 rounded-xl shadow-lg mx-auto mt-6">
  @if ($errors->any())
    <div id="error-alert" class="bg-red-100 text-red-700 p-3 rounded mb-4 relative">
      <button
        onclick="document.getElementById('error-alert').style.display='none'"
        class="absolute top-1 right-2 text-red-700 font-bold text-xl leading-none hover:text-red-900"
        aria-label="Close alert"
      >
        &times;
      </button>
      <ul>
        @foreach ($errors->all() as $error)
          <li>⚠️ pencarian kosong</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="get" action="/cari_berita" class="bg-white rounded-full px-4 py-2 w-full shadow-sm relative flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 border border-gray-200">
    @csrf
    <!-- Filter Button -->
    <button onclick="toggleFilter(); return false;" type="button" class="absolute left-2 top-1/2 transform -translate-y-1/2 p-2 hover:bg-green-100 rounded-full transition">
      <i class="fas fa-filter text-green-500"></i>
    </button>
    <!-- Input Field -->
    <input name="berita" placeholder="Search ..." type="text"
      class="flex-1 w-full pl-10 pr-3 py-2 rounded-full outline-none text-gray-700 text-sm sm:text-base" />
    <!-- Submit Button -->
    <button type="submit"
      class="bg-[#1A936F] text-white p-3 rounded-full hover:bg-green-600 transition flex items-center justify-center" >
      <i class="fas fa-search"></i>
    </button>
  </form>
</div>

        <!-- Selected Filters -->
        <div id="selected-filters" class="mt-3 flex justify-center gap-2 text-[9px] flex-wrap">
        <!-- Filters will appear here dynamically -->
        </div>
    </section>

<!-- Filter Modal (hidden by default) -->
<div id="filter-form" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-auto mt-20 relative">

    <!-- Close Button -->
    <button onclick="closeFilter()" class="absolute top-4 right-4 bg-transparent text-gray-600 hover:text-red-500 transition p-2 rounded-full">
      <i class="fas fa-times"></i>
    </button>

    <div class="flex justify-center mb-4">
      <img alt="Logo UMKM" class="rounded-full" height="100" src="{{ asset('image/logo.png')}}" width="100"/>
    </div>

    <h2 class="text-center text-lg font-bold mb-4 text-[#0f6f5e]">
      Sesuaikan Yang Kamu Mau
    </h2>
    <form action="/filter_berita_desa" method="get">
@auth
        @if (auth()->user()->role == 0 ||auth()->user()->role == 2  )
    <div class="mb-4">
      <input type="checkbox" id="desa-saya" class="mr-2" name="id_desa" value="{{ auth()->user()->id_desa }}"/>
      <label for="desa-saya" class="text-[#0f6f5e] font-semibold">Desa Saya</label>
    </div>
    @endif
@endauth
    <div class="mb-4">
      <label for="tahun" class="block text-sm font-medium text-gray-700">Pilih Periode Tahun</label>
     <select id="tahun" name="tahun" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring focus:ring-cyan-500 focus:ring-opacity-50 text-xs py-2" onchange="addFilter('Tahun Berita', this.value)">
        <option value="">Pilih Tahun</option>
        <script>
          const tahunSekarang = new Date().getFullYear();
          for (let i = 0; i < 8; i++) {
            document.write(`<option value="${tahunSekarang - i}">${tahunSekarang - i}</option>`);
          }
        </script>
      </select>
    </div>

    <!-- Apply Button -->
    <button type="submit" class="bg-gradient-to-r from-cyan-400 to-cyan-500 text-white p-2 rounded-lg hover:opacity-90 transition w-full mt-4 text-sm font-medium">
      Terapkan
    </button>
        </form>
  </div>
</div>

    <script>
    // Array to store selected filters
    let selectedFilters = [];

    // Toggle filter modal
    function toggleFilter() {
        const filterForm = document.getElementById('filter-form');
        filterForm.classList.toggle('hidden');
    }

    // Close filter modal
    function closeFilter() {
        const filterForm = document.getElementById('filter-form');
        filterForm.classList.add('hidden');
    }

    // Add filter to selected filters
    function addFilter(type, value) {
        if (!value || value === 'Pilih Tahun') return;

        // Check if filter already exists
        const existingFilterIndex = selectedFilters.findIndex(filter => filter.type === type);

        if (existingFilterIndex >= 0) {
        // Update existing filter
        selectedFilters[existingFilterIndex].value = value;
        } else {
        // Add new filter
        selectedFilters.push({ type, value });
        }
    }

    // Apply filters and update UI
    function applyFilters() {
        updateSelectedFiltersUI();
        closeFilter();
        // Here you would typically trigger your search function with the filters
        // performSearch();
    }

    // Update the selected filters UI
    function updateSelectedFiltersUI() {
        const filtersContainer = document.getElementById('selected-filters');
        filtersContainer.innerHTML = '';

        selectedFilters.forEach(filter => {
        if (filter.value) {
            const filterElement = document.createElement('span');
            filterElement.className = 'bg-gray-100 text-gray-700 rounded-full px-2 py-1 font-semibold text-[9px]';

            // Special handling for checkbox
            if (filter.type === 'desa saya' && filter.value === true) {
            filterElement.textContent = 'Desa Saya';
            } else {
            filterElement.textContent = `${filter.type}: ${filter.value}`;
            }

            // Add remove button
            const removeButton = document.createElement('button');
            removeButton.innerHTML = '&times;';
            removeButton.className = 'ml-1 text-gray-500 hover:text-red-500';
            removeButton.onclick = () => removeFilter(filter.type);

            filterElement.appendChild(removeButton);
            filtersContainer.appendChild(filterElement);
        }
        });
    }

    // Remove a filter
    function removeFilter(type) {
        selectedFilters = selectedFilters.filter(filter => filter.type !== type);
        updateSelectedFiltersUI();

        // Also uncheck/clear the corresponding form elements
        if (type === 'desa saya') {
        document.getElementById('desa-saya').checked = false;
        } else if (type === 'Tahun Berita') {
        document.getElementById('tahun').value = '';
        }
    }
    </script>


    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold text-green-700">
        Berita Terbaru
      </h1>
    @if ($beritas->isNotEmpty() && $beritas->first()->created_at)
  <p class="text-gray-500 mb-6">
    {{ \Carbon\Carbon::parse($beritas->first()->created_at)->translatedFormat('d M Y') }}
  </p>
@else
  <p class="text-gray-500 mb-6">Berita tidak ada</p>
@endif


      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($beritas as $berita)
        <!-- News Item 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden h-[500px] flex flex-col">
          <img alt="{{ $berita->judul }}" class="w-full h-64 object-cover" height="600"
             src="{{ $berita->foto ? asset('storage/' . $berita->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($berita->judul) . '&background=4CB080&color=fff' }}"
             width="600"/>
          <div class="p-4 flex flex-col justify-between flex-grow">
            <div class="flex items-center text-gray-500 text-sm mb-2">
                <i class="far fa-calendar-alt mr-2"></i>
                <span>{{ \Carbon\Carbon::parse($berita->created_at)->format('d M, Y') }}</span>


            </div>
            <h2 class="text-lg font-bold text-green-700 mb-2">{{ $berita->judul }}</h2>
            <p class="text-gray-700 mb-4">
              {{ \Illuminate\Support\Str::limit(strip_tags($berita->deskripsi), 120) }}
            </p>
            <div class="flex items-center justify-between">
              <a class="text-white bg-green-700 px-4 py-2 rounded"
              href="{{ url('berita/detail/' . $berita->id_berita) }}">Baca Selengkapnya</a>
            </div>
          </div>
        </div>
        @empty
    <div class="col-span-3 text-center text-gray-400 py-8">Belum ada berita.</div>
    @endforelse
</div>
    @php
    $currentPage = $beritas->currentPage();
    $lastPage = $beritas->lastPage();
@endphp

<div class="flex justify-center items-center space-x-2 flex-wrap mt-6">
  @if ($currentPage > 1)
    <a href="{{ $beritas->url($currentPage - 1) }}" class="bg-[#1A936F] text-white px-4 py-2 rounded-md shadow-md flex items-center gap-2">
      <i class="fas fa-chevron-left"></i> Prev
    </a>
  @endif

  @for ($i = 1; $i <= $lastPage; $i++)
    <a href="{{ $beritas->url($i) }}" class="px-4 py-2 rounded-md shadow-md {{ $currentPage == $i ? 'bg-[#1A936F] text-white' : 'bg-gray-100 hover:bg-gray-300' }}">
      {{ $i }}
    </a>
  @endfor

  @if ($currentPage < $lastPage)
    <a href="{{ $beritas->url($currentPage + 1) }}" class="bg-[#1A936F] text-white px-4 py-2 rounded-md shadow-md flex items-center gap-2">
      Next <i class="fas fa-chevron-right"></i>
    </a>
  @endif
</div>

    </div>
    <script>
      function toggleFilter() {
        const filterForm = document.getElementById('filter-form');
        const overlay = document.getElementById('overlay');

        // Toggle the visibility of the form filter and overlay
        filterForm.classList.toggle('hidden');
        overlay.classList.toggle('hidden');
        overlay.style.display = overlay.classList.contains('hidden') ? 'none' : 'block'; // Show or hide overlay
      }

      // Fungsi untuk menambah filter yang dipilih di bawah search bar
      function addFilter(filterName, value) {
          if (value.trim() === '' || value === 'Pilih Kategori') return; // Jika kosong atau kategori default
          const filterContainer = document.getElementById('selected-filters');

          const filterTag = document.createElement('span');
          filterTag.classList.add('bg-gray-200', 'text-black', 'px-3', 'py-1', 'rounded-full', 'flex', 'items-center', 'gap-2');

          filterTag.innerHTML = `${filterName}: ${value}
              <button onclick="removeFilter(this)" class="text-gray-600 hover:text-red-500 transition">
                  <i class="fas fa-times"></i>
              </button>`;

          filterContainer.appendChild(filterTag);
      }

      // Fungsi untuk menghapus filter
      function removeFilter(button) {
          button.parentElement.remove();
      }

      // Fungsi untuk menerapkan filter dan menutup form filter
      function applyFilters() {
          // Simpan atau proses filter di sini (misalnya, kirim ke server atau tampilkan hasil pencarian)
          closeFilter(); // Menutup form filter setelah diterapkan
      }

      // Fungsi untuk menutup form filter tanpa menerapkan perubahan
      function closeFilter() {
          const filterForm = document.getElementById('filter-form');
          const overlay = document.getElementById('overlay');

          filterForm.classList.add('hidden'); // Sembunyikan form filter
          overlay.classList.add('hidden'); // Sembunyikan overlay
          overlay.style.display = 'none'; // Pastikan overlay tidak terlihat
      }
    </script>
  </body>
@endsection
