@extends('layouts.master')

@section('title', 'About Us')

@section('content')
<div class="bg-white">
  <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-16">
    <!-- TENTANG KAMI -->
    <section class="mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-green-600 mb-8 text-center">
        Tentang Kami
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <p class="text-lg text-gray-700 leading-relaxed text-justify">
          <span class="font-bold">DesaGo</span> hadir sebagai solusi digital untuk meningkatkan transparansi dan keterlibatan masyarakat
          dalam pembangunan desa. Kami menyediakan akses mudah ke informasi alokasi dana desa, profil dan potensi desa,
          perkembangan melalui grafik interaktif, layanan pengaduan, serta berita terkini. Dengan platform ini, kami
          berkomitmen untuk menciptakan desa yang lebih terbuka, maju, dan berdaya saing melalui teknologi yang mudah
          diakses oleh semua lapisan masyarakat.
        </p>
        <div class="flex justify-center">
          <img
            src="image/Ilustrasi.png"
            alt="Illustration of a person waving"
            class="w-full max-w-sm"
          />
        </div>
      </div>
    </section>
  </div>

  <!-- KENAPA MENGGUNAKAN DESAGO? dengan background full-width -->
  <section class="bg-gray-100">
    <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-16">
      <h2 class="text-2xl md:text-3xl font-bold text-green-600 mb-8 text-center">
        Kenapa menggunakan DesaGo?
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <ul class="text-lg text-gray-700 leading-relaxed list-disc list-inside text-justify">
          <li>Satu Platform, Semua Informasi Desa dalam Genggaman!</li>
          <li>Pantau alokasi dan penggunaan dana desa secara real-time &amp; terbuka.</li>
          <li>Kenali lebih dekat profil desa, UMKM lokal, dan destinasi wisata yang menawan.</li>
          <li>Lihat kemajuan desa melalui grafik interaktif yang mudah dipahami.</li>
          <li>Sampaikan aspirasi &amp; keluhan dengan mudah, demi desa yang lebih baik.</li>
          <li>Dapatkan update terbaru tentang kebijakan, acara, dan perkembangan desa.</li>
        </ul>
        <div class="flex justify-center">
          <img
            src="image/Thinking face-cuate 1.png"
            alt="Illustration of a person thinking"
            class="w-full max-w-sm"
          />
        </div>
      </div>
    </div>
  </section>

  <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-16">
    <!-- BEBERAPA DESA TELAH MENGGUNAKANNYA -->
    <section class="mb-16">
        <h2 class="text-2xl md:text-3xl font-bold text-green-600 mb-8 text-center">
          Beberapa desa telah menggunakannya secara mandiri di
        </h2>
        <div class="flex flex-wrap justify-center gap-8">
          <!-- Contoh blok kabupaten -->
          <div class="text-center">
            <img
              src="image/konawekab 1.png"
              alt="Logo KAB. BANGKA SELATAN"
              class="w-24 h-24 mx-auto"
            />
            <p class="mt-2 font-semibold">KAB. BANGKA SELATAN</p>
            <p>201 Desa/Kelurahan</p>
          </div>
          <div class="text-center">
            <img
              src="image/konawekab 1.png"
              alt="Logo KAB. BANGKA SELATAN"
              class="w-24 h-24 mx-auto"
            />
            <p class="mt-2 font-semibold">KAB. BANGKA SELATAN</p>
            <p>201 Desa/Kelurahan</p>
          </div>
          <div class="text-center">
            <img
              src="image/konawekab 1.png"
              alt="Logo KAB. BANGKA SELATAN"
              class="w-24 h-24 mx-auto"
            />
            <p class="mt-2 font-semibold">KAB. BANGKA SELATAN</p>
            <p>201 Desa/Kelurahan</p>
          </div>
          <!-- Tambahkan blok lain sesuai kebutuhan -->
        </div>
      </section>

  </div>

  <!-- DIDUKUNG OLEH dengan background full-width -->
  <section class="bg-gray-100">
    <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-16">
      <h2 class="text-2xl md:text-3xl font-bold text-green-600 mb-8 text-center">
        Didukung Oleh
      </h2>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 justify-items-center">
        <!-- Contoh blok sponsor -->
        <div>
          <img
            src="image/Logo_Institut_Teknologi_Bandung 7.png"
            alt="Logo of Institut Teknologi Bandung"
            class="w-24 h-24 mx-auto"
          />
        </div>
        <div>
          <img
            src="image/Logo_Institut_Teknologi_Bandung 7.png"
            alt="Logo of Institut Teknologi Bandung"
            class="w-24 h-24 mx-auto"
          />
        </div>
        <div>
          <img
            src="image/Logo_Institut_Teknologi_Bandung 7.png"
            alt="Logo of Institut Teknologi Bandung"
            class="w-24 h-24 mx-auto"
          />
        </div>
        <div>
          <img
            src="image/Logo_Institut_Teknologi_Bandung 7.png"
            alt="Logo of Institut Teknologi Bandung"
            class="w-24 h-24 mx-auto"
          />
        </div>
        <!-- Tambahkan blok lain sesuai kebutuhan -->
      </div>
    </div>
  </section>
</div>
@endsection
