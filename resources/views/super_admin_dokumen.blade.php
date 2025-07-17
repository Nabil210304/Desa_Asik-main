@extends('layouts.master')

@section('title', 'Profil Desa')

@section('content')
<div class="flex justify-center">
  <div class="w-full max-w-4xl mt-6 px-4">
    
    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Daftar Template Surat</h2>
      <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
              onclick="document.getElementById('modalTambah').classList.remove('hidden')">
        Tambah
      </button>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="min-w-full divide-y divide-gray-200 text-center text-sm">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="py-2 px-3">Nama Dokumen</th>
            <th class="py-2 px-3">Dibuat Pada</th>
            <th class="py-2 px-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($surats as $surat)
            <tr>
              <td class="py-2 px-3">{{ $surat->nama }}</td>
              <td class="py-2 px-3">{{ \Carbon\Carbon::parse($surat->created_at)->format('d-m-Y') }}</td>
              <td class="py-2 px-3 space-x-1">
                <a href="{{ route('surat.edit', $surat->id_surat) }}"
                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-sm">Edit</a>

                <form action="{{ route('surat.destroy', $surat->id_surat) }}" method="POST" class="inline-block"
                      onsubmit="return confirm('Yakin hapus?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">
                    Hapus
                  </button>
                </form>

                <a href="/pengaturan/{{ $surat->id_surat }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-2 py-1 rounded text-sm inline-block">
                  ⚙️ Pengaturan
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>

{{-- Modal Tambah --}}
<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">
    <form action="/tambah_dokumen" method="post" enctype="multipart/form-data" class="p-6">
      @csrf
      <input type="hidden" name="id_user" value="{{ Auth::user()->id_desa }}">

      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Tambah Template</h3>
        <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-gray-500 hover:text-black text-xl">&times;</button>
      </div>

      <div class="mb-4">
        <label for="nama" class="block mb-1 font-medium">Nama Dokumen</label>
        <input type="text" name="nama" id="nama" class="w-full border rounded px-3 py-2" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-medium">Upload Gambar</label>
        <div id="input-container">
          <div class="flex items-center gap-2 mb-2">
            <input type="file" name="gambar[]" class="w-full border rounded px-2 py-1" accept="image/*">
          </div>
        </div>
        <div class="flex gap-2">
          <button type="button" class="bg-green-600 text-white px-2 py-1 text-sm rounded hover:bg-green-700"
                  onclick="tambahInput()">+ Tambah</button>
          <button type="button" class="bg-red-600 text-white px-2 py-1 text-sm rounded hover:bg-red-700"
                  onclick="hapusInput()">- Hapus</button>
        </div>
      </div>

      <div class="flex justify-end gap-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim</button>
        <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Batal</button>
      </div>
    </form>
  </div>
</div>
<br>
{{-- JS --}}
<script>
  function tambahInput() {
    const container = document.getElementById('input-container');
    const div = document.createElement('div');
    div.classList.add('flex', 'items-center', 'gap-2', 'mb-2');
    div.innerHTML = `<input type="file" name="gambar[]" class="w-full border rounded px-2 py-1" accept="image/*">`;
    container.appendChild(div);
  }

  function hapusInput() {
    const container = document.getElementById('input-container');
    if (container.children.length > 1) {
      container.removeChild(container.lastElementChild);
    }
  }
</script>
@endsection
