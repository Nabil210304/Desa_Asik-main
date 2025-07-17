@extends('layouts.master')

@section('title', 'Wisata Tenun Desa Sade')

@section('content')
  <!-- Hero Section -->
  <section class="relative w-full h-56 sm:h-64 md:h-72 lg:h-80 xl:h-96">
    <img
      src="https://storage.googleapis.com/a1aa/image/2ac71962-d029-4d16-516d-d76fbc22acc3.jpg"
      alt="Traditional village huts"
      class="w-full h-full object-cover"
    />
    <h1 class="absolute inset-0 flex items-center justify-center text-white font-semibold text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl">
      Wisata Tenun Desa Sade
    </h1>
  </section>

  <!-- Tabs Interaktif dengan Alpine.js -->
<div x-data="{ openTab: 1 }" class="max-w-4xl mx-auto mt-4 px-4 rounded-md text-xs sm:text-sm font-semibold select-none">
    <!-- Tab Menu -->
    <ul class="flex border-b border-red-600 text-center">
      <template x-for="(label, index) in ['RINGKASAN', 'INFORMASI DASAR', 'GAMBAR', 'KONTAK', 'GRAFIK KUNJUNGAN']" :key="index">
        <li
          x-on:click="openTab = index + 1"
          :class="{
            'bg-white font-bold text-black': openTab === index + 1,
            'text-black bg-white': openTab !== index + 1
          }"
          class="border border-red-600 rounded-lg px-3 py-1 cursor-pointer transition-all duration-200"
          x-text="label"
        ></li>
      </template>
    </ul>

    <!-- Tab Content -->
    <div class="border-l border-r border-b border-red-600 bg-white shadow-md p-6 min-h-[160px] text-gray-800">
      <template x-if="openTab === 1">
        <div>
          <h2 class="text-red-600 font-semibold text-lg mb-2">RINGKASAN</h2>
          <p>Desa Sade adalah desa tradisional yang terletak di Lombok Tengah, Nusa Tenggara Barat, dan menjadi rumah bagi suku Sasak. Desa ini terkenal karena berhasil mempertahankan adat istiadat serta budaya leluhur yang masih dijalankan hingga kini. Salah satu daya tarik utama Desa Sade adalah kain tenun khas Sasak yang dibuat oleh para perempuan desa dengan teknik tradisional yang diwariskan secara turun-temurun.
            Rumah-rumah di Desa Sade dibangun menggunakan bahan alami seperti bambu, kayu, dan atap ilalang, mencerminkan kesederhanaan serta keterikatan mereka dengan alam. Pengunjung yang datang dapat melihat langsung proses pembuatan kain tenun, menyaksikan kehidupan masyarakat lokal, dan memahami lebih dalam budaya serta nilai-nilai yang dijunjung tinggi oleh suku Sasak. Desa ini menjadi destinasi budaya yang menarik bagi wisatawan yang ingin merasakan nuansa Lombok yang autentik.</p>
        </div>
      </template>

      <template x-if="openTab === 2">
        <div>
          <h2 class="text-red-600 font-semibold text-lg mb-2">INFORMASI DASAR</h2>
          <p>Berisi detail umum seperti lokasi, jam buka, dan harga tiket.</p>
        </div>
      </template>

      <template x-if="openTab === 3">
        <div>
          <h2 class="text-red-600 font-semibold text-lg mb-2">GAMBAR</h2>
          <p>Koleksi foto dari lokasi wisata.</p>
        </div>
      </template>

      <template x-if="openTab === 4">
        <div>
          <h2 class="text-red-600 font-semibold text-lg mb-2">KONTAK</h2>
          <p>Informasi kontak pengelola atau layanan informasi.</p>
        </div>
      </template>

      <template x-if="openTab === 5">
        <div>
          <h2 class="text-red-600 font-semibold text-lg mb-2">GRAFIK KUNJUNGAN</h2>
          <p>Statistik kunjungan ke lokasi dalam grafik.</p>
        </div>
      </template>
    </div>
  </div>

  <!-- Alpine.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <!-- Reviews Section -->
  <main class="max-w-6xl mx-auto px-6 mt-8">
    <div class="flex justify-between items-center mb-4">
      <h2 class="font-semibold text-base sm:text-lg">Ulasan</h2>
      <button type="button" class="bg-green-700 text-white text-xs sm:text-sm px-3 py-1 rounded-md flex items-center gap-1">
        <i class="fas fa-plus"></i> Tambahkan Ulasan
      </button>
    </div>

    <section class="space-y-10">
      @for ($i = 0; $i < 3; $i++)
        <article class="flex flex-col md:flex-row md:space-x-6">
          <div class="flex flex-col space-y-1 md:w-1/3">
            <p class="text-blue-600 text-xs sm:text-sm font-semibold">10/10 Luar Biasa</p>
            <p class="text-xs sm:text-sm font-semibold">Vemas Adi Pratama dari Desa Bogares Kidul, Tegal</p>
            <p class="text-xs text-gray-600">24 Agustus 2024  10.31</p>
          </div>
          <div class="bg-gray-300 md:w-2/3 p-4 rounded-sm text-sm sm:text-base leading-tight text-gray-900">
            <p class="font-semibold mb-2">Produk Berkualitas Tinggi, Ramah Lingkungan!</p>
            <p>Saya sangat terkesan dengan produk-produk dari Kejaya Handicraft! Dari segi kualitas,
            bahan yang digunakan sangat premium, terutama karena mereka memanfaatkan bahan alami
            seperti batok kelapa, bambu, dan rotan. Saya membeli sebuah tas batok kelapa, dan
            hasilnya sungguh luar biasa – desainnya unik, finishing-nya halus, dan yang paling
            penting, sangat ramah lingkungan.</p>
          </div>
        </article>
      @endfor
    </section>

    <!-- Pagination -->
    <nav aria-label="Pagination" class="flex justify-center items-center space-x-2 mt-12 mb-20 text-xs sm:text-sm font-semibold select-none">
      <button class="bg-green-700 text-white rounded-md px-4 py-2">Prev</button>
      <button class="border border-gray-300 rounded-md px-4 py-2" aria-current="page">1</button>
      <button class="border border-gray-300 rounded-md px-4 py-2">2</button>
      <button class="border border-gray-300 rounded-md px-4 py-2">3</button>
      <span class="text-gray-500 select-none">...</span>
      <button class="border border-gray-300 rounded-md px-4 py-2">10</button>
      <button class="bg-green-700 text-white rounded-md px-4 py-2">Next</button>
    </nav>
  </main>
@endsection
