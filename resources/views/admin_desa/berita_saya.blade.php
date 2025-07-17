@extends('layouts.master')

@section('title', 'Home')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- Font Awesome (buat icon edit/delete) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table id="Table"class="min-w-full leading-normal">
          

 <thead>
                <tr class="bg-gray-100 text-gray-700 font-semibold">
                    <th class="px-3 py-2">No</th>
                    <th class="px-3 py-2">Judul</th>
                    <th class="px-3 py-2">Referensi</th>
                    <th class="px-3 py-2">Foto</th>
                    <th class="px-3 py-2">Deskripsi</th>
                    <th class="px-3 py-2">Tanggal</th>
                    <th class="px-3 py-2 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($beritas as $index => $berita)
                <tr class="bg-white hover:bg-green-50 transition">
                    <td class="px-3 py-2 font-mono text-xs text-gray-500">#{{ $berita->id_berita }}</td>
                    <td class="px-3 py-2">{{ $berita->judul }}</td>
                    <td class="px-3 py-2">{{ $berita->referensi }}</td>
                    <td class="px-3 py-2">
                        @if($berita->foto)
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto" class="h-10 w-10 rounded-full object-cover border border-gray-300">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($berita->judul) }}&background=4CB080&color=fff" alt="Foto" class="h-10 w-10 rounded-full object-cover border border-gray-300">
                        @endif
                    </td>
                    <td class="px-3 py-2">{!! $berita->deskripsi !!}</td>
                    <td class="px-3 py-2">{{ $berita->created_at ? \Carbon\Carbon::parse($berita->created_at)->format('d-m-Y') : '-' }}</td>
                    <td class="px-3 py-2 text-center">
                        <a href="{{ url('berita/detail/' . $berita->id_berita) }}"
                                       class="text-[#249C6B] hover:text-green-700 text-xl" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                        <span class="sr-only">Lihat</span></a>
                        <a href="/admin_desa_vedit/{{$berita->id_berita}}" class="inline-block text-violet-600 hover:text-violet-800 mx-1" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Tombol trigger modal hapus -->
                <button type="button"
                    data-modal-target="delete_berita_{{ $berita->id_berita }}"
                    data-modal-toggle="delete_berita_{{ $berita->id_berita }}"
                    class="inline-block text-red-500 hover:text-red-700 mx-1"
                    title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
                <!-- Modal hapus -->
                @include('berita.deleteberita')
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-400">Tidak ada data berita.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="flex items-center justify-between p-5 bg-white border-t border-gray-200">
            <a href="/admin_desa_tambah-berita" class="bg-purple-600 text-white px-4 py-2 rounded-md text-sm flex items-center hover:bg-purple-700">
                <i class="fas fa-plus mr-2"></i>
                Tambah Berita
            </a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    $('#Table').DataTable({
      responsive: true
    });
  });
</script>

@endsection








