@extends('layouts.master')

@section('title', 'Profil Desa')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>Manajemen Template Surat</title>

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        /* Jika tetap mau center text di tabel */
        .table td, .table th {
            text-align: center;
        }
    </style>
</head>

<div class="container mx-auto mt-12 px-4">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg">
        <div class="border-b border-gray-200 px-6 py-4">
            <h4 class="text-center text-gray-900 text-xl font-semibold">Pengaturan Surat</h4>
        </div>

        <div class="p-6">
            <form action="{{ route('surat.update', $surat->id_surat) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Judul Surat -->
                <div>
                    <label for="judul" class="block text-gray-700 font-medium mb-1">Judul Surat</label>
                    <input type="text" id="judul" name="judul" value="{{ $surat->nama ?? '' }}" 
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>

                <!-- Gambar Saat Ini -->
                <div>
                    <label class="block text-gray-700 font-medium mb-3">Gambar Dokumen</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($gambars as $gambar)
                            <div class="text-center" id="gambar-{{ $gambar->id_surat }}">
                                <img src="{{ asset('storage/' . $gambar->gambar) }}" 
                                     alt="Gambar Dokumen" 
                                     class="mx-auto rounded-md shadow-md mb-2 object-cover h-40 w-full" />
                                <button type="button" 
                                        onclick="hapusGambar({{ $gambar->id }})" 
                                        class="bg-red-600 text-white text-sm px-3 py-1 rounded hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Upload Gambar Baru -->
                <div id="upload-container">
                    <label class="block text-gray-700 font-medium mb-2">Tambah Gambar Baru</label>
                    <div class="flex gap-2 items-center mb-4">
                        <input type="file" name="gambar_baru[]" 
                               class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <button type="button" onclick="tambahUpload()" 
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                            Tambah
                        </button>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end gap-3">
                    <a href="/home_dokumen" 
                       class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded transition">
                        Kembali
                    </a>
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<br><br>
{{-- JQuery & Bootstrap JS (jika masih dibutuhkan) --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function tambahUpload() {
        $('#upload-container').append(`
            <div class="flex gap-2 items-center mb-4">
                <input type="file" name="gambar_baru[]" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                <button type="button" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition" onclick="hapusUpload(this)">Hapus</button>
            </div>
        `);
    }

    function hapusUpload(button) {
        $(button).closest('div.flex').remove();
    }

    function hapusGambar(id) {
        if (confirm('Yakin ingin menghapus gambar ini?')) {
            $.ajax({
                url: `/hapus-gambar/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#gambar-' + id).remove();
                },
                error: function(err) {
                    alert('Gagal menghapus gambar');
                }
            });
        }
    }
</script>
@endsection
