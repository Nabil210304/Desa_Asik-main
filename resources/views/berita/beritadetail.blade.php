@extends('layouts.master')

@section('title', 'Berita Detail')

@section('content')
<div class="flex flex-col lg:flex-row gap-8 max-w-6xl mx-auto mt-8 px-4 mb-10">
    <!-- Kolom Detail Berita -->
    <div class="flex-1 bg-white rounded-xl shadow p-6 mb-8 lg:mb-0">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ url()->previous() }}" class="text-2xl text-green-700 hover:text-green-900 transition">&#8592;</a>
            @auth
                @if (auth()->user()->role == 0 || auth()->user()->role == 2)
                <a href="{{ url('berita/edit/' . $berita->id_berita) }}" class="text-green-700 hover:text-green-900 flex items-center gap-1">
                    <span>Ubah</span> <span>&#9998;</span>
                </a>
                @endif
            @endauth
        </div>
        <div class="mb-4">
            @if($berita->foto)
                <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" class="w-full rounded-lg object-cover max-h-96">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($berita->judul) }}&background=4CB080&color=fff" alt="Foto Default" class="w-32 rounded-lg">
            @endif
        </div>
        <h2 class="text-2xl font-bold mt-2 mb-2">{{ $berita->judul }}</h2>
        <div class="flex flex-wrap items-center text-gray-500 text-sm mb-4 gap-2">
            <span>
                @if($berita->referensi)
                    {{ $berita->referensi }}
                @else
                    Tidak ada referensi
                @endif
            </span>
            <span>&bull;</span>
            <span>{{ \Carbon\Carbon::parse($berita->created_at)->diffForHumans() }}</span>
        </div>
        <div class="ql-snow">
            <div class="ql-editor text-base leading-relaxed">
                {!! $berita->deskripsi !!}
            </div>
        </div>
        @auth
            @if (auth()->user()->role == 0 || auth()->user()->role == 2)
            <div class="mt-6 flex flex-col sm:flex-row gap-2">
                <a href="{{ url('berita/edit/' . $berita->id_berita) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded transition flex items-center gap-2 justify-center">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ url('berita/hapus/' . $berita->id_berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition flex items-center gap-2 w-full justify-center">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
            @endif
        @endauth
    </div>

    <!-- Kolom Ulasan/Komentar -->
    <div class="flex-shrink-0 w-full lg:w-[350px] bg-gray-50 rounded-xl p-6 min-h-[500px] shadow mb-8 lg:mb-0">
        <h3 class="font-bold text-lg mb-4">Komentar</h3>
        <div class="flex flex-col gap-4 max-h-[400px] overflow-y-auto pr-2 mb-4">
            @forelse($berita->ulasan as $ulasan)
                <div class="border-b border-gray-200 pb-4 mb-2 last:border-b-0 last:pb-0 last:mb-0">
                    <div class="font-semibold text-green-700">{{ $ulasan->user->name ?? 'Anonim' }}</div>
                    <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($ulasan->created_at)->diffForHumans() }}</div>
                    <div class="mt-2 text-gray-800 break-words">{{ $ulasan->ulasan }}</div>
                </div>
            @empty
                <div class="text-gray-400">Belum ada komentar.</div>
            @endforelse
        </div>
        @auth
        <form action="{{ url('berita/ulasan/tambah/' . $berita->id_berita) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="ulasan" rows="3" class="w-full border rounded p-2 mb-2 resize-none" placeholder="Tulis komentar..."></textarea>
            <input type="hidden" name="id_user" value="{{ auth()->user()->id_user }}">
            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded w-full">Kirim</button>
        </form>
        @else
        <div class="mt-6 text-center text-gray-500 text-sm">
            <a href="{{ route('login') }}" class="text-green-700 underline">Login</a> untuk menulis komentar.
        </div>
        @endauth
    </div>
</div>
@endsection
