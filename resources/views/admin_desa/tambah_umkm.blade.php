@extends('layouts.master')

@section('title', 'Tambah UMKM')

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

    <h1 class="text-2xl font-bold text-white bg-[#48A98C] p-4 rounded-t-lg">Menambahkan UMKM Baru</h1>
    <!-- Added margin-bottom here for the gap -->
    <div class="mb-6"></div>

            <!-- Tombol Kembali -->
        <a href="javascript:history.back()"
        class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-full shadow transition mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#1A936F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

<form method="POST" action="/admin_desa_umkm_simpan" enctype="multipart/form-data" id="form-desa" class="space-y-4">
    @csrf
      <!-- Nama UMKM -->
      <div>
        <label class="font-semibold">Nama UMKM*</label>
        <input type="text" name="nama_umkm" placeholder="Masukkan Nama UMKM" class="w-full border rounded p-2 mt-1">
      </div>

      <!-- Ringkasan UMKM -->
      <div>
        <label class="font-semibold">Ringkasan UMKM*</label>
        <textarea name="ringkasan_umkm" placeholder="Masukkan Ringkasan UMKM" class="w-full border rounded p-2 mt-1"></textarea>
      </div>

      <!-- Upload Foto -->
   <div id="foto-umkm-wrapper">
  <label class="font-semibold">Upload Foto UMKM (jpg/jpeg/png)*</label>
  <div class="flex items-center border border-gray-300 rounded overflow-hidden w-full mt-1">
    <span class="flex-1 px-3 py-2 text-gray-500 file-label">Gambar (jpg/png/jpeg)</span>
    <input type="file" name="foto_umkm[]" class="hidden file-input" accept=".jpg,.jpeg,.png"
      onchange="this.previousElementSibling.innerText = this.files[0]?.name || 'Gambar (jpg/png/jpeg)'">
    <label onclick="this.previousElementSibling.click()"
      class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">Pilih File</label>
  </div>
</div>

<!-- Tombol Tambah Foto -->
<div class="mt-2">
  <button type="button" id="tambah-foto-umkm" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
    + Tambah Foto
  </button>
</div>


  <div>

<input type="hidden" name="id_desa" value="{{$id}}">


      <!-- Alamat -->
      <div>
        <label class="font-semibold">Alamat Lengkap*</label>
        <input type="text" name="alamat_lengkap" placeholder="Masukkan Alamat Lengkap" class="w-full border rounded p-2 mt-1">
      </div>
         <div>
        <label class="font-semibold">waktu operasional*</label>
        <input type="text" name="waktu" placeholder="Masukkan seperti 09:00-15:00" class="w-full border rounded p-2 mt-1">
      </div>

      <!-- Nomor Izin -->
      <div>
        <label class="font-semibold">Nomor Izin Berusaha*</label>
        <input type="text" name="nomor_izin_berusaha" placeholder="Masukkan NIB" class="w-full border rounded p-2 mt-1">
      </div>

      <!-- No Telepon -->
      <div>
        <label class="font-semibold">No Telepon*</label>
        <input type="text" name="no_telepon" placeholder="Masukkan Nomor Telepon" class="w-full border rounded p-2 mt-1">
      </div>

      <!-- map -->
           <div>
        <label class="font-semibold">MAP*</label>
        <input type="text" name="map" placeholder="Masukkan lin map denga <iframe>" class="w-full border rounded p-2 mt-1">
      </div>

      <!-- Penghargaan -->
      <div>
        <label class="font-semibold">Tambahkan Penghargaan</label>
        <div class="flex gap-2">
           <div class="flex items-center border border-gray-300 rounded overflow-hidden w-full">
        <span id="label-foto-penghargaan" class="flex-1 px-3 py-2 text-gray-500">Gambar (jpg/png/jpeg)</span>
        <input type="file" name="foto_penghargaan[]" id="foto_penghargaan" class="hidden" accept=".jpg,.jpeg,.png"
        onchange="document.getElementById('label-foto-penghargaan').innerText = this.files[0]?.name || 'Gambar (jpg/png/jpeg)'">
        <label for="foto_penghargaan"  class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">
         Pilih File
        </label>
        </div>
          <input type="text" name="nama_penghargaan[]" placeholder="Nama Penghargaan" class="border p-2 rounded flex-1">
          <button type="button" class="tambah-penghargaan bg-green-600 text-white px-3 rounded">+</button>
        </div>
      </div>

      <!-- Kategori -->
      <div>
        <label class="font-semibold">Kategori UMKM*</label>
        <select name="kategori_umkm" class="w-full border rounded p-2 mt-1">
           <option value="">Kategori UMKM</option>
          <option value="kerajinan">Kerajinan</option>
          <option value="Makanan_Minuman">Makanan & Minuman</option>
          <option value="Pertenakan_Perkebunan">Pertenakan & Perkebunan</option>
          <option value="Eko Wisata">Ekowisata</option>
        </select>
        <a href="#" class="text-blue-500 text-sm mt-1 inline-block">Lihat Panduan Kategorisasi UMKM</a>
      </div>

      <!-- Produk -->
      <div>
        <label class="font-semibold">Tambahkan Produk*</label>
        <div class="flex gap-2">
          <input type="text" name="produk_umkm[]" placeholder="Produk" class="w-full border rounded p-2">
          <button type="button" class="tambah-produk-umkm bg-green-600 text-white px-3 rounded">+</button>
        </div>
      </div>

        <!-- Sosial Media -->
        <div>
        <label class="font-semibold">Tambahkan Sosial Media*</label>
        <div id="sosmed-wrapper" class="space-y-2">
        <div class="flex gap-2">
        <select name="sosmed_umkm[0][platform]" class="border rounded p-2">
        <option value="facebook">Facebook</option>
        <option value="instagram">Instagram</option>
        <option value="tiktok">Tiktok</option>
        <option value="twitter">Twitter</option>
        </select>
        <input type="url" name="sosmed_umkm[0][url]" placeholder="Link URL" class="w-full border rounded p-2">
        <button type="button" class="add-sosmed bg-green-600 text-white px-3 rounded">+</button>
            </div>
        </div>
        </div>

      <!-- Penjualan -->
      <div>

        <div class="flex gap-2" style="display:none">
          <input type="text" name="tambah_penjualan_produk[]" placeholder="Produk" class="w-full border rounded p-2">
          <input type="number" name="jumlah_penjualan_perbulan[]" placeholder="Jumlah Penjualan per Bulan" class="w-full border rounded p-2">
          <button type="button" class="tambah-penjualan bg-green-600 text-white px-3 rounded">+</button>
        </div>
      </div>

      <!-- Submit -->
      <div class="text-center pt-4">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">Kirim</button>
      </div>
    </form>
      <a href="/data_umkm/{{$id}}"
   class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
    Kembali
</a>
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        // === Sosial Media Dinamis ===
        let sosmedIndex = 1;

        document.querySelector('.add-sosmed').addEventListener('click', function () {
            const wrapper = document.getElementById('sosmed-wrapper');
            const html = `
                <div class="flex gap-2 mt-2">
                    <select name="sosmed_umkm[${sosmedIndex}][platform]" class="border rounded p-2">
                        <option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
                        <option value="tiktok">TikTok</option>
                        <option value="twitter">Twitter</option>
                    </select>
                    <input type="url" name="sosmed_umkm[${sosmedIndex}][url]" placeholder="Link URL" class="w-full border rounded p-2">
                    <button type="button" class="hapus-sosmed bg-red-600 text-white px-3 rounded"><i class="fas fa-trash"></i></button>
                </div>`;
            wrapper.insertAdjacentHTML('beforeend', html);
            sosmedIndex++;
        });

        // === Produk Dinamis ===
        document.querySelector('.tambah-produk-umkm').addEventListener('click', function () {
            const wrapper = this.closest('div').parentElement;
            const html = `
                <div class="flex gap-2 mt-2">
                    <input type="text" name="produk_umkm[]" placeholder="Produk" class="w-full border rounded p-2">
                    <button type="button" class="hapus-produk bg-red-600 text-white px-3 rounded"><i class="fas fa-trash"></i></button>
                </div>`;
            wrapper.insertAdjacentHTML('beforeend', html);
        });

        // === Penjualan Dinamis ===
        document.querySelector('.tambah-penjualan').addEventListener('click', function () {
            const wrapper = this.closest('div').parentElement;
            const html = `
                <div class="flex gap-2 mt-2">
                    <input type="text" name="tambah_penjualan_produk[]" placeholder="Produk" class="w-full border rounded p-2">
                    <input type="number" name="jumlah_penjualan_perbulan[]" placeholder="Jumlah Penjualan per Bulan" class="w-full border rounded p-2">
                    <button type="button" class="hapus-penjualan bg-red-600 text-white px-3 rounded"><i class="fas fa-trash"></i></button>
                </div>`;
            wrapper.insertAdjacentHTML('beforeend', html);
        });

        // === Penghargaan Dinamis ===
        document.querySelector('.tambah-penghargaan').addEventListener('click', function () {
            const wrapper = this.closest('div').parentElement;
            const html = `
                <div class="flex gap-2 mt-2 items-center">
                    <div class="flex items-center border border-gray-300 rounded overflow-hidden w-full relative">
                        <span class="flex-1 px-3 py-2 text-gray-500 file-label">Gambar (jpg/png/jpeg)</span>
                        <input type="file" name="foto_penghargaan[]" class="hidden file-input" accept=".jpg,.jpeg,.png"
                               onchange="this.previousElementSibling.innerText = this.files[0]?.name || 'Gambar (jpg/png/jpeg)'">
                        <label onclick="this.previousElementSibling.click()" class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600 absolute right-0">Pilih File</label>
                    </div>
                    <input type="text" name="nama_penghargaan[]" placeholder="Nama Penghargaan" class="border p-2 rounded flex-1">
                    <button type="button" class="hapus-penghargaan bg-red-600 text-white px-3 rounded"><i class="fas fa-trash"></i></button>
                </div>`;
            wrapper.insertAdjacentHTML('beforeend', html);
        });

        // === Event Delegation: Hapus Semua Dinamis ===
        document.addEventListener('click', function (e) {
            if (e.target.closest('.hapus-sosmed') || e.target.closest('.hapus-produk') ||
                e.target.closest('.hapus-penghargaan') || e.target.closest('.hapus-penjualan')) {
                e.target.closest('.flex')?.remove();
            }
        });
         document.getElementById('tambah-foto-umkm').addEventListener('click', function () {
    const wrapper = document.getElementById('foto-umkm-wrapper');
    const newFoto = document.createElement('div');
    newFoto.classList.add('flex', 'items-center', 'border', 'border-gray-300', 'rounded', 'overflow-hidden', 'w-full', 'mt-2');
    newFoto.innerHTML = `
      <span class="flex-1 px-3 py-2 text-gray-500 file-label">Gambar (jpg/png/jpeg)</span>
      <input type="file" name="foto_umkm[]" class="hidden file-input" accept=".jpg,.jpeg,.png"
        onchange="this.previousElementSibling.innerText = this.files[0]?.name || 'Gambar (jpg/png/jpeg)'">
      <label onclick="this.previousElementSibling.click()"
        class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">Pilih File</label>
      <button type="button" class="hapus-foto ml-2 text-red-600 font-bold px-2">×</button>
    `;
    wrapper.appendChild(newFoto);
  });

  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('hapus-foto')) {
      e.target.parentElement.remove();
    }
  });
        </script>

@endsection
