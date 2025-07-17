@extends('layouts.master')

@section('title', 'Tambah Desa')

@section('navbar')
@endsection  <!-- Menghapus navbar -->

@section('content')
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



        <!-- Tombol Kembali -->
        <a href="javascript:history.back()"
        class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-full shadow transition mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#1A936F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>



    <h1 class="text-2xl font-bold text-white bg-[#48A98C] p-4 rounded-t-lg">Edit Data Desa Saya</h1>

    <!-- Added margin-bottom here for the gap -->
    <div class="mb-6"></div>

    <form method="POST" action="/admin_desa_edit/{{$profil->id_desa}}" enctype="multipart/form-data" id="form-desa">
        @csrf
        <!-- Bagian Data Dasar Desa -->
          <div>
            <label class="block text-gray-700 font-bold mb-2" for="nama-desa">Data  admin desa*</label>
            <input class="w-full p-2 border border-gray-300 rounded" type="text" id="nama-desa" name="name" placeholder="Masukkan Nama admin" value="{{ old('name', $user->name ?? '') }}">

        </div>
        <div>
            <label class="block text-gray-700 font-bold mb-2" for="nama-desa">Nama Desa*</label>
            <input class="w-full p-2 border border-gray-300 rounded" type="text" id="nama-desa" name="nama_desa" placeholder="Masukkan Nama Desa" value="{{ old('nama_desa', $user->nama_desa ?? '') }}">
        </div>

<div>
    <label class="block font-medium mb-2">Deskripsi <span class="text-red-500">*</span></label>
    <textarea name="deskripsi" rows="6" class="w-full p-2 border border-gray-300 rounded"
        placeholder="Tuliskan deskripsi...">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
</div>

<div class="mt-4">
    <label class="block font-medium mb-2">Visi <span class="text-red-500">*</span></label>
    <textarea name="visi" rows="6" class="w-full p-2 border border-gray-300 rounded"
        placeholder="Tuliskan visi...">{{ old('visi', $profil->visi ?? '') }}</textarea>
</div>

<div class="mt-4">
    <label class="block font-medium mb-2">Misi <span class="text-red-500">*</span></label>
    <textarea name="misi" rows="6" class="w-full p-2 border border-gray-300 rounded"
        placeholder="Tuliskan misi...">{{ old('misi', $profil->misi ?? '') }}</textarea>
</div>

    <div>
    <label class="block text-gray-700 font-bold mb-2" for="foto-desa">Upload 6 Foto Desa*</label>
    <div class="space-y-2">
    @if (!empty($profil->foto))
        <img src="{{ asset($profil->foto) }}" alt="Foto 1" class="w-40 h-auto rounded shadow">
    @endif
    <input class="w-full p-2 border border-gray-300 rounded"
           type="file"
           name="foto"
           accept=".jpg,.jpeg,.png">
</div>

<div class="space-y-2">
    @if (!empty($profil->foto2))
        <img src="{{ asset($profil->foto2) }}" alt="Foto 2" class="w-40 h-auto rounded shadow">
    @endif
    <input class="w-full p-2 border border-gray-300 rounded"
           type="file"
           name="foto2"
           accept=".jpg,.jpeg,.png">
</div>

<div class="space-y-2">
    @if (!empty($profil->foto3))
        <img src="{{ asset($profil->foto3) }}" alt="Foto 3" class="w-40 h-auto rounded shadow">
    @endif
    <input class="w-full p-2 border border-gray-300 rounded"
           type="file"
           name="foto3"
           accept=".jpg,.jpeg,.png">
</div>

<div class="space-y-2">
    @if (!empty($profil->foto4))
        <img src="{{ asset($profil->foto4) }}" alt="Foto 4" class="w-40 h-auto rounded shadow">
    @endif
    <input class="w-full p-2 border border-gray-300 rounded"
           type="file"
           name="foto4"
           accept=".jpg,.jpeg,.png">
</div>

<div class="space-y-2">
    @if (!empty($profil->foto5))
        <img src="{{ asset($profil->foto5) }}" alt="Foto 5" class="w-40 h-auto rounded shadow">
    @endif
    <input class="w-full p-2 border border-gray-300 rounded"
           type="file"
           name="foto5"
           accept=".jpg,.jpeg,.png">
</div>

<div class="space-y-2">
    @if (!empty($profil->foto6))
        <img src="{{ asset($profil->foto6) }}" alt="Foto 6" class="w-40 h-auto rounded shadow">
    @endif
    <input class="w-full p-2 border border-gray-300 rounded"
           type="file"
           name="foto6"
           accept=".jpg,.jpeg,.png">
</div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="kecamatan">Kecamatan*</label>
                <input class="w-full p-2 border border-gray-300 rounded" type="text" id="kecamatan" placeholder="Masukkan Kecamatan" name="kecamatan" value="{{ old('kecamatan', $user->kecamatan ?? '') }}">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="kabupaten">Kabupaten*</label>
                <input class="w-full p-2 border border-gray-300 rounded" type="text" id="kabupaten" placeholder="Masukkan Kabupaten" name="kabupaten" value="{{ old('kabupaten', $user->kabupaten ?? '') }}">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2" for="link-gmaps">Link Google Maps*</label>
                <input class="w-full p-2 border border-gray-300 rounded" type="text" id="link_map" placeholder="Masukkan Link Google Maps" name="link_map" value="{{ old('link_map', $profil->link_map ?? '') }}">
            </div>
        </div>

        <!-- Bagian Data Kependudukan -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="luas">Luas (km²)*</label>
                <input class="w-full p-2 border border-gray-300 rounded" type="number" id="luas" placeholder="Masukkan Luas Desa" name="luas_km"  value="{{ old('luas_km', $profil->luas_km ?? '') }}">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="kontak-desa">Kontak Desa*</label>
                <input class="w-full p-2 border border-gray-300 rounded" type="number" id="kontak-desa" placeholder="Masukkan Kontak Desa" name="kontak_desa" value="{{ old('kontak_desa', $profil->kontak_desa ?? '') }}">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="jumlah-penduduk-laki">Jumlah Penduduk Laki-laki*</label>
                <input class="w-full p-2 border border-gray-300 rounded" type="number" id="jumlah-penduduk-laki" placeholder="Masukkan Jumlah Penduduk Laki-laki" name="jumlah_laki_laki" value="{{ old('jumlah_laki_laki', $profil->jumlah_laki_laki ?? '') }}">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="jumlah-penduduk-perempuan">Jumlah Penduduk Perempuan*</label>
                <input class="w-full p-2 border border-gray-300 rounded" type="number" id="jumlah-penduduk-perempuan" placeholder="Masukkan Jumlah Penduduk Perempuan" name="jumlah_perempuan" value="{{ old('jumlah_perempuan', $profil->jumlah_perempuan ?? '') }}" >
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Distribusi Umur*</label>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <div>
                    <label class="block text-gray-700 mb-2">Kurang dari 10 tahun</label>
                    <input class="w-full p-2 border border-gray-300 rounded" type="number" placeholder="Jumlah (Jiwa)" name="jumlah_penduduk_kurang_10tahun" value="{{ old('jumlah_penduduk_kurang_10tahun', $profil->jumlah_penduduk_kurang_10tahun?? '') }}">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Kurang dari 20 tahun</label>
                    <input class="w-full p-2 border border-gray-300 rounded" type="number" placeholder="Jumlah (Jiwa)" name="jumlah_penduduk_kurang_20tahun" value="{{ old('jumlah_penduduk_kurang_20tahun', $profil->jumlah_penduduk_kurang_20tahun?? '') }}">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Kurang dari 50 tahun</label>
                    <input class="w-full p-2 border border-gray-300 rounded" type="number" placeholder="Jumlah (Jiwa)" name="jumlah_penduduk_kurang_50tahun"value="{{ old('jumlah_penduduk_kurang_50tahun', $profil->jumlah_penduduk_kurang_50tahun?? '') }}">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Lebih dari 50 tahun</label>
                    <input class="w-full p-2 border border-gray-300 rounded" type="number" placeholder="Jumlah (Jiwa)" name="jumlah_penduduk_lebih_50tahun"value="{{ old('jumlah_penduduk_lebih_50tahun', $profil->jumlah_penduduk_lebih_50tahun?? '') }}">
                </div>
            </div>
        </div>

        <!-- Bagian Kepala Desa dan Wakil -->
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="nama-kepala-desa">Nama Kepala Desa*</label>
                <input class="w-full p-2 border border-gray-300 rounded" type="text" id="nama-kepala-desa" placeholder="Masukkan Nama Kepala Desa" name="nama_kepala_desa"value="{{ old('nama_kepala_desa', $profil->nama_kepala_desa?? '') }}">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2" for="nama-wakil-desa">Nama WakilDes*</label>
                <input class="w-full p-2 border border-gray-300 rounded" type="text" id="nama-wakil-desa" placeholder="Masukkan Nama Wakil Desa" name="nama_wakil_desa"value="{{ old('nama_wakil_desa', $profil->nama_wakil_kepala_desa?? '') }}">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Kepala Desa -->
    <div>
        <label class="block text-gray-700 font-bold mb-2">Foto Kepala Desa</label>

      <!-- Foto Kepala Desa -->
<div>
    <label class="block text-gray-700 font-bold mb-2">Foto Kepala Desa</label>

    @if ($profil->foto_kades)
        <img src="{{ asset($profil->foto_kades) }}"
             alt="Foto Kepala Desa"
             class="w-full h-64 object-cover object-center mb-2 border rounded">
    @else
        <p class="text-sm text-gray-500 mb-2">Belum ada foto.</p>
    @endif

    <!-- Input file -->
    <div class="flex items-center border border-gray-300 rounded overflow-hidden w-full">
        <span id="label-foto-kepala" class="flex-1 px-3 py-2 text-gray-500">Gambar (jpg/png/jpeg)</span>
        <input type="file" name="foto_kepala_desa" id="foto_kepala_desa" class="hidden" accept=".jpg,.jpeg,.png"
            onchange="document.getElementById('label-foto-kepala').innerText = this.files[0]?.name || 'Gambar (jpg/png/jpeg)'" value="$profil->foto_kades) }}">
        <label for="foto_kepala_desa" class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">
            Pilih File
        </label>
    </div>
</div>

<!-- Foto Wakil Desa -->
<div>
    <label class="block text-gray-700 font-bold mb-2">Foto Wakil Desa</label>

    @if ($profil->foto_wades)
        <img src="{{ asset($profil->foto_wades) }}"
             alt="Foto Wakil Desa"
             class="w-full h-64 object-cover object-center mb-2 border rounded">
    @else
        <p class="text-sm text-gray-500 mb-2">Belum ada foto.</p>
    @endif

    <!-- Input file -->
    <div class="flex items-center border border-gray-300 rounded overflow-hidden w-full">
        <span id="label-foto-wakil" class="flex-1 px-3 py-2 text-gray-500">Gambar (jpg/png/jpeg)</span>
        <input type="file" name="foto_wakil_desa" id="foto_wakil_desa" class="hidden" accept=".jpg,.jpeg,.png"
            onchange="document.getElementById('label-foto-wakil').innerText = this.files[0]?.name || 'Gambar (jpg/png/jpeg)' "value=" $profil->foto_wades) }}" >
        <label for="foto_wakil_desa" class="px-4 py-2 bg-emerald-500 text-white cursor-pointer hover:bg-emerald-600">
            Pilih File
        </label>
    </div>
</div>



    </div>
</div>


        <!-- Media Sosial Kepala Desa (Fitur Dinamis Baru) -->
    <div>
    <label class="block text-gray-700 font-bold mb-2">Tambahkan Media Sosial Kepala Desa</label>
    <div id="sosmed-kepala-wrapper" class="space-y-4">
        {{-- Instagram --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end sosmed-kepala-item">
            <select name="sosmed_kepala[0][platform]" class="w-full p-2 border border-gray-300 rounded" disabled>
                <option value="instagram" selected>Instagram</option>
            </select>
            <input name="sosmed_kepala_ig" class="w-full p-2 border border-gray-300 rounded"
                   type="text" placeholder="Link Instagram"
                   value="{{ old('sosmed_kepala.0.url', $profil->link_ig) }}">
        </div>

        {{-- Email --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end sosmed-kepala-item">
            <select name="sosmed_kepala[1][platform]" class="w-full p-2 border border-gray-300 rounded" disabled>
                <option value="email" selected>Email</option>
            </select>
            <input name="sosmed_kepala_email" class="w-full p-2 border border-gray-300 rounded"
                   type="text" placeholder="Alamat Email"
                   value="{{ old('sosmed_kepala.1.url', $profil->email) }}">
        </div>

        {{-- LinkedIn --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end sosmed-kepala-item">
            <select name="sosmed_kepala[2][platform]" class="w-full p-2 border border-gray-300 rounded" disabled>
                <option value="linkedin" selected>LinkedIn</option>
            </select>
            <input name="sosmed_kepala_linkedin" class="w-full p-2 border border-gray-300 rounded"
                   type="text" placeholder="Link LinkedIn"
                   value="{{ old('sosmed_kepala.2.url', $profil->linkedin) }}">
        </div>
    </div>
</div>


        <!-- Media Sosial Wakil Desa (Fitur Dinamis Baru) -->
       <div>
    <label class="block text-gray-700 font-bold mb-2">Tambahkan Media Sosial Wakil Desa</label>
    <div id="sosmed-wakil-wrapper" class="space-y-4">

        {{-- Instagram --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end sosmed-wakil-item">
            <select name="sosmed_wakil[0][platform]" class="w-full p-2 border border-gray-300 rounded" disabled>
                <option value="instagram" selected>Instagram</option>
            </select>
            <input name="sosmed_wakil_ig" class="w-full p-2 border border-gray-300 rounded"
                   type="text" placeholder="Link Instagram"
                   value="{{ old('sosmed_wakil.0.url', $profil->link_ig_wakil ?? '') }}">
        </div>

        {{-- Facebook --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end sosmed-wakil-item">
            <select name="sosmed_wakil[1][platform]" class="w-full p-2 border border-gray-300 rounded" disabled>
                <option value="facebook" selected>Email</option>
            </select>
            <input name="sosmed_wakil_email" class="w-full p-2 border border-gray-300 rounded"
                   type="text" placeholder="Link Email"
                   value="{{ old('sosmed_wakil.1.url', $profil->email_wakil ?? '') }}">
        </div>

        {{-- LinkedIn --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end sosmed-wakil-item">
            <select name="sosmed_wakil[2][platform]" class="w-full p-2 border border-gray-300 rounded" disabled>
                <option value="linkedin" selected>LinkedIn</option>
            </select>
            <input name="sosmed_wakil_linkedin" class="w-full p-2 border border-gray-300 rounded"
                   type="text" placeholder="Link LinkedIn"
                   value="{{ old('sosmed_wakil.2.url', $profil->linkedin_wakil ?? '') }}">
        </div>


    </div>
</div>




    </div>
</div>

        <div class="mt-4 text-center">
            <button class="bg-[#48A98C] text-white p-4 rounded-xl w-40">Kirim</button>
        </div>
    </form>
</div>
<br>

<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
function createButtonRemove() {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'hapus bg-red-600 text-white px-3 py-2 rounded text-xl';
    btn.innerHTML = '<i class="fas fa-minus"></i>';
    return btn;
}

document.getElementById('foto-desa-wrapper').addEventListener('click', function (e) {
        if (e.target.closest('.add-foto-desa')) {
            const newField = document.createElement('div');
            newField.className = 'flex items-center gap-2';

            newField.innerHTML = `
                <input class="w-full p-2 border border-gray-300 rounded"
                       type="file"
                       name="foto[]"
                       accept=".jpg,.jpeg,.png"
                       required>
                <button type="button" class="remove-foto-desa bg-red-600 text-white px-3 py-2 rounded text-xl">
                    <i class="fas fa-minus"></i>
                </button>
            `;

            this.appendChild(newField);
        }

        if (e.target.closest('.remove-foto-desa')) {
            const field = e.target.closest('.flex');
            field.remove();
        }
    });
</script>

<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>


    const deskripsiEditor = new Quill('#editor-deskripsi', { theme: 'snow' });
    const visiEditor = new Quill('#editor-visi', { theme: 'snow' });
    const misiEditor = new Quill('#editor-misi', { theme: 'snow' });

    // Set isi awal dari value lama
    deskripsiEditor.root.innerHTML = `{!! old('deskripsi', $profil->deskripsi ?? '') !!}`;
    visiEditor.root.innerHTML = `{!! old('visi', $profil->visi ?? '') !!}`;
    misiEditor.root.innerHTML = `{!! old('misi', $profil->misi ?? '') !!}`;

    // Update input hidden sebelum submit
    document.querySelector('form').addEventListener('submit', function () {
        document.querySelector('#deskripsi').value = deskripsiEditor.root.innerHTML;
        document.querySelector('#visi').value = visiEditor.root.innerHTML;
        document.querySelector('#misi').value = misiEditor.root.innerHTML;
    });

    let sosmedKepalaIndex = 1;
    let sosmedWakilIndex = 1;

    document.querySelector('.tambah-sosmed-kepala').addEventListener('click', function () {
        const wrapper = document.getElementById('sosmed-kepala-wrapper');
        const html = `
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end sosmed-kepala-item">
                <select name="sosmed_kepala[${sosmedKepalaIndex}][platform]" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Media Sosial</option>
                    <option value="linkedin">LinkedIn</option>
                    <option value="facebook">Facebook</option>
                    <option value="instagram">Instagram</option>
                    <option value="twitter">Twitter</option>
                </select>
                <div class="flex gap-2 items-end">
                    <input name="sosmed_kepala[${sosmedKepalaIndex}][url]" class="w-full p-2 border border-gray-300 rounded" type="text" placeholder="Link atau URL Media Sosial">
                    <button type="button" class="hapus-sosmed bg-red-600 text-white px-3 py-2 rounded text-xl">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>`;
        wrapper.insertAdjacentHTML('beforeend', html);
        sosmedKepalaIndex++;
    });

    document.querySelector('.tambah-sosmed-wakil').addEventListener('click', function () {
        const wrapper = document.getElementById('sosmed-wakil-wrapper');
        const html = `
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end sosmed-wakil-item">
                <select name="sosmed_wakil[${sosmedWakilIndex}][platform]" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Media Sosial</option>
                    <option value="linkedin">LinkedIn</option>
                    <option value="facebook">Facebook</option>
                    <option value="instagram">Instagram</option>
                    <option value="twitter">Twitter</option>
                </select>
                <div class="flex gap-2 items-end">
                    <input name="sosmed_wakil[${sosmedWakilIndex}][url]" class="w-full p-2 border border-gray-300 rounded" type="text" placeholder="Link atau URL Media Sosial">
                    <button type="button" class="hapus-sosmed bg-red-600 text-white px-3 py-2 rounded text-xl">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>`;
        wrapper.insertAdjacentHTML('beforeend', html);
        sosmedWakilIndex++;
    });

    // Optional: Hapus elemen sosmed
    document.addEventListener('click', function (e) {
        if (e.target.closest('.hapus-sosmed')) {
            e.target.closest('.sosmed-kepala-item')?.remove();
            e.target.closest('.sosmed-wakil-item')?.remove();
        }
    });
    document.querySelector('.tambah-pemasukan').addEventListener('click', function () {
        const wrapper = document.getElementById('pemasukan-wrapper');
        const newRow = this.parentElement.cloneNode(true);
        newRow.querySelector('input').value = '';
        newRow.querySelector('button').innerHTML = '🗑️';
        newRow.querySelector('button').classList.remove('tambah-pemasukan');
        newRow.querySelector('button').classList.add('hapus-baris');
        wrapper.appendChild(newRow);
    });

    document.querySelector('.tambah-pengeluaran').addEventListener('click', function () {
        const wrapper = document.getElementById('pengeluaran-wrapper');
        const newRow = this.parentElement.cloneNode(true);
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        newRow.querySelector('button').innerHTML = '🗑️';
        newRow.querySelector('button').classList.remove('tambah-pengeluaran');
        newRow.querySelector('button').classList.add('hapus-baris');
        wrapper.appendChild(newRow);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('hapus-baris')) {
            e.target.parentElement.remove();
        }
    });
</script>

@endsection
