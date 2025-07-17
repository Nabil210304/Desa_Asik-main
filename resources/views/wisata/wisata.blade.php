@extends('layouts.master')

@section('title', 'Profil Desa')

@section('content')
<body class="bg-white text-gray-800">
  <div x-data="{ activeSlide: 1 }" class="relative overflow-hidden" style="min-height: 100vh;">
    <!-- Slider Images -->
    <div class="absolute w-full h-full transition-all duration-700" x-show="activeSlide === 1">
      <img src="/image/baner_wisata.png" alt="Banner Wisata 1" class="w-full h-full object-contain" />
    </div>
    <div class="absolute w-full h-full transition-all duration-700" x-show="activeSlide === 2">
      <img src="/image/baner_wisata1.png" alt="Banner Wisata 2" class="w-full h-full object-contain" />
    </div>
    <div class="absolute w-full h-full transition-all duration-700" x-show="activeSlide === 3">
      <img src="/image/baner_wisata2.png" alt="Banner Wisata 3" class="w-full h-full object-contain" />
    </div>

    <!-- Slider Controls -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
      <template x-for="i in 3" :key="i">
        <button @click="activeSlide = i" :class="{ 'bg-white': activeSlide === i, 'bg-gray-400': activeSlide !== i }" class="w-3 h-3 rounded-full"></button>
      </template>
    </div>
  </div>

  <!-- Search Section -->
  <div class="flex justify-center px-4 mt-4">
    <div class="flex items-center bg-white rounded-full overflow-hidden w-full max-w-2xl h-20 shadow-md">
      <input class="flex-grow p-6 text-gray-700 outline-none h-full text-xl" placeholder="Cari Desamu" type="text"/>
      <button class="bg-green-500 text-white px-8 py-4 h-full text-xl">Cari</button>
    </div>
  </div>

  <div class="container mx-auto p-4">
    <h2 class="text-green-600 text-2xl font-bold mb-4">
      Wisata Kami
    </h2>
    <div class="flex space-x-4 overflow-x-auto pb-4">
      <div class="flex-none w-48 h-24 relative">
        <img alt="Wisata Budaya" class="w-full h-full object-cover rounded-lg" src="https://storage.googleapis.com/a1aa/image/3VGavBClQkuo5U6I4KMV0eFwrtGlgRdsjDWU4nix1wE.jpg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
          <span class="text-white font-semibold">
            Wisata Budaya
          </span>
        </div>
      </div>
      <div class="flex-none w-48 h-24 relative">
        <img alt="Wisata Alam" class="w-full h-full object-cover rounded-lg" src="https://storage.googleapis.com/a1aa/image/4by-qA4d5dG9_6G2n25Va4mYs5CQYYSwKn_p9UD93Jw.jpg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
          <span class="text-white font-semibold">
            Wisata Alam
          </span>
        </div>
      </div>
      <div class="flex-none w-48 h-24 relative">
        <img alt="Wisata Kuliner" class="w-full h-full object-cover rounded-lg" src="https://storage.googleapis.com/a1aa/image/XRRexir4POOZxuc7bbN_sUWm2HIlEzt5ZaM8xeOKzKE.jpg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
          <span class="text-white font-semibold">
            Wisata Kuliner
          </span>
        </div>
      </div>
    </div>
    <h2 class="text-green-600 text-2xl font-bold mt-8 mb-4">
      Rekomendasi Untuk Anda
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="relative">
        <img alt="Wisata Tenun" class="w-full h-full object-cover rounded-lg" src="https://storage.googleapis.com/a1aa/image/yrYkGu9d9EcM8H11ZBPOgkFr4sVPyhlIaI3RN1KfeO8.jpg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg">
          <span class="text-white text-lg font-semibold">
            Wisata Tenun
          </span>
          <span class="text-white text-sm">
            Sade, NTB
          </span>
        </div>
      </div>
      <div class="relative">
        <img alt="Desa Tanpa Teknologi" class="w-full h-full object-cover rounded-lg" src="https://storage.googleapis.com/a1aa/image/V97K-goht2bJ35hene5are3N6UnNdVpzwcdt1aUsWzI.jpg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg">
          <span class="text-white text-lg font-semibold">
            Desa Tanpa Teknologi
          </span>
          <span class="text-white text-sm">
            Baduy, Banten
          </span>
        </div>
      </div>
      <div class="relative">
        <img alt="Upacara Penglipuran" class="w-full h-full object-cover rounded-lg" src="https://storage.googleapis.com/a1aa/image/SQtK5s9v8dhFHXD5pa5_2u_qO6Dd_Xb5jp-UfhIAITI.jpg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg">
          <span class="text-white text-lg font-semibold">
            Upacara Penglipuran
          </span>
          <span class="text-white text-sm">
            Penglipuran, Bali
          </span>
        </div>
      </div>
      <div class="relative">
        <img alt="Wisata Gerabah" class="w-full h-full object-cover rounded-lg" src="https://storage.googleapis.com/a1aa/image/lmG-LW7q2gSLhCKr1vM6NWMtvK-2q5e9iQQ6ztITh2s.jpg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg">
          <span class="text-white text-lg font-semibold">
            Wisata Gerabah
          </span>
          <span class="text-white text-sm">
            Kasongan, Yogyakarta
          </span>
        </div>
      </div>
      <div class="relative">
        <img alt="Rumah Adat Mbaru Niang" class="w-full h-full object-cover rounded-lg" src="https://storage.googleapis.com/a1aa/image/F1IF2xmW5jJPN7l7uX1zmmCc3nfaVFI1i1L3IJQgzb4.jpg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg">
          <span class="text-white text-lg font-semibold">
            Rumah Adat Mbaru Niang
          </span>
          <span class="text-white text-sm">
            Wae Rebo, NTT
          </span>
        </div>
      </div>
      <div class="relative">
        <img alt="Wisata Gamelan" class="w-full h-full object-cover rounded-lg" src="https://storage.googleapis.com/a1aa/image/FUsJ7CcnqzP3xfgqbtJH3IfU2ddpgAAH23hmILCdJFk.jpg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg">
          <span class="text-white text-lg font-semibold">
            Wisata Gamelan
          </span>
          <span class="text-white text-sm">
            Pentinggiran, Yogyakarta
          </span>
        </div>
      </div>
    </div>

    <!-- News Section -->
    <div class="container mx-auto px-8 py-4">
      <h2 class="text-2xl font-bold text-green-700 mb-2">Berita Terbaru</h2>
      <p class="text-gray-500 mb-6">20 Feb 2025</p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- News Item 1 -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
          <img alt="Breaking news with a person speaking and a banner text" class="w-full h-48 object-cover" src="https://storage.googleapis.com/a1aa/image/ynC9wgHc_9taG6EieJcRF69khqShNB7S2-cFQR_zyJM.jpg" />
          <div class="p-4 flex flex-col justify-between flex-grow">
            <div>
              <div class="flex items-center text-gray-500 text-sm mb-2">
                <i class="far fa-calendar-alt mr-2"></i><span>24 Oct, 2021</span>
                <i class="far fa-comments ml-4 mr-2"></i><span>136 COMMENTS</span>
              </div>
              <h4 class="text-lg font-bold text-green-700 mb-2">Penghapusan Piutang UMKM</h4>
              <p class="text-gray-700 line-clamp-4 mb-4">
                Presiden Prabowo teken Peraturan Pemerintah (PP) Nomor 47 Tahun 2024 tentang Penghapusan Piutang Macet kepada Usaha Mikro Kecil dan Menengah. Meskipun begitu, tidak semua utang UMKM dapat dihapus. Ada sejumlah kriteria untuk utang UMKM yang dapat dihapus. Apa saja?
              </p>
            </div>
            <div class="flex items-center justify-between mt-4">
              <!-- Source -->
              <div class="flex items-center gap-2 text-gray-500 text-sm">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Logo_Kompasdotcom.png" alt="Kompas.com" class="h-5 w-auto" />
                <span>Kompas.com</span>
              </div>
              <!-- Button -->
              <a href="#" class="bg-[#1A936F] text-white px-4 py-2 rounded hover:bg-green-800 transition font-semibold text-sm">
                Baca Selengkapnya
              </a>
            </div>
          </div>
        </div>
        <!-- News Item 2 -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
          <img alt="People working in a traditional market" class="w-full h-48 object-cover" src="https://m.media-amazon.com/images/I/61MjSx1VBBL.jpg" />
          <div class="p-4 flex flex-col justify-between flex-grow">
            <div>
              <div class="flex items-center text-gray-500 text-sm mb-2">
                <i class="far fa-calendar-alt mr-2"></i><span>24 Oct, 2021</span>
                <i class="far fa-comments ml-4 mr-2"></i><span>136 COMMENTS</span>
              </div>
              <h4 class="text-lg font-bold text-green-700 mb-2">BRI Ungkap UMKM Mulai Membaik</h4>
              <p class="text-gray-700 line-clamp-4 mb-4">
                PT. Bank Rakyat Indonesia (Persero) Tbk dalam Indeks Bisnis UMKM Triwulan II 2024 melihat bahwa ekspansi bisnis UMKM mulai membaik. Hal ini tercermin dari Indeks Bisnis UMKM pada Triwulan II 2024 yang tercatat di level 109.9, atau meningkat dari 102.9 pada kuartal sebelumnya.
              </p>
            </div>
            <div class="flex items-center justify-between mt-4">
              <!-- Source -->
              <div class="flex items-center gap-2 text-gray-500 text-sm">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Logo_Kompasdotcom.png" alt="Kompas.com" class="h-5 w-auto" />
                <span>Kompas.com</span>
              </div>
              <!-- Button -->
              <a href="#" class="bg-[#1A936F] text-white px-4 py-2 rounded hover:bg-green-800 transition font-semibold text-sm">
                Baca Selengkapnya
              </a>
            </div>
          </div>
        </div>
        <!-- News Item 3 -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
          <img alt="Students attending a seminar" class="w-full h-48 object-cover" src="https://m.media-amazon.com/images/I/61MjSx1VBBL.jpg" />
          <div class="p-4 flex flex-col justify-between flex-grow">
            <div>
              <div class="flex items-center text-gray-500 text-sm mb-2">
                <i class="far fa-calendar-alt mr-2"></i><span>24 Oct, 2021</span>
                <i class="far fa-comments ml-4 mr-2"></i><span>136 COMMENTS</span>
              </div>
              <h4 class="text-lg font-bold text-green-700 mb-2">Dorong UMKM dengan Legalitas NIB</h4>
              <p class="text-gray-700 line-clamp-4 mb-4">
                Mahasiswa KKN Unsoed 2025 melaksanakan sosialisasi dan pendampingan pembuatan NIB bagi pelaku UMKM di Desa Sipendawa, Rabu, 15 Januari 2025.
              </p>
            </div>
            <div class="flex items-center justify-between mt-4">
              <!-- Source -->
              <div class="flex items-center gap-2 text-gray-500 text-sm">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Logo_Kompasdotcom.png" alt="Kompas.com" class="h-5 w-auto" />
                <span>Kompas.com</span>
              </div>
              <!-- Button -->
              <a href="#" class="bg-[#1A936F] text-white px-4 py-2 rounded hover:bg-green-800 transition font-semibold text-sm">
                Baca Selengkapnya
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Static Pagination Berita -->
    <section class="py-8 px-4">
      <div class="flex justify-center items-center space-x-2 flex-wrap">
        <button class="bg-[#1A936F] text-white px-4 py-2 rounded-md shadow-md flex items-center gap-2">
          <i class="fas fa-chevron-left"></i> Prev
        </button>
        <div class="flex space-x-2">
          <button class="bg-[#1A936F] text-white px-4 py-2 rounded-md shadow-md">
            1
          </button>
          <button class="bg-white text-green-500 px-4 py-2 rounded-md border border-green-500">
            2
          </button>
          <button class="bg-white text-green-500 px-4 py-2 rounded-md border border-green-500">
            3
          </button>
          <button class="bg-white text-green-500 px-4 py-2 rounded-md border border-green-500">
            4
          </button>
          <button class="bg-white text-green-500 px-4 py-2 rounded-md border border-green-500">
            5
          </button>
        </div>
        <button class="bg-[#1A936F] text-white px-4 py-2 rounded-md shadow-md flex items-center gap-2">
          Next <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </section>
  </div>
</body>
@endsection
