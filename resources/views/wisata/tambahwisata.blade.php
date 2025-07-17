<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Wisata Baru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-white text-gray-900">
  <!-- Header -->
  <header class="bg-[#4a9b85] flex justify-between items-center px-6 py-4">
    <button
      class="text-white font-semibold text-sm bg-[#4a9b85] border border-white rounded-full px-5 py-1.5 hover:bg-white hover:text-[#4a9b85] transition"
      type="button"
    >
      Kembali
    </button>
    <div class="flex items-center space-x-3">
      <img
        src="https://placehold.co/40x40/png?text=Logo"
        alt="Logo of Kementerian Desa Bangun Desa Bangun Indonesia"
        class="w-10 h-10 object-contain"
      />
      <div class="text-white text-right">
        <h1 class="font-semibold text-lg leading-tight">Kementerian Desa</h1>
        <p class="text-xs leading-tight">Bangun Desa Bangun Indonesia</p>
      </div>
    </div>
  </header>

@extends('layouts.master')

@section('title', 'Tambah Wisata')

@section('content')
 <!-- Form Container -->
 <div class="max-w-7xl mx-auto mb-10 mt-5 bg-white p-8 rounded-lg shadow-lg">
    {{-- ERROR HANDLER --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            <strong class="font-bold">⚠️ Ada yang salah:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            ✅ {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-white bg-[#48A98C] p-4 rounded-t-lg">Menambahkan Wisata Baru</h1>
    <!-- Added margin-bottom here for the gap -->
    <div class="mb-6"></div>

<form method="POST" action="{{ route('wisata.simpan') }}" enctype="multipart/form-data" id="form-desa" class="space-y-4">
    @csrf
      <!-- Nama wisata -->
      <div>
        <label for="nama-wisata" class="block text-xs font-semibold mb-1">Nama Wisata<span class="text-red-600">*</span></label>
        <input id="nama-wisata" name="nama-wisata" type="text" placeholder="Masukkan Nama Wisata"
          class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4a9b85]"
          required
        />
      </div>

      <!-- Deskripsi Wisata -->
      <div>
        <label
          for="deskripsi-wisata"
          class="block text-xs font-semibold mb-1"
          >Deskripsi Wisata<span class="text-red-600">*</span></label
        >
        <textarea
          id="deskripsi-wisata"
          name="deskripsi-wisata"
          rows="3"
          placeholder="Masukkan Deskripsi Desa"
          class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 resize-none focus:outline-none focus:ring-2 focus:ring-[#4a9b85]"
          required
        ></textarea>
      </div>

      <!-- Upload Foto Background -->
      <div>
        <label
          for="upload-background"
          class="block text-[9px] font-semibold mb-1"
          >Upload Foto Background (jpg/jpeg/png)<span class="text-red-600"
            >*</span
          ></label
        >
        <div class="flex space-x-2">
          <input
            id="upload-background"
            name="upload-background"
            type="text"
            readonly
            class="flex-grow border border-gray-300 rounded-l-md px-3 py-2 text-xs placeholder-gray-400 focus:outline-none"
            placeholder=""
          />
          <label
            for="file-background"
            class="cursor-pointer bg-[#4a9b85] text-white rounded-r-md px-6 py-2 text-xs font-semibold select-none"
            >Pilih File</label
          >
          <input
            id="file-background"
            name="file-background"
            type="file"
            accept=".jpg,.jpeg,.png"
            class="hidden"
            onchange="document.getElementById('upload-background').value = this.files[0]?.name || ''"
          />
        </div>
      </div>

      <!-- Jenis Wisata -->
      <div>
        <label
          for="jenis-wisata"
          class="block text-xs font-semibold mb-1"
          >Jenis Wisata<span class="text-red-600">*</span></label
        >
        <select
          id="jenis-wisata"
          name="jenis-wisata"
          class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4a9b85]"
          required
        >
          <option disabled selected>Jenis Wisata</option>
          <option>Alam</option>
          <option>Budaya</option>
          <option>Sejarah</option>
          <option>Rekreasi</option>
        </select>
      </div>

      <!-- Lokasi -->
      <div>
        <label
          for="lokasi"
          class="block text-xs font-semibold mb-1"
          >Lokasi<span class="text-red-600">*</span></label
        >
        <input
          id="lokasi"
          name="lokasi"
          type="text"
          placeholder="Masukkan Lokasi"
          class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4a9b85]"
          required
        />
      </div>

      <!-- Akses -->
      <div>
        <label
          for="akses"
          class="block text-xs font-semibold mb-1"
          >Akses<span class="text-red-600">*</span></label
        >
        <textarea
          id="akses"
          name="akses"
          rows="2"
          placeholder="Masukkan Akses (Misal: 1km dari bandara)"
          class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm placeholder-gray-400 resize-none focus:outline-none focus:ring-2 focus:ring-[#4a9b85]"
          required
        ></textarea>
      </div>

      <!-- Gambar -->
      <div class="flex items-center space-x-3">
        <div class="flex-grow">
          <label
            for="gambar"
            class="block text-xs font-semibold mb-1"
            >Gambar<span class="text-red-600">*</span></label
          >
          <input
            id="gambar"
            name="gambar"
            type="text"
            readonly
            placeholder="Gambar (jpg/png/jpeg)"
            class="w-full border border-gray-300 rounded-l-md px-3 py-2 text-xs placeholder-gray-400 focus:outline-none"
          />
        </div>
        <label
          for="file-gambar"
          class="cursor-pointer bg-[#4a9b85] text-white rounded-r-md px-6 py-2 text-xs font-semibold select-none"
          >Pilih File</label
        >
        <input
          id="file-gambar"
          name="file-gambar"
          type="file"
          accept=".jpg,.jpeg,.png"
          class="hidden"
          onchange="document.getElementById('gambar').value = this.files[0]?.name || ''"
        />
        <button
          type="button"
          class="bg-[#4a9b85] text-white rounded-md px-3 py-2 text-lg font-bold leading-none select-none"
          aria-label="Add more images"
        >
          +
        </button>
      </div>

      <!-- Submit button -->
      <div class="text-center mt-6">
        <button
          type="submit"
          class="bg-[#4a9b85] text-white font-semibold text-sm rounded-md px-8 py-2 hover:bg-[#3e8a75] transition"
        >
          Kirim
        </button>
      </div>
    </form>
  </main>
</body>
</html>
