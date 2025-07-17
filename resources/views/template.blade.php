@extends('layouts.master')

@section('title', 'Profil Desa')

@section('content')
<head>
  <meta charset="UTF-8">
  <title>Editor dengan TinyMCE dan Cropper</title>
  <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
  

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      margin: 0 !important;

      color: #333;
    }

    .container {
      max-width: 960px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    
    form {
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="number"],
    select,
    textarea {
      padding: 10px;
      font-size: 14px;
      margin: 5px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
      width: 100%;
      max-width: 400px;
    }

    button {
      padding: 10px 20px;
      font-size: 14px;
      background-color: #4CAF50;
      border: none;
      border-radius: 6px;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }

    .form-group {
      margin-bottom: 15px;
    }

    #resize-dropdown {
      position: absolute;
      display: none;
      background-color: white;
      border: 1px solid #ccc;
      padding: 15px;
      z-index: 9999;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 8px;
    }

    #cropper-modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    #cropper-container {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      max-width: 90%;
      max-height: 90%;
      overflow: auto;
    }

    img#cropper-image {
      max-width: 100%;
      border-radius: 6px;
    }

    #save-cropped {
      margin-top: 10px;
    }

    .paper-settings {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .paper-settings label {
      font-weight: bold;
    }

    .page {
      background: white;
      margin: 1em auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20mm;
    }

    .a3 { width: 297mm; height: 420mm; }
    .a4 { width: 210mm; height: 297mm; }
    .a5 { width: 148mm; height: 210mm; }

    figure { text-align: center; margin: 1em auto; }
    figcaption { font-size: 14px; color: #666; }
    h2{
      text-align: left;

    }
     
        .table td, .table th {
            text-align: center;
        }
          #resize-dropdown {
  position: absolute;
  z-index: 1; /* Pastikan lebih tinggi dari TinyMCE toolbar */
  background: white;
  border: 1px solid #ccc;
  padding: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

  </style>
</head>
<br>
  <div class="container">
<h1 class="text-center font-bold text-2xl">Edit Template</h1>

<h2 class="mt-4 text-lg">Tambah Placeholder</h2>


    <form onsubmit="return false;">
      <div class="form-group">
        <input type="text" id="newPlaceholderName" placeholder="Masukkan nama placeholder" />
      </div>
      <button type="button" onclick="addPlaceholder()" class="bg-primary ">Tambah Placeholder</button>
    </form>

    <h2 class="">Input Isi Placeholder</h2>
    <form id="placeholderInputs" onsubmit="return false;">
      <!-- Input akan muncul di sini -->
    </form>

    

    <div class="form-group">
      <label for="gambarDropdown">Pilih Gambar dari Database:</label>
      <select id="gambarDropdown" onchange="openCropperModal(this.value)">
        <option value="">-- Pilih Gambar --</option>
        @foreach($gambar as $g)
          <option value="{{ asset('storage/' . $g->gambar) }}">{{ $g->gambar }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="paperSize">Ukuran Kertas:</label>
      <select id="paperSize" onchange="updatePaperSettings()">
        <option value="a4" selected>A4</option>
        <option value="a3">A3</option>
        <option value="a5">A5</option>
      </select>
    </div>

    <div class="form-group paper-settings">
      <div>
        <label for="topMargin">Top:</label>
        <input type="number" id="topMargin" value="20" onchange="updateMargin()">
      </div>
      <div>
        <label for="bottomMargin">Bottom:</label>
        <input type="number" id="bottomMargin" value="20" onchange="updateMargin()">
      </div>
      <div>
        <label for="leftMargin">Left:</label>
        <input type="number" id="leftMargin" value="20" onchange="updateMargin()">
      </div>
      <div>
        <label for="rightMargin">Right:</label>
        <input type="number" id="rightMargin" value="20" onchange="updateMargin()">
      </div>
    </div>
<form method="POST" action="/simpan_dokumen">
    @csrf
    <input type="hidden" name="id_surat" value="{{ $id_surat }}">
    <textarea id="mytextarea" name="konten">{{ old('konten', $konten ?? '') }}</textarea>
    <br/>
    <button type="submit">Simpan</button>
  </form>
  </div>

  <div id="resize-dropdown">
    Lebar: <input type="number" id="input-width" /> px <br>
    Tinggi: <input type="number" id="input-height" /> px <br><br>
    <button onclick="applyImageResize()">Terapkan</button>
    <button onclick="resetImageSize()">Reset</button>
  </div>

  <div id="cropper-modal">
    <div id="cropper-container">
      <img id="cropper-image" src="" alt="Image for cropping">
      <br>
      <button id="save-cropped">Simpan Gambar</button>
    </div>
  </div>
  <br>

<script>
  let cropper;
  let selectedImage = null;
  let templateContent = '';
  let placeholders = [];

 function addPlaceholder() {
  const input = document.getElementById('newPlaceholderName');
  const name = input.value.trim();
  if (!name) {
    alert('Nama placeholder tidak boleh kosong!');
    return;
  }
  if (placeholders.includes(name)) {
    alert('Placeholder sudah ada!');
    return;
  }

  placeholders.push(name);

  const container = document.getElementById('placeholderInputs');
  const div = document.createElement('div');
  div.className = 'input-group d-flex align-items-center mb-2';
  div.id = `group_${name}`;

  const label = document.createElement('label');
  label.htmlFor = 'input_' + name;
  label.textContent = name.charAt(0).toUpperCase() + name.slice(1) + ':';
  label.className = 'me-2';

  const inputElem = document.createElement('input');
  inputElem.type = 'text';
  inputElem.id = 'input_' + name;
  inputElem.name = name;
  inputElem.placeholder = 'Isi nilai ' + name;
  inputElem.className = 'form-control me-2';
  inputElem.addEventListener('input', updateContent);

  const removeBtn = document.createElement('button');
  removeBtn.textContent = 'Hapus';
  removeBtn.type = 'button';
  removeBtn.className = 'btn btn-danger btn-sm';
  removeBtn.onclick = function () {
    removePlaceholder(name);
  };

  div.appendChild(label);
  div.appendChild(inputElem);
  div.appendChild(removeBtn);
  container.appendChild(div);

  insertPlaceholderToEditor(name);
  input.value = '';
}
function removePlaceholder(name) {
  // Hapus dari array placeholders
  placeholders = placeholders.filter(p => p !== name);

  // Hapus elemen input di DOM
  const group = document.getElementById(`group_${name}`);
  if (group) group.remove();

  // Hapus semua instance placeholder dari editor
  const editor = tinymce.get('mytextarea');
  if (editor) {
    let content = editor.getContent({ format: 'html' });
    const regex = new RegExp(`@{{${name}}}`, 'g');
    content = content.replace(regex, '');
    editor.setContent(content);
  }
}


  function insertPlaceholderToEditor(name) {
    const editor = tinymce.get('mytextarea');
    if (!editor) return;

    const placeholderText = `@{{${name}}}`;
    editor.insertContent(placeholderText + ' ');

    updatePlaceholders();

    if (!templateContent.includes(placeholderText)) {
      templateContent = editor.getContent({ format: 'html' });
    }
  }

  function updatePlaceholders() {
    const editor = tinymce.get('mytextarea');
    if (!editor) return;

    const content = editor.getContent({ format: 'html' });
    const regex = /@{{(.*?)}}/g;
    const matches = new Set();
    let match;

    while ((match = regex.exec(content)) !== null) {
      matches.add(match[1]);
    }

    placeholders = Array.from(matches);
    const inputContainer = document.getElementById('placeholderInputs');
    inputContainer.innerHTML = '';

    placeholders.forEach(function (name) {
      const inputElem = document.createElement('input');
      inputElem.type = 'text';
      inputElem.placeholder = `Masukkan nilai untuk ${name}`;
      inputElem.id = 'input_' + name;
      inputElem.className = 'placeholder-input';
      inputElem.addEventListener('input', updateContent);
      inputContainer.appendChild(inputElem);
    });
  }

  function updateContent() {
    const editor = tinymce.get('mytextarea');
    if (!editor) return;

    let content = templateContent;

    placeholders.forEach(function (name) {
      const inputElem = document.getElementById('input_' + name);
      const value = inputElem && inputElem.value.trim() ? inputElem.value.trim() : `@{{${name}}}`;
      const regex = new RegExp(`@{{${name}}}`, 'g');
      content = content.replace(regex, value);
    });

    editor.setContent(content);
  }

  function updateMargin() {
    const editorBody = tinymce.activeEditor.getBody();
    editorBody.style.paddingTop = document.getElementById('topMargin').value + 'mm';
    editorBody.style.paddingBottom = document.getElementById('bottomMargin').value + 'mm';
    editorBody.style.paddingLeft = document.getElementById('leftMargin').value + 'mm';
    editorBody.style.paddingRight = document.getElementById('rightMargin').value + 'mm';
  }

  function updatePaperSettings() {
    const editorBody = tinymce.activeEditor.getBody();
    editorBody.className = 'page';
    const paperSize = document.getElementById('paperSize').value;
    editorBody.classList.add(paperSize);
    updateMargin();
  }

  function showResizeOptions(img) {
    selectedImage = img;
    const dropdown = document.getElementById('resize-dropdown');
    const rect = img.getBoundingClientRect();
    dropdown.style.display = 'block';
    dropdown.style.top = `${window.scrollY + rect.bottom + 5}px`;
    dropdown.style.left = `${window.scrollX + rect.left}px`;

    document.getElementById('input-width').value = parseInt(img.style.width) || '';
    document.getElementById('input-height').value = parseInt(img.style.height) || '';
  }

  function hideResizeOptions() {
    document.getElementById('resize-dropdown').style.display = 'none';
  }

  function applyImageResize() {
    const width = document.getElementById('input-width').value;
    const height = document.getElementById('input-height').value;

    if (selectedImage) {
      if (width) selectedImage.style.width = width + 'px';
      if (height) selectedImage.style.height = height + 'px';
    }
  }

  function resetImageSize() {
    if (selectedImage) {
      selectedImage.style.width = '';
      selectedImage.style.height = '';
      document.getElementById('input-width').value = '';
      document.getElementById('input-height').value = '';
    }
  }

  function openCropperModal(url) {
    const modal = document.getElementById('cropper-modal');
    const image = document.getElementById('cropper-image');
    const saveBtn = document.getElementById('save-cropped');

    image.src = url;
    modal.style.display = 'flex';

    cropper = new Cropper(image, {
  aspectRatio: NaN,       // Tidak dikunci, bisa resize sesuka hati
  autoCropArea: 1,        // Area crop awalnya penuh
  viewMode: 0,            // Mode paling bebas (tidak membatasi gambar atau crop box)
  movable: true,          // Bisa digerakkan
  scalable: true,         // Bisa diskalakan
  zoomable: true,         // Bisa di-zoom
  cropBoxMovable: true,   // Crop box bisa dipindah
  cropBoxResizable: true, // Crop box bisa diubah ukurannya
});
    saveBtn.onclick = function () {
      const canvas = cropper.getCroppedCanvas();
      const croppedImageUrl = canvas.toDataURL('image/png');
      tinymce.activeEditor.insertContent('<img src="' + croppedImageUrl + '" class="mce-img" />');
      modal.style.display = 'none';
      cropper.destroy();
    };
  }

  tinymce.init({
    selector: '#mytextarea',
    height: 600,
    plugins: 'image paste code advlist lists visualchars table charmap emoticons hr pagebreak nonbreaking',
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | styleselect | image | code | table | charmap | emoticons | hr | pagebreak | nonbreaking | datetime',
    content_style: `
      body.page {
        background: white;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        padding: 20mm;
      }
      .a3 { width: 297mm; height: 420mm; }
      .a4 { width: 210mm; height: 297mm; }
      .a5 { width: 148mm; height: 210mm; }
      img.mce-img {
        display: block;
        margin: 10px auto;
        max-width: 100%;
        height: auto;
        cursor: pointer;
      }
      figure { text-align: center; }
      figcaption { font-size: 14px; color: #666; }
    `,
    setup: function (editor) {
      editor.on('init', function () {
        const body = editor.getBody();
        body.className = 'page a4';
        templateContent = editor.getContent({ format: 'html' });
        updatePlaceholders();
        updateMargin();
      });

      editor.on('Change KeyUp', updatePlaceholders);

      editor.on('NodeChange', function (e) {
        const selectedNode = e.element;
        if (selectedNode.nodeName === 'IMG') {
          showResizeOptions(selectedNode);
        } else {
          hideResizeOptions();
        }
      });

      editor.on('click', function (e) {
        if (e.target.nodeName === 'IMG') {
          showResizeOptions(e.target);
        }
      });
    }
  });
</script>


@endsection