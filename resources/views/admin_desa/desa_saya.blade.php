@extends('layouts.master')

@section('title', 'Profil Desa Spesifik')

@section('content')
<div class="max-w-6xl mx-auto p-4" x-data="{ open: false }">
@if(isset($profil) && $profil->nama_desa)
    <h1 class="text-3xl font-bold mb-4">{{ $profil->nama_desa }}</h1>
@else
    <h1 class="text-3xl font-bold mb-4">Nama Desa</h1>
@endif


   <!-- Dropdown Edit -->
<div class="relative inline-block text-left mb-4" x-data="{ open: false }">
    <button @click="open = !open" class="text-blue-500 hover:text-blue-700 focus:outline-none">
        <i class="fas fa-edit"></i> Edit
    </button>

    <div x-show="open" x-cloak @click.away="open = false"
         class="absolute mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
        <div class="py-1">
            <a href="/v_edit_desa_saya/{{$profil->id_desa}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Informasi Umum Desa
            </a>
            <a href="/v_data_pemasukan/{{$profil->id_desa}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Data Dana Pemasukan
            </a>
            <a href="/data_pengeluaran_desa/{{$profil->id_desa}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Data Dana Pengeluaran
            </a>
        </div>
    </div>
</div>

<!-- Gambar Utama dan Thumbnail -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <!-- Gambar Utama -->
    <div class="md:col-span-2">
        <img id="mainImage" class="w-full h-auto rounded-lg cursor-pointer"
             src="{{ asset($profil->foto ?? 'dumy_desa.jpg') }}"
             alt="Main Image" onclick="openModal(this.src)">
    </div>

 <div class="max-h-[500px] overflow-y-auto flex flex-col space-y-4 pr-2">
    @php
        $fotoList = [
            $profil->foto ?? null,
            $profil->foto2 ?? null,
            $profil->foto3 ?? null,
            $profil->foto4 ?? null,
            $profil->foto5 ?? null,
            $profil->foto6 ?? null,
        ];
    @endphp

    @foreach($fotoList as $index => $foto)
        <img class="w-full h-auto rounded-lg cursor-pointer"
             src="{{ asset($foto ?? 'dumy_desa.jpg') }}"
             onclick="changeMainImage(this.src)"
             alt="Thumbnail {{ $index + 1 }}">
    @endforeach
</div>
</div>

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 justify-center items-center hidden" onclick="closeModal(event)">
        <div class="relative">
            <img id="modalImage" class="max-w-screen-lg max-h-screen-lg rounded-lg" src="" alt="Expanded Image">
            <button onclick="closeModal(event)" class="absolute top-2 right-2 bg-white text-black p-2 rounded-full">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Tentang Desa</h2>
        <p class="text-justify">
            @if(isset($profil) && $profil->deskripsi)
           {{$profil->deskripsi}}
           @else
         Ciputri adalah desa di kecamatan Pacet, Cianjur, Jawa Barat, Indonesia. Nama Desa Ciputri diambil dari kata "cai" dan "putri" yang artinya tempat pemandian para putri di masa lampau. Desa Ciputri kaya akan sumber daya pertanian, dan sejak 2018, Desa Ciputri mulai mengembangkan kopi yang berasal dari biji kopi arabika yang ditanam langsung dari lahan di Desa Ciputri. Semua Desa Ciputri secara administratif termasuk ke dalam wilayah Desa Cibereum, Kecamatan Pacet, Cianjur, namun sering terpisahkan karena perbedaan administrasi. Sejak tahun 1978, Desa Ciputri dengan desa Induk Cibereum diindahkan. Pemekaran Desa Ciputri juga disebabkan terlalu luasnya Desa Induk Cibereum dan terlalu banyaknya penduduk dalam satu desa.
       @endif
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Visi</h2>
        <p class="text-center">
             @if(isset($profil) && $profil->visi)
             {{$profil->visi}}
             @else
         Mewujudkan Desa Ciputri yang Mandiri, Sejahtera, dan Berkelanjutan Berbasis Kearifan Lokal serta Teknologi.
       @endif
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Misi</h2>
        <p class="text-justify">
             @if(isset($profil) && $profil->misi)
             {{$profil->misi}}
             @else
         Desa Ciputri berkomitmen untuk memberdayakan ekonomi masyarakat melalui pengembangan sektor pertanian, peternakan, dan UMKM yang inovatif. Peningkatan kualitas pendidikan dan layanan kesehatan juga menjadi prioritas guna menciptakan sumber daya manusia yang unggul dan sehat. Selain itu, desa akan menjaga sumber daya alam secara berkelanjutan dengan menjaga keseimbangan ekosistem dan memanfaatkan potensi alam secara bijak. Dalam bidang infrastruktur yang memadai dan mempermudah aksesibilitas, serta transparansi dalam pengelolaan ekonomi dan pemerintahan desa. Dengan ini, kita telah memerintahkan desa yang transparan dan partisipatif akan diperkuat dengan memanfaatkan teknologi informasi dalam pelayanan publik.
        @endif
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Informasi General</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
         <table class="table-auto w-full border-collapse border border-gray-300">
          <tbody>
           <tr>
            <td class="border border-gray-300 p-2">Kecamatan</td>
             @if(isset($profil) && $profil->kecamatan)
             <td class="border border-gray-300 p-2">{{$profil->kecamatan}}</td>
             @else
            <td class="border border-gray-300 p-2">Isi kecamatan</td>
            @endif
           </tr>
           <tr>
            <td class="border border-gray-300 p-2">Kabupaten</td>
                @if(isset($profil) && $profil->kabupaten)
            <td class="border border-gray-300 p-2"> {{$profil->kabupaten}}</td>
            @else
 <td class="border border-gray-300 p-2"> isi kabupaten</td>
 @endif
           </tr>

           <tr>
            <td class="border border-gray-300 p-2">Luas Wilayah</td>
             @if(isset($profil) && $profil->luas_km)
               <td class="border border-gray-300 p-2">{{$profil->luas_km}}<sup></sup></td>
               @else
            <td class="border border-gray-300 p-2"> isi wilayah <sup></sup></td>
            @endif
           </tr>

           <tr>

      <td class="border border-gray-300 p-2">Jumlah Penduduk tahun ini</td>
<td class="border border-gray-300 p-2">
    @if(
        isset($profil->jumlah_laki_laki, $profil->jumlah_perempuan,
              $profil->jumlah_penduduk_kurang_10tahun, $profil->jumlah_penduduk_kurang_20tahun,
              $profil->jumlah_penduduk_kurang_50tahun, $profil->jumlah_penduduk_lebih_50tahun)
    )
        {{ number_format(
            (int)$profil->jumlah_laki_laki +
            (int)$profil->jumlah_perempuan +
            (int)$profil->jumlah_penduduk_kurang_10tahun +
            (int)$profil->jumlah_penduduk_kurang_20tahun +
            (int)$profil->jumlah_penduduk_kurang_50tahun +
            (int)$profil->jumlah_penduduk_lebih_50tahun
        ) }}
    @else
        <span class="text-red-500 italic">Data belum lengkap</span>
    @endif
</td>

           </tr>

           <tr>
            <td class="border border-gray-300 p-2">Kontak Desa</td>
              @if(isset($profil) && $profil->kontak_desa)
               <td class="border border-gray-300 p-2">{{$profil->kontak_desa}}<sup></sup></td>
               @else
            <td class="border border-gray-300 p-2"> isi nomer <sup></sup></td>
            @endif

           </tr>
          </tbody>
         </table>
         @if(isset($profil) && $profil->link_map)
    @if(Str::contains($profil->link_map, '<iframe'))
        {!! $profil->link_map !!}
    @else
        <iframe src="{{ $profil->link_map }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    @endif
@else
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63391.45988713537!2d106.993210091215!3d-6.773963214975532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69b339dc734857%3A0xb0ba0b9085544f34!2sCiputri%2C%20Kec.%20Pacet%2C%20Kabupaten%20Cianjur%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1743430742294!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
       @endif
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Info Demografis</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="w-full md:w-96 mx-auto">
                <canvas id="genderChart"></canvas>
            </div>
            <div class="w-full md:max-w-6xl mx-auto">
                <canvas id="ageChart"></canvas>
            </div>
        </div>
    </section>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-8">Perangkat Desa</h1>
        <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-8">





          <!-- Kepala Desa -->
          <div class="relative bg-white rounded-xl shadow-md overflow-hidden w-64 transition-transform transform hover:scale-105 hover:shadow-2xl group">
             @if(isset($profil) && $profil->foto_kades)
                       <img class="w-full h-96 object-cover"     src="{{asset($profil->foto_kades)}}"alt="Kepala Desa Ciputri" />
           @else
                       <img class="w-full h-96 object-cover"     src="{{asset('dumy_user.jpg')}}"alt="Kepala Desa Ciputri" />
                       @endif
            <div class="absolute inset-0 flex flex-col justify-center items-center bg-gray-900 bg-opacity-50 text-white text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-lg font-semibold">Kepala Desa </p>

            </div>
            <div class="absolute bottom-[-10px] left-1/2 transform -translate-x-1/2 bg-white p-4 rounded-lg shadow-lg w-48 text-center">
              <i class="fab fa-linkedin text-blue-700 text-2xl mb-2 border-2 border-transparent rounded-full p-1 transition duration-300 hover:border-blue-700"></i>
                 @if(isset($profil) && $profil->nama_kepala_desa)
              <p class="font-bold text-lg">{{$profil->nama_kepala_desa}}</p>
              @else
               <p class="font-bold text-lg">ISI KEPALA DESA</p>
               @endif
              <div class="w-12 h-1 bg-green-600 mx-auto mt-1 group-hover:bg-green-700 transition-colors"></div>
              <p class="text-gray-600 text-sm">Kepala Desa</p>
            </div>
          </div>

          <!-- Wakil Kepala Desa -->
          <div class="relative bg-white rounded-xl shadow-md overflow-hidden w-64 transition-transform transform hover:scale-105 hover:shadow-2xl group">
             @if(isset($profil) && $profil->nama_wakil_kepala_desa)
          <img class="w-full h-96 object-cover" src="{{asset($profil->foto_wades)}}"alt="Wakil Kepala Desa" />
@else
          <img class="w-full h-96 object-cover" src="{{asset('dumy_user.jpg')}}"alt="Wakil Kepala Desa" />
          @endif
            <div class="absolute inset-0 flex flex-col justify-center items-center bg-gray-900 bg-opacity-50 text-white text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-lg font-semibold">Wakil Kepala Desa</p>
            </div>
            <div class="absolute bottom-[-10px] left-1/2 transform -translate-x-1/2 bg-white p-4 rounded-lg shadow-lg w-48 text-center">
              <i class="fab fa-linkedin text-blue-700 text-2xl mb-2 border-2 border-transparent rounded-full p-1 transition duration-300 hover:border-blue-700"></i>
             @if(isset($profil) && $profil->nama_wakil_kepala_desa)
              <p class="font-bold text-lg">{{$profil->nama_wakil_kepala_desa}}</p>
              @else
              <p class="font-bold text-lg">Isi Wakil Kepala Desa</p>
              @endif
              <div class="w-12 h-1 bg-green-600 mx-auto mt-1 group-hover:bg-green-700 transition-colors"></div>
              <p class="text-gray-600 text-sm">Wakil Kepala Desa</p>
            </div>
          </div>

        </div>

        <section class="py-12">
            <h3 class="text-2xl font-bold mb-8">Potensi Ekonomi</h3>
            <div class="flex flex-wrap justify-center gap-8">
                <!-- Desa 1 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full md:w-80 flex flex-col h-full border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img alt="Image of Desa Ciputri" class="w-full h-40 object-cover" src="https://storage.googleapis.com/a1aa/image/ub2EA4LsBTbNwmUsE92r-j03EdrAaTKm5I1eYjv3USQ.jpg"/>
                    <div class="p-4 flex flex-col justify-between h-full">
                        <h4 class="text-xl font-bold mb-2">Desa Ciputri</h4>
                        <p class="text-gray-600 min-h-[70px] line-clamp-3">
                            Temukan berbagai desa dengan pesona khasnya. Setiap desa memiliki cerita, budaya, dan keindahan yang siap dijelajahi. Nikmati wisata, tradisi, dan keramahan lokal yang menunggu untuk dieksplorasi!
                        </p>
                        <button class="bg-[#1A936F] text-white px-6 py-3 w-full rounded-lg shadow-md font-bold flex items-center justify-center gap-2 mt-4 transition-all duration-300 hover:bg-green-600 active:scale-95">
                            Lihat <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Desa 2 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full md:w-80 flex flex-col h-full border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img alt="Image of Desa Balamoa" class="w-full h-40 object-cover" src="https://storage.googleapis.com/a1aa/image/d-5LEhTV24q-tNEE_XJARHidZRyEKw_ULXYYz1sWiBM.jpg"/>
                    <div class="p-4 flex flex-col justify-between h-full">
                        <h4 class="text-xl font-bold mb-2">Desa Balamoa</h4>
                        <p class="text-gray-600 min-h-[70px] line-clamp-3">
                            Desa ini terkenal dengan kegiatan gotong royong yang masih sangat kental.
                        </p>
                        <button class="bg-[#1A936F] text-white px-6 py-3 w-full rounded-lg shadow-md font-bold flex items-center justify-center gap-2 mt-4 transition-all duration-300 hover:bg-green-600 active:scale-95">
                            Lihat <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Desa 3 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full md:w-80 flex flex-col h-full border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img alt="Image of Desa Pangkeh" class="w-full h-40 object-cover" src="https://storage.googleapis.com/a1aa/image/ChYA6kQyiiJDzSeSaF-zFvtHIUBkVcLbZNcSXODqkbs.jpg"/>
                    <div class="p-4 flex flex-col justify-between h-full">
                        <h4 class="text-xl font-bold mb-2">Desa Pangkeh</h4>
                        <p class="text-gray-600 min-h-[70px] line-clamp-3">
                            Desa ini memiliki berbagai produk kerajinan tangan yang unik dan berkualitas. Banyak wisatawan yang datang untuk membeli kerajinan khas desa ini.
                        </p>
                        <button class="bg-[#1A936F] text-white px-6 py-3 w-full rounded-lg shadow-md font-bold flex items-center justify-center gap-2 mt-4 transition-all duration-300 hover:bg-green-600 active:scale-95">
                            Lihat <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12">

         </section>
        <h2 class="text-2xl font-bold mt-12 mb-4">Rincian Pengeluaran Dana Desa</h2>
        <!-- 3 Item Sejajar -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
  <!-- Total Pemasukan -->
  <div class="bg-green-100 border border-green-300 rounded-lg p-4 shadow">
    <h3 class="text-lg font-semibold text-green-800">Total Pemasukan</h3>
    <p class="text-xl font-bold text-green-900">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
  </div>

  <!-- Total Pengeluaran -->
  <div class="bg-red-100 border border-red-300 rounded-lg p-4 shadow">
    <h3 class="text-lg font-semibold text-red-800">Total Pengeluaran</h3>
    <p class="text-xl font-bold text-red-900">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
  </div>

  <!-- Saldo -->
  <div class="bg-blue-100 border border-blue-300 rounded-lg p-4 shadow">
    <h3 class="text-lg font-semibold text-blue-800">Saldo</h3>
    <p class="text-xl font-bold text-blue-900">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
  </div>
</div>
        <!-- buatkam 3 item sejajar untuk total pemasukan total penegeluaran saldo -->
            <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200">
                <table class="min-w-full leading-normal">
      <thead>
       <tr class="bg-gray-100">

        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Nama
        </th>


        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Jumlah
        </th>
        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Deskripsi
        </th>
         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
       Tahun
        </th>
         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Bulan
        </th>
         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         kuitansi
        </th>
         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Status
        </th>
        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Action
        </th>
       </tr>
      </thead>
      <tbody>
      <tbody>
    @foreach($pengeluaran as $item)
    <tr class="{{ $loop->even ? 'bg-purple-50' : '' }}">

        <td class="px-5 py-5 border-b border-gray-200 text-sm flex items-center">

            {{ $item->nama }}
        </td>

        <td class="px-5 py-5 border-b border-gray-200 text-sm">
               Rp{{ number_format($item->jumlah, 0, ',', '.') }}
        </td>

        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{ $item->deskripsi }}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{ $item->tahun }}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{ $item->bulan }}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            @if($item->kuitansi)
          <a href="{{ asset($item->kuitansi) }}" target="_blank" class="text-blue-500 underline">Lihat</a>

            @else
                <span class="text-gray-400">Tidak ada</span>
            @endif
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{$item->status}}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            <a href="/edit_pengluaran/{{ $item->id}}" class="text-blue-500 hover:text-blue-700 mr-2">
                <i class="fas fa-edit"></i>
            </a>

        </td>
    </tr>
    @endforeach
</tbody>

     </table>
         </div>

       <h2 class="text-2xl font-bold mt-12 mb-4">Rincian Pengeluaran Dana Desa</h2>
        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200">
        <!-- 3 Item Sejajar -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <table class="min-w-full leading-normal">
      <thead>
       <tr class="bg-gray-100">

        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Nama
        </th>


        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Jumlah
        </th>
        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Deskripsi
        </th>
         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
       Tahun
        </th>

         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         kuitansi
        </th>

        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Action
        </th>
       </tr>
      </thead>
      <tbody>
      <tbody>
    @foreach($pemasukan as $item)
    <tr class="{{ $loop->even ? 'bg-purple-50' : '' }}">

        <td class="px-5 py-5 border-b border-gray-200 text-sm flex items-center">

            {{ $item->nama }}
        </td>

        <td class="px-5 py-5 border-b border-gray-200 text-sm">
               Rp{{ number_format($item->jumlah, 0, ',', '.') }}
        </td>

        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{ $item->deskripsi }}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{ $item->tahun }}
        </td>

        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            @if($item->kuitansi)
          <a href="{{ asset($item->kuitansi) }}" target="_blank" class="text-blue-500 underline">Lihat</a>

            @else
                <span class="text-gray-400">Tidak ada</span>
            @endif
        </td>

        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            <a href="/edit_pemasukan/{{ $item->id}}" class="text-blue-500 hover:text-blue-700 mr-2">
                <i class="fas fa-edit"></i>
            </a>

        </td>
    </tr>
    @endforeach
</tbody>

     </table>
         </div>
            </div>
    </div>
</div>
<section class="mb-8">




            <div class="w-full md:max-w-6xl mx-auto justify-center">
                   <h2 class="text-2xl font-bold mb-2">Grafik uang</h2>
             <canvas id="lineChart"></canvas>
            </div>

    </section>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-boxplot@4.1.0/dist/chartjs-chart-boxplot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-box-and-violin-plot/build/Chart.BoxPlot.min.js"></script>

   <script>
function openModal(src) {
    document.getElementById("modalImage").src = src;
    document.getElementById("imageModal").style.display = "flex";
}

function closeModal(event) {
    if (event.target.id === "imageModal" || event.target.tagName === "BUTTON") {
        document.getElementById("imageModal").style.display = "none";
    }
}

function changeMainImage(src) {
    document.getElementById("mainImage").src = src;
}

window.addEventListener('load', function () {
    // Pie Chart - Jenis Kelamin
    const genderData = {
        labels: ["Laki-laki", "Perempuan"],
        datasets: [{
            data: [{{ $profil->jumlah_laki_laki ?? 0 }}, {{ $profil->jumlah_perempuan ?? 0 }}],
            backgroundColor: ["#4F46E5", "#F59E0B"]
        }]
    };
    new Chart(document.getElementById("genderChart"), {
        type: "pie",
        data: genderData
    });

    // Bar Chart - Distribusi Usia
    const ageData = {
        labels: ["0-10", "11-20", "21-50", "50+"],
        datasets: [{
            data: [
                {{ $profil->jumlah_penduduk_kurang_10tahun ?? 0 }},
                {{ $profil->jumlah_penduduk_kurang_20tahun ?? 0 }},
                {{ $profil->jumlah_penduduk_kurang_50tahun ?? 0 }},
                {{ $profil->jumlah_penduduk_lebih_50tahun ?? 0 }}
            ],
            backgroundColor: ["#1E40AF", "#3B82F6", "#10B981", "#F59E0B"]
        }]
    };
    new Chart(document.getElementById("ageChart"), {
        type: "bar",
        data: {
            labels: ageData.labels,
            datasets: [{
                label: "Distribusi Usia",
                data: ageData.datasets[0].data,
                backgroundColor: ageData.datasets[0].backgroundColor
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });



    const normalData = @json($normal);      // array jumlah "✅ Aman"
    const outliersData = @json($outliers);  // array jumlah "🧐 Perlu Diaudit"

    // Buat label untuk sumbu X (pakai index itemnya aja)
    const maxLength = Math.max(normalData.length, outliersData.length);
    const labels = [];
    for(let i = 1; i <= maxLength; i++) {
        labels.push(i);
    }

    const data = {
        labels: labels,
        datasets: [
            {
                label: '✅ Aman',
                data: normalData,
                borderColor: 'green',
                backgroundColor: 'rgba(0,128,0,0.1)',
                fill: false,
                tension: 0.2,
                pointRadius: 5
            },
            {
                label: '🧐 Perlu Diaudit',
                data: outliersData,
                borderColor: 'red',
                backgroundColor: 'rgba(255,0,0,0.1)',
                fill: false,
                tension: 0.2,
                pointRadius: 5
            }
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Pengeluaran Desa: Status Aman dan Perlu Audit'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Data Ke-'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Pengeluaran'
                    },
                    beginAtZero: true
                }
            }
        }
    };
    // array jumlah "✅ Aman"


    new Chart(
        document.getElementById('lineChart'),
        config
    );



});

</script>


@endsection
