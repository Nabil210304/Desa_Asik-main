@extends('layouts.master')

@section('title', 'Tambah Berita')

@section('content')
<div class="max-w-7xl mx-auto mb-10 mt-5 bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold mb-6 text-green-700">Menambahkan Berita</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>⚠️ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
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



    <form method="POST" action="/admin_desa_tambah_berita" enctype="multipart/form-data" id="formBerita" class="space-y-6">
        @csrf
<input type="hidden" name="id_desa"value="{{ auth()->user()->id_desa }}">
        <!-- Judul Berita -->
        <div>
            <label class="block font-medium">Judul Berita <span class="text-red-500">*</span></label>
            <input type="text" name="judul" placeholder="Masukkan Judul Berita" class="w-full border p-2 rounded mt-1" required />
        </div>

        <!-- Referensi -->
        <div>
            <label class="block font-medium">Referensi <span class="text-red-500">*</span></label>
            <div id="referensi-wrapper" class="flex flex-col gap-2 mt-1">
                <div class="flex gap-2 items-center">
                    <input type="text" name="referensi[]" placeholder="Masukkan Referensi Berita" class="w-full border p-2 rounded" required />
                    <button type="button" class="tambah bg-green-600 text-white px-3 rounded text-xl" title="Tambah referensi">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Upload Gambar -->
        <div>
            <label class="block font-medium">Upload Gambar Berita (optional)</label>
            <input type="file" name="foto" accept="image/*" class="w-full border p-2 rounded mt-1" />
        </div>

        <!-- Isi Berita pakai Quill -->
        <div>
            <label class="block font-medium mb-2">Isi Berita <span class="text-red-500">*</span></label>
            <div id="editor" class="bg-white border rounded p-4" style="min-height: 200px;"></div>
            <input type="hidden" name="isi_berita" id="isi_berita" />
        </div>

        <!-- Submit -->
        <div class="text-center pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-2 rounded">Kirim</button>
        </div>
    </form>
     <a href="/admin_berita_saya/{{ Auth::user()->id_desa }}"
   class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
    Kembali
</a>
</div>
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],
  ['blockquote', 'code-block'],
  [{ 'header': 1 }, { 'header': 2 }],
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],
  [{ 'indent': '-1'}, { 'indent': '+1' }],
  [{ 'direction': 'rtl' }],
  [{ 'size': ['small', false, 'large', 'huge'] }],
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
  [{ 'color': [] }, { 'background': [] }],
  [{ 'font': [] }],
  [{ 'align': [] }],
  ['link', 'image', 'video'],
  ['clean']
];

var quill = new Quill('#editor', {
  theme: 'snow',
  placeholder: 'Tulis Berita Disini',
  modules: {
    toolbar: toolbarOptions,
    imageResize: {}
  }
});

// Sinkronisasi Quill ke input hidden saat submit
document.getElementById('formBerita').addEventListener('submit', function (e) {
    document.getElementById('isi_berita').value = quill.root.innerHTML;
});

// Handler upload gambar dari toolbar Quill
quill.getModule('toolbar').addHandler('image', function() {
    selectLocalImage();
});

function selectLocalImage() {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.click();

    input.onchange = async () => {
        const file = input.files[0];
        if (/^image\//.test(file.type)) {
            const formData = new FormData();
            formData.append('image', file);

            const res = await fetch('{{ route('upload.gambar') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await res.json();
            const range = quill.getSelection();
            quill.insertEmbed(range.index, 'image', data.url);
        }
    };
}

// Blokir paste/drag gambar base64
quill.root.addEventListener('paste', function(e) {
    if (e.clipboardData && e.clipboardData.items) {
        for (let i = 0; i < e.clipboardData.items.length; i++) {
            const item = e.clipboardData.items[i];
            if (item.type.indexOf('image') !== -1) {
                e.preventDefault();
                alert('Gunakan tombol gambar di toolbar untuk upload gambar!');
                return false;
            }
        }
    }
});
quill.root.addEventListener('drop', function(e) {
    if (e.dataTransfer && e.dataTransfer.files.length > 0) {
        for (let i = 0; i < e.dataTransfer.files.length; i++) {
            if (e.dataTransfer.files[i].type.indexOf('image') !== -1) {
                e.preventDefault();
                alert('Gunakan tombol gambar di toolbar untuk upload gambar!');
                return false;
            }
        }
    }
});

// Fitur tambah/hapus referensi dinamis
document.addEventListener('click', function(e) {
    if (e.target.closest('.tambah')) {
        e.preventDefault();
        const wrapper = document.getElementById('referensi-wrapper');
        const div = document.createElement('div');
        div.className = 'flex gap-2 items-center';
        div.innerHTML = `
            <input type="text" name="referensi[]" placeholder="Masukkan Referensi Berita" class="w-full border p-2 rounded" required />
            <button type="button" class="hapus bg-red-500 text-white px-3 rounded text-xl" title="Hapus Referensi">
                <i class="fas fa-minus"></i>
            </button>
        `;
        wrapper.appendChild(div);
    }
    if (e.target.closest('.hapus')) {
        e.preventDefault();
        const div = e.target.closest('.flex');
        if (div) div.remove();
    }
});
</script>
@endsection
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],
  ['blockquote', 'code-block'],
  [{ 'header': 1 }, { 'header': 2 }],
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],
  [{ 'indent': '-1'}, { 'indent': '+1' }],
  [{ 'direction': 'rtl' }],
  [{ 'size': ['small', false, 'large', 'huge'] }],
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
  [{ 'color': [] }, { 'background': [] }],
  [{ 'font': [] }],
  [{ 'align': [] }],
  ['link', 'image', 'video'],
  ['clean']
];

var quill = new Quill('#editor', {
  theme: 'snow',
  placeholder: 'Tulis Berita Disini',
  modules: {
    toolbar: toolbarOptions,
    imageResize: {}
  }
});

// Sinkronisasi Quill ke input hidden saat submit
document.getElementById('formBerita').addEventListener('submit', function (e) {
    document.getElementById('isi_berita').value = quill.root.innerHTML;
});

// Handler upload gambar dari toolbar Quill
quill.getModule('toolbar').addHandler('image', function() {
    selectLocalImage();
});

function selectLocalImage() {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.click();

    input.onchange = async () => {
        const file = input.files[0];
        if (/^image\//.test(file.type)) {
            const formData = new FormData();
            formData.append('image', file);

            const res = await fetch('{{ route('upload.gambar') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await res.json();
            const range = quill.getSelection();
            quill.insertEmbed(range.index, 'image', data.url);
        }
    };
}

// Blokir paste/drag gambar base64
quill.root.addEventListener('paste', function(e) {
    if (e.clipboardData && e.clipboardData.items) {
        for (let i = 0; i < e.clipboardData.items.length; i++) {
            const item = e.clipboardData.items[i];
            if (item.type.indexOf('image') !== -1) {
                e.preventDefault();
                alert('Gunakan tombol gambar di toolbar untuk upload gambar!');
                return false;
            }
        }
    }
});
quill.root.addEventListener('drop', function(e) {
    if (e.dataTransfer && e.dataTransfer.files.length > 0) {
        for (let i = 0; i < e.dataTransfer.files.length; i++) {
            if (e.dataTransfer.files[i].type.indexOf('image') !== -1) {
                e.preventDefault();
                alert('Gunakan tombol gambar di toolbar untuk upload gambar!');
                return false;
            }
        }
    }
});

// Fitur tambah/hapus referensi dinamis
document.addEventListener('click', function(e) {
    if (e.target.closest('.tambah')) {
        e.preventDefault();
        const wrapper = document.getElementById('referensi-wrapper');
        const div = document.createElement('div');
        div.className = 'flex gap-2 items-center';
        div.innerHTML = `
            <input type="text" name="referensi[]" placeholder="Masukkan Referensi Berita" class="w-full border p-2 rounded" required />
            <button type="button" class="hapus bg-red-500 text-white px-3 rounded text-xl" title="Hapus Referensi">
                <i class="fas fa-minus"></i>
            </button>
        `;
        wrapper.appendChild(div);
    }
    if (e.target.closest('.hapus')) {
        e.preventDefault();
        const div = e.target.closest('.flex');
        if (div) div.remove();
    }
});
</script>

