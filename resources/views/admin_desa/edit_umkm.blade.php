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
    <div class="mb-6"></div>

    <form method="POST" action="/edit_umkm_admin_desa/{{$umkm->id_umkm}}" enctype="multipart/form-data" id="form-desa" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama UMKM -->
        <div>
            <label class="font-semibold">Nama UMKM*</label>
            <input type="text" name="nama_umkm" placeholder="Masukkan Nama UMKM"
                   class="w-full border rounded p-2 mt-1"
                   value="{{ old('nama_umkm', $umkm->nama_umkm) }}">
        </div>

        <!-- Ringkasan UMKM -->
        <div>
            <label class="font-semibold">Ringkasan UMKM*</label>
            <textarea name="ringkasan_umkm" placeholder="Masukkan Ringkasan UMKM"
                      class="w-full border rounded p-2 mt-1">{{ old('ringkasan_umkm', $umkm->ringkasan_umkm) }}</textarea>
        </div>

        <!-- Upload Foto UMKM -->
        <div id="foto-produk-wrapper" class="space-y-2">
            <label class="font-semibold">Upload Foto Produk (jpg/jpeg/png)*</label>

            @forelse($fotoProduk as $index => $foto)
                <div class="flex items-center gap-2">
                    <img src="{{ asset($foto) }}" class="w-20 h-20 object-cover rounded border">
                    <input type="hidden" name="foto_produk_lama[]" value="{{ $foto }}">
                    <label>
                        <input type="checkbox" name="hapus_foto_produk[]" value="{{ $foto }}"> Hapus
                    </label>
                </div>
            @empty
                {{-- Jika tidak ada foto, tampilkan satu input kosong --}}
                <div class="flex items-center border border-gray-300 rounded overflow-hidden w-full gap-2">
                    <span class="flex-1 px-3 py-2 text-gray-500 file-label">Gambar baru (jpg/png/jpeg)</span>
                    <input type="file" name="foto_produk[]" class="hidden file-input" accept=".jpg,.jpeg,.png"
                        onchange="this.previousElementSibling.innerText = this.files[0]?.name || 'Gambar baru (jpg/png/jpeg)'">
                    <label onclick="this.previousElementSibling.click()"
                        class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">Tambah File</label>
                    <button type="button" class="hapus-foto-produk bg-red-600 text-white px-3 rounded ml-2">-</button>
                </div>
            @endforelse

            {{-- Tombol tambah input baru --}}
            <button type="button" id="tambah-foto-produk" class="mt-2 bg-green-600 text-white px-3 py-2 rounded">Tambah Foto Produk +</button>
        </div>


        <!-- Desa -->
        <div>
            <label class="font-semibold">Desa*</label>
            <select name="desa_id" class="w-full border rounded p-2 mt-1">
                <option value="">-- Pilih Desa --</option>
                @foreach ($data_desa as $desa)
                    <option value="{{ $desa->id_desa }}"
                        {{ old('desa_id', $umkm->id_desa) == $desa->id_desa ? 'selected' : '' }}>
                        {{ $desa->nama_desa }}, {{ $desa->kecamatan }}, {{ $desa->provinsi }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Alamat Lengkap -->
        <div>
            <label class="font-semibold">Alamat Lengkap*</label>
            <input type="text" name="alamat_lengkap" placeholder="Masukkan Alamat Lengkap" class="w-full border rounded p-2 mt-1"
                   value="{{ old('alamat_lengkap', $umkm->alamat_lengkap) }}">
        </div>

        <!-- Waktu Operasional -->
        <div>
            <label class="font-semibold">Waktu Operasional*</label>
            <input type="text" name="waktu" placeholder="Masukkan seperti 09:00-15:00" class="w-full border rounded p-2 mt-1"
                   value="{{ old('waktu', $umkm->waktu_operasional) }}">
        </div>

        <!-- Nomor Izin Berusaha -->
        <div>
            <label class="font-semibold">Nomor Izin Berusaha*</label>
            <input type="text" name="nomor_izin_berusaha" placeholder="Masukkan NIB" class="w-full border rounded p-2 mt-1"
                   value="{{ old('nomor_izin_berusaha', $umkm->nomor_izin_berusaha) }}">
        </div>

        <!-- No Telepon -->
        <div>
            <label class="font-semibold">No Telepon*</label>
            <input type="text" name="no_telepon" placeholder="Masukkan Nomor Telepon" class="w-full border rounded p-2 mt-1"
                   value="{{ old('no_telepon', $umkm->no_telepon) }}">
        </div>

        <!-- Map -->
        <div>
            <label class="font-semibold">MAP*</label>
            <input type="text" name="map" placeholder="Masukkan link map dengan <iframe>" class="w-full border rounded p-2 mt-1"
                   value="{{ old('map', $umkm->map) }}">
        </div>

        <!-- Penghargaan -->
        <div>
          <label class="font-semibold">Penghargaan</label>
<div id="penghargaan-wrapper" class="space-y-2">
    @forelse($penghargaan as $i => $p)
        <div class="flex gap-2 items-center">
            <div class="flex items-center border border-gray-300 rounded overflow-hidden w-full max-w-[350px]">
                <span class="flex-1 px-3 py-2 text-gray-500 truncate" title="{{ basename($p->foto) }}">
                    {{ basename($p->foto) }}
                </span>
                <input type="file" name="foto_penghargaan[]" class="hidden foto-penghargaan-input" accept=".jpg,.jpeg,.png"
                    onchange="this.previousElementSibling.innerText = this.files[0]?.name || '{{ basename($p->foto) }}'">
                <label onclick="this.previousElementSibling.click()"
                    class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">Pilih File</label>
            </div>
            <input type="text" name="nama_penghargaan[]" placeholder="Nama Penghargaan" class="border p-2 rounded flex-1"
                value="{{ old("nama_penghargaan.$i", $p->penghargaan) }}">
            <button type="button" class="hapus-penghargaan bg-red-600 text-white px-3 rounded">-</button>
        </div>
    @empty
        {{-- Jika tidak ada data, tampilkan baris kosong default --}}
        <div class="flex gap-2 items-center">
            <div class="flex items-center border border-gray-300 rounded overflow-hidden w-full max-w-[350px]">
                <span class="flex-1 px-3 py-2 text-gray-500 truncate">Gambar (jpg/png/jpeg)</span>
                <input type="file" name="foto_penghargaan[]" class="hidden foto-penghargaan-input" accept=".jpg,.jpeg,.png"
                    onchange="this.previousElementSibling.innerText = this.files[0]?.name || 'Gambar (jpg/png/jpeg)'">
                <label onclick="this.previousElementSibling.click()"
                    class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">Pilih File</label>
            </div>
            <input type="text" name="nama_penghargaan[]" placeholder="Nama Penghargaan" class="border p-2 rounded flex-1">
            <button type="button" class="hapus-penghargaan bg-red-600 text-white px-3 rounded">-</button>
        </div>
    @endforelse

<button type="button" id="tambah-penghargaan" class="mt-2 bg-green-600 text-white px-3 py-2 rounded">Tambah Penghargaan +</button>


</div>

        <!-- Kategori UMKM -->
        <div>
            <label class="font-semibold">Kategori UMKM*</label>
            <select name="kategori_umkm" class="w-full border rounded p-2 mt-1">
                <option value="">Kategori UMKM</option>
                <option value="kerajinan" {{ old('kategori_umkm', $umkm->kategori_umkm) == 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                <option value="Makanan_Minuman" {{ old('kategori_umkm', $umkm->kategori_umkm) == 'Makanan_Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                <option value="Pertenakan_Perkebunan" {{ old('kategori_umkm', $umkm->kategori_umkm) == 'Pertenakan_Perkebunan' ? 'selected' : '' }}>Pertenakan & Perkebunan</option>
                <option value="Eko Wisata" {{ old('kategori_umkm', $umkm->kategori_umkm) == 'Eko Wisata' ? 'selected' : '' }}>Ekowisata</option>
            </select>
            <a href="#" class="text-blue-500 text-sm mt-1 inline-block ">Tambah Kategori UMKM</a>
        </div>

        <!-- Produk UMKM -->
        <div>
            <label class="font-semibold">Produk UMKM</label>
            <label class="font-semibold">Produk UMKM</label>
<div id="produk-wrapper" class="space-y-2">
    @forelse ($produk as $i => $item)
        <div class="flex gap-2 items-center">
            <input type="hidden" name="produk_id[]" value="{{ $item->id_produk ?? '' }}">
            <input type="text" name="produk_umkm[]" placeholder="Masukkan produk UMKM"
                class="w-full border rounded p-2"
                value="{{ old("produk_umkm.$i", $item->produk ?? '') }}">
            <button type="button" class="hapus-produk bg-red-600 text-white px-3 rounded">-</button>
        </div>
    @empty
        {{-- Jika tidak ada data produk, tampilkan satu baris input kosong --}}
        <div class="flex gap-2 items-center">
            <input type="text" name="produk_umkm[]" placeholder="Masukkan produk UMKM"
                class="w-full border rounded p-2"
                value="">
            <button type="button" class="hapus-produk bg-red-600 text-white px-3 rounded">-</button>
        </div>
    @endforelse
</div>

<button type="button" id="tambah-produk" class="mt-2 bg-green-600 text-white px-3 rounded py-2">Tambah Produk +</button>


        <!-- Sosial Media -->
        <div>
            <label class="font-semibold">Sosial Media</label>
<div id="sosmed-wrapper" class="space-y-2">

    @php
        $sosmedList = [
            'facebook' => $umkm->sosmed_facebook,
            'instagram' => $umkm->sosmed_instagram,
            'tiktok' => $umkm->sosmed_tiktok,
            'twitter' => $umkm->sosmed_twitter,
        ];
    @endphp

    @forelse ($sosmedList as $jenis => $link)
        @if (!empty($link))
            <div class="flex gap-2 items-center">
                <input type="hidden" name="sosmed_id[]" value="{{ $link->id ?? '' }}">
                <select name="jenis_sosmed[]" class="border rounded p-2 w-1/3">
                    <option value="facebook" {{ $jenis == 'facebook' ? 'selected' : '' }}>Facebook</option>
                    <option value="instagram" {{ $jenis == 'instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="tiktok" {{ $jenis == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                    <option value="twitter" {{ $jenis == 'twitter' ? 'selected' : '' }}>Twitter</option>
                </select>
                <input type="text" name="link_sosmed[]" value="{{ $link->url ?? $link }}">
                <button type="button" class="hapus-sosmed bg-red-600 text-white px-3 rounded">-</button>
            </div>
        @endif
    @empty
        {{-- Kalau semua null, kasih satu baris kosong default --}}
        <div class="flex gap-2 items-center">
            <select name="jenis_sosmed[]" class="border rounded p-2 w-1/3">
                <option value="facebook">Facebook</option>
                <option value="instagram">Instagram</option>
                <option value="tiktok">TikTok</option>
                <option value="twitter">Twitter</option>
            </select>
            <input type="text" name="link_sosmed[]" placeholder="Masukkan link sosial media" class="border rounded p-2 flex-1">
            <button type="button" class="hapus-sosmed bg-red-600 text-white px-3 rounded">-</button>
        </div>
    @endforelse

</div>

<button type="button" id="tambah-sosmed" class="mt-2 bg-green-600 text-white px-3 rounded py-2">Tambah Sosmed +</button>

        </div>
        <br>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="bg-[#48A98C] text-white px-6 py-2 rounded font-semibold hover:bg-[#3a7b6c]">Simpan</button>
        </div>
    </form>
    <br>
     <a href="/data_umkm/{{$umkm->id_desa}}"
   class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
    Kembali
</a>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Produk - tambah dan hapus
        document.getElementById('tambah-produk').addEventListener('click', function() {
            const produkWrapper = document.getElementById('produk-wrapper');
            const produkDiv = document.createElement('div');
            produkDiv.classList.add('flex', 'gap-2', 'items-center');
            produkDiv.innerHTML = `
                <input type="text" name="produk_umkm[]" placeholder="Masukkan produk UMKM" class="w-full border rounded p-2" value="">
                <button type="button" class="hapus-produk bg-red-600 text-white px-3 rounded">-</button>
            `;
            produkWrapper.appendChild(produkDiv);
        });

        document.getElementById('produk-wrapper').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('hapus-produk')) {
                e.target.parentElement.remove();
            }
        });

        // Sosial Media - tambah dan hapus
        document.getElementById('tambah-sosmed').addEventListener('click', function() {
            const sosmedWrapper = document.getElementById('sosmed-wrapper');
            const sosmedDiv = document.createElement('div');
            sosmedDiv.classList.add('flex', 'gap-2', 'items-center');
            sosmedDiv.innerHTML = `
                <select name="jenis_sosmed[]" class="border rounded p-2 w-1/3">
                    <option value="facebook">Facebook</option>
                    <option value="instagram">Instagram</option>
                    <option value="tiktok">TikTok</option>
                    <option value="youtube">YouTube</option>
                </select>
                <input type="text" name="link_sosmed[]" placeholder="Masukkan link sosial media" class="border rounded p-2 flex-1">
                <button type="button" class="hapus-sosmed bg-red-600 text-white px-3 rounded">-</button>
            `;
            sosmedWrapper.appendChild(sosmedDiv);
        });

        document.getElementById('sosmed-wrapper').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('hapus-sosmed')) {
                e.target.parentElement.remove();
            }
        });

        // Penghargaan - tambah dan hapus
        document.getElementById('tambah-penghargaan').addEventListener('click', function() {
            const penghargaanWrapper = document.getElementById('penghargaan-wrapper');
            const penghargaanDiv = document.createElement('div');
            penghargaanDiv.classList.add('flex', 'gap-2', 'items-center');
            penghargaanDiv.innerHTML = `
                <div class="flex items-center border border-gray-300 rounded overflow-hidden w-full max-w-[350px]">
                    <span class="flex-1 px-3 py-2 text-gray-500 truncate file-label" title="Gambar (jpg/png/jpeg)">Gambar (jpg/png/jpeg)</span>
                    <input type="file" name="foto_penghargaan[]" class="hidden foto-penghargaan-input" accept=".jpg,.jpeg,.png"
                        onchange="this.previousElementSibling.innerText = this.files[0]?.name || 'Gambar (jpg/png/jpeg)'">
                    <label onclick="this.previousElementSibling.click()" class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">Pilih File</label>
                </div>
                <input type="text" name="nama_penghargaan[]" placeholder="Nama Penghargaan" class="border p-2 rounded flex-1">
                <button type="button" class="hapus-penghargaan bg-red-600 text-white px-3 rounded">-</button>
            `;
            penghargaanWrapper.appendChild(penghargaanDiv);
        });

        document.getElementById('penghargaan-wrapper').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('hapus-penghargaan')) {
                e.target.parentElement.remove();
            }
        });

        // Tambah/hapus input foto produk
        document.getElementById('tambah-foto-produk').addEventListener('click', function() {
            const wrapper = document.getElementById('foto-produk-wrapper');
            const div = document.createElement('div');
            div.className = 'flex items-center border border-gray-300 rounded overflow-hidden w-full gap-2 mt-2';
            div.innerHTML = `
                <span class="flex-1 px-3 py-2 text-gray-500 file-label">Gambar baru (jpg/png/jpeg)</span>
                <input type="file" name="foto_produk[]" class="hidden file-input" accept=".jpg,.jpeg,.png"
                    onchange="this.previousElementSibling.innerText = this.files[0]?.name || 'Gambar baru (jpg/png/jpeg)'">
                <label onclick="this.previousElementSibling.click()"
                    class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">Tambah File</label>
                <button type="button" class="hapus-foto-produk bg-red-600 text-white px-3 rounded ml-2">-</button>
            `;
            // Insert before the tambah button
            wrapper.insertBefore(div, this);
        });

        document.getElementById('foto-produk-wrapper').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('hapus-foto-produk')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection
