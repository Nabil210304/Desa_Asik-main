
@extends('layouts.master')

@section('title', 'List Berita Desa')

@section('content')
<div class="border-2 border-green-600 rounded-xl p-6 bg-white mb-8 shadow-sm">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-lg">Daftar Berita Desa</h2>
        <a href="{{ route('berita.tambah') }}" class="bg-violet-600 hover:bg-violet-700 text-white font-semibold rounded-md px-4 py-2 shadow flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>
       <!-- Tombol Kembali -->
<a href="javascript:history.back()"
   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-full shadow transition mb-6">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
    Kembali
</a>

    <form method="GET" class="mb-4 flex flex-wrap gap-3 items-center">
        <div class="flex items-center gap-2">
            <label for="per_page">Show</label>
            <select name="per_page" id="per_page" class="rounded-md border border-gray-300 px-2 py-1 text-sm focus:ring-2 focus:ring-green-400" onchange="this.form.submit()">
                @foreach([5, 10, 25, 50] as $size)
                    <option value="{{ $size }}" {{ request('per_page') == $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>
            <span>entries</span>
        </div>
        <input type="text" name="search" class="ml-auto rounded-md border border-gray-300 px-3 py-1 text-sm focus:ring-2 focus:ring-green-400" placeholder="Search..." value="{{ request('search') }}">
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border-separate border-spacing-y-2">
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
                        <a href="{{ url('berita/edit/' . $berita->id_berita) }}" class="inline-block text-violet-600 hover:text-violet-800 mx-1" title="Edit">
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
    </div>

    <div class="mt-4 flex justify-end">
        {{ $beritas->appends(request()->query())->links() }}
    </div>
</div>

<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
@endsection
