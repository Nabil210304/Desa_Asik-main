@extends('layouts.master')

@section('title', 'UMKM Spesifik')

@section('content')
<div class="max-w-6xl mx-auto p-4">
    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2">
       <img id="mainImage"
     src="{{ $fotoUtama ? asset($fotoUtama->foto_banner) : asset('images/default.jpg') }}"
     class="w-full h-96 object-cover rounded-lg shadow-lg cursor-pointer"
     alt="Gambar utama"
     onclick="openPenghargaanModal(this.src)">

        </div>
       <div class="grid grid-cols-2 gap-2">
    @foreach($fotoProduk as $foto)
        <img src="{{ asset($foto) }}"
             class="w-full h-32 md:h-40 object-cover rounded-lg shadow-md cursor-pointer"
             alt="Thumbnail Produk"
             onclick="changeImage(this.src)">
    @endforeach
</div>

    </div>

    <div id="imageModal" class="modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-75" style="display: none;" onclick="closeModal()">
        <div class="modal-content">
            <img id="modalImage" src="" alt="Gambar besar" class="max-w-full max-h-full">
        </div>
    </div>

    <div class="max-w-6xl mx-auto p-6">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-9">
                <div class="p-6 mt-4 bg-white rounded-lg shadow-lg">
                    <h1 class="text-3xl font-bold text-gray-800">
                     {{ $umkm->nama_umkm ?? 'Nama UMKM' }}
                     @php
    $fullStars = floor($rating); // jumlah bintang penuh
    $halfStar = ($rating - $fullStars) >= 0.5; // setengah bintang?
    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
@endphp
                        @for ($i = 0; $i < $fullStars; $i++)
    <i class="fas fa-star text-yellow-500"></i>
@endfor

@if ($halfStar)
    <i class="fas fa-star-half-alt text-yellow-500"></i>
@endif

@for ($i = 0; $i < $emptyStars; $i++)
    <i class="far fa-star text-yellow-500"></i>
@endfor
                    </h1>
                    <p class="text-gray-600">NIB: {{ $umkm->nomor_izin_berusaha }}</p>
                    <p class="text-gray-600">Alamat: {{ $umkm->alamat_lengkap }}</p>
                </div>

                <div class="mt-4 bg-white rounded-lg shadow-lg p-4">
                    <h2 class="text-xl font-semibold">Produk</h2>
                    <div class="grid grid-cols-3 gap-2 mt-2">
                            @foreach($produk as $produk)
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <p class="text-gray-600">{{$produk->produk}}</p>
                        </div>

                        @endforeach

                    </div>
                </div>
<div class="p-6 mt-4 bg-white rounded-lg shadow-lg">
       <h2 class="text-xl font-semibold">Penghargaan</h2>
               @foreach($penghargaan as $produk)
    <div class="flex items-start mt-4">
        <i class="fas fa-medal text-yellow-500 text-3xl mr-2 mt-1"></i>
        <div>
            <p class="text-gray-600 font-medium">{{ $produk->penghargaan }}</p>

            @if($produk->foto)
                <img src="{{ asset($produk->foto) }}"
                     alt="Foto Penghargaan"
                     class="w-32 h-24 object-cover mt-2 rounded-md shadow cursor-pointer hover:opacity-80"
                     onclick="openPenghargaanModal('{{ asset($produk->foto) }}')">
            @endif
        </div>
    </div>
@endforeach
</div>
<!-- Modal overlay -->
<div id="penghargaanModal" class="fixed inset-0 bg-black bg-opacity-80 hidden justify-center items-center z-50">
    <span class="absolute top-4 right-4 text-white text-3xl cursor-pointer" onclick="closePenghargaanModal()">&times;</span>
    <img id="penghargaanPreview" src="" class="max-h-[90vh] rounded-lg shadow-lg" alt="Preview Penghargaan">
</div>


   <h1 class="text-3xl font-bold text-gray-800 mt-3">Ringkasan</h1>
                <p class="mt-2 font-poppins font-normal text-justify">
                  {{$umkm->ringkasan_umkm}}
                </p>
            </div>
            <div class="col-span-3">
               <div class="p-6 mt-4 bg-white rounded-lg shadow-lg">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-green-500">
                <span class="text-yellow-500"> {{ $proporsi_positive }}% Berkomentar Positif
            </p>
            <p class="text-gray-600">
                {{ $total_ulasan }} Ulasan
            </p>
        </div>

</div>

                </div>

                <div class="mt-4 bg-white rounded-lg shadow-lg p-4">
                    <h2 class="text-xl font-semibold">Buka</h2>
                    <p class="text-gray-600"> {{$umkm->waktu_operasional}}</p>
                    <hr class="border-t border-gray-300 my-2">
                    <h2 class="text-xl font-semibold">Telepon</h2>
                    <p class="text-gray-600">{{$umkm->no_telepon}}</p>
                    <hr class="border-t border-gray-300 my-2">
                    <h2 class="text-xl font-semibold">Media Sosial</h2>
                    <div class="flex space-x-2 mt-2">
                         @if($umkm->sosmed_facebook)
        <a class="text-blue-500 hover:text-blue-600 transition duration-300"
           href="{{ $umkm->sosmed_facebook }}" target="_blank">
            <i class="fab fa-facebook-square fa-2x"></i>
        </a>
    @endif

    @if($umkm->sosmed_twitter)
        <a class="text-blue-400 hover:text-blue-500 transition duration-300"
           href="{{ $umkm->sosmed_twitter }}" target="_blank">
            <i class="fab fa-twitter-square fa-2x"></i>
        </a>
    @endif

    @if($umkm->sosmed_instagram)
        <a class="text-pink-500 hover:text-pink-600 transition duration-300"
           href="{{ $umkm->sosmed_instagram }}" target="_blank">
            <i class="fab fa-instagram-square fa-2x"></i>
        </a>
    @endif

                    </div>
                    <div class="mt-4">
                     @php
        function addClassToIframe($iframe, $className = 'max-w-full w-full h-96') {
            if (preg_match('/<iframe[^>]class="([^"])"/', $iframe, $matches)) {
                $existingClasses = $matches[1];
                $newClasses = $existingClasses . ' ' . $className;
                $iframe = preg_replace('/(<iframe[^>]class=")([^"])"/', '$1' . $newClasses . '"', $iframe, 1);
            } else {
                $iframe = preg_replace('/<iframe /', '<iframe class="' . $className . '" ', $iframe, 1);
            }
            return $iframe;
        }

        $iframeFromDb = $umkm->map;

        // Proses iframe-nya
        $iframeWithClass = addClassToIframe($iframeFromDb);
    @endphp

    {{-- Tampilkan hasilnya --}}
    {!! $iframeWithClass !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ulasan Section -->
<div class="max-w-6xl mx-auto p-4">
    <h1 class="text-3xl font-bold text-gray-800 mt-3">Ulasan</h1>
 <div class="flex space-x-4 mb-6">
    <button   class="px-4 py-2 rounded bg-blue-500 text-white font-semibold hover:bg-blue-600 transition" onclick="filterReviews('all')">Semua</button>
<button   class="px-4 py-2 rounded bg-green-500 text-white font-semibold hover:bg-green-600 transition" onclick="filterReviews('positive')">Positif</button>
<button  class="px-4 py-2 rounded bg-red-500 text-white font-semibold hover:bg-red-600 transition" onclick="filterReviews('negative')">Negatif</button>

        <!-- <button
            id="filter-all"
            class="px-4 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
            onclick="filterReviews('all')"
        >Semua</button>

        <button
            id="filter-positif"
            class="px-4 py-2 rounded bg-green-500 text-white font-semibold hover:bg-green-600 transition"
            onclick="filterReviews('positif')"
        >Positif</button>

        <button
            id="filter-negatif"
            class="px-4 py-2 rounded bg-red-500 text-white font-semibold hover:bg-red-600 transition"
            onclick="filterReviews('negatif')"
        >Negatif</button>
    </div> -->
    </div>


    @foreach ($ulasan as $item)

   <div class="ulasan-item flex flex-col md:flex-row items-stretch mt-4 border rounded-lg overflow-hidden"  data-class="{{ $item->class }}">

        <div class="md:w-1/3 mb-4 md:mb-0 px-4">
            <h2 class="text-blue-600 text-lg font-semibold mb-2">Rating UMKM {{ $item->rating }}/5</h2>
            <p class="text-gray-600 mb-2">{{ $item->email }}</p>
            <p class="text-gray-500">{{ $item->alamat }}</p>

            <hr class="my-4 border-gray-300">

            <div class="grid grid-cols-2 gap-2">
                <div class="relative col-span-2">
                    @if($item->photos)
                        @foreach (json_decode($item->photos) as $photo)
                            <img src="{{ asset($photo->foto) }}" class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointe"  alt="Gambar utama"
     onclick="openPenghargaanModal(this.src)" id="mainImage">
                        @endforeach
                    @else
                        <p class="text-gray-400">Tidak ada foto ulasan.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="md:w-2/3 p-4 bg-gray-300">
            <h3 class="text-lg font-semibold mb-2">Ini adalah ulasan dari pengguna.</h3>
            <p>{{ $item->ulasan }}</p>
        </div>

    </div>
    <hr class="border-t border-black my-4">

    @endforeach
</div>


    <div class="flex justify-end mb-4">
        <button onclick="document.getElementById('modalUlasan').style.display='flex'"
            class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition duration-300">
            Tulis Ulasan
        </button>
    </div>
<!-- Modal Ulasan Baru -->
<div id="modalUlasan" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg max-w-lg w-full p-6 mx-auto relative">
        <button onclick="document.getElementById('modalUlasan').style.display='none'"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>

        <h2 class="text-2xl font-bold mb-4">Tulis Ulasan</h2>

        <form action="/upload_ulasan" method="POST" enctype="multipart/form-data" onsubmit="return validateImages()">
            @csrf
            <!-- Rating -->
            <div class="mb-4">
                <label class="block font-semibold">Rating UMKM:</label>
                <div class="flex space-x-1 mt-1 text-2xl cursor-pointer text-gray-300" id="ratingContainer">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star" data-value="{{ $i }}">&#9733;</span>
                    @endfor
                </div>
                <span id="ratingText" class="ml-1 text-blue-600 text-sm" style="display:none">0/5</span>
                <input type="hidden" name="rating" id="ratingInput" value="0">
                <input type="hidden" name="id_umkm" value="{{ $umkm->id_umkm }}">
                <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}">
            </div>

            <input type="text" name="nama" value="{{ Auth::user()->email }}" placeholder="Nama Anda" class="border rounded w-full p-2 mb-2" required readonly>
            <input type="text" name="lokasi" value="{{ Auth::user()->alamat ?? '' }}" placeholder="Lokasi Anda" class="border rounded w-full p-2 mb-2" required>
            <textarea name="ulasan" class="border rounded w-full p-2 mb-2" rows="4" required placeholder="Tulis ulasan Anda..."></textarea>

            <!-- Dynamic Image Upload -->
            <div id="imageInputs" class="grid grid-cols-3 gap-2 mb-2"></div>
            <button type="button" id="addImageBtn" class="bg-blue-500 text-white px-3 py-1 rounded mb-2 hover:bg-blue-600 transition">+ Tambah Foto</button>
            <p id="imageWarning" class="text-sm text-red-500 hidden mb-2">Maksimal 6 gambar!</p>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">Kirim</button>
        </form>
    </div>
</div>

</div>
</div>
</div>

  <script>
  // Ganti gambar utama saat thumbnail diklik
  function changeImage(src) {
    const mainImage = document.getElementById('mainImage');
    mainImage.src = src;
  }

  // Modal gambar utama
  function openModal(src) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    modalImage.src = src;
    modal.style.display = 'flex';
  }

  function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';
  }

  // Modal penghargaan
  function openPenghargaanModal(src) {
    const modal = document.getElementById('penghargaanModal');
    const preview = document.getElementById('penghargaanPreview');
    preview.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function closePenghargaanModal() {
    const modal = document.getElementById('penghargaanModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
  }

  // Rating star interaction
  document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('#ratingContainer .star');
    const ratingInput = document.getElementById('ratingInput');
    const ratingText = document.getElementById('ratingText');

    stars.forEach(star => {
      star.addEventListener('click', () => {
        const rating = star.getAttribute('data-value');
        ratingInput.value = rating;
        ratingText.style.display = 'inline';
        ratingText.textContent = `${rating}/5`;

        // Reset all stars color
        stars.forEach(s => s.style.color = '#d1d5db'); // gray-300

        // Highlight selected stars
        for (let i = 0; i < rating; i++) {
          stars[i].style.color = '#facc15'; // yellow-400
        }
      });

      // Optional: hover effect
      star.addEventListener('mouseover', () => {
        const rating = star.getAttribute('data-value');
        stars.forEach((s, i) => {
          s.style.color = i < rating ? '#facc15' : '#d1d5db';
        });
      });
      star.addEventListener('mouseout', () => {
        const currentRating = ratingInput.value;
        stars.forEach((s, i) => {
          s.style.color = i < currentRating ? '#facc15' : '#d1d5db';
        });
      });
    });
  });

  // Preview gambar upload ulasan
  function previewImage(event, index) {
    const fileInput = event.target;
    const fileNameElem = document.getElementById('fileName' + index);
    const preview = document.getElementById('preview' + index);
    const labelText = document.getElementById('labelText' + index);

    if (fileInput.files && fileInput.files[0]) {
      fileNameElem.textContent = fileInput.files[0].name;
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
      }
      reader.readAsDataURL(fileInput.files[0]);
      labelText.textContent = "Ganti Gambar";
    } else {
      preview.src = '';
      preview.classList.add('hidden');
      fileNameElem.textContent = '';
      labelText.textContent = "Pilih Gambar";
    }
  }

  // Validasi maksimal 6 gambar upload
  function validateImages() {
    const inputs = document.querySelectorAll('input[name="foto_ulasan[]"]');
    let count = 0;
    inputs.forEach(input => {
      if (input.files.length > 0) {
        count++;
      }
    });

    const warning = document.getElementById('imageWarning');

    if (count > 6) {
      warning.classList.remove('hidden');
      return false;
    } else {
      warning.classList.add('hidden');
      return true;
    }
  }

function filterReviews(filter) {
    const ulasanItems = document.querySelectorAll('.ulasan-item');

    ulasanItems.forEach(item => {
        const kelas = item.getAttribute('data-class');
        if (filter === 'all' || kelas.toLowerCase() === filter) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });
}

// Dynamic image upload for reviews
let imageCount = 0;
const maxImages = 6;
const imageInputs = document.getElementById('imageInputs');
const addImageBtn = document.getElementById('addImageBtn');
const warning = document.getElementById('imageWarning');

function createImageInput(index) {
    const wrapper = document.createElement('div');
    wrapper.className = 'relative';

    const label = document.createElement('label');
    label.className = 'cursor-pointer block w-full bg-gray-100 border border-gray-300 rounded p-2 text-sm text-center hover:bg-gray-200';

    const span = document.createElement('span');
    span.id = 'labelText' + index;
    span.textContent = 'Pilih Gambar';

    const input = document.createElement('input');
    input.type = 'file';
    input.name = 'foto_ulasan[]';
    input.accept = 'image/*';
    input.className = 'absolute inset-0 opacity-0 fileInput';
    input.onchange = (e) => previewImage(e, index);

    label.appendChild(span);
    label.appendChild(input);

    const fileName = document.createElement('div');
    fileName.className = 'mt-1 text-xs text-gray-600 truncate max-w-full';
    fileName.id = 'fileName' + index;

    const img = document.createElement('img');
    img.id = 'preview' + index;
    img.className = 'w-full h-24 object-cover rounded border mt-2 hidden';

    // Tombol hapus
    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs hover:bg-red-600';
    removeBtn.textContent = '×';
    removeBtn.onclick = () => removeImageInput(wrapper);

    wrapper.appendChild(label);
    wrapper.appendChild(fileName);
    wrapper.appendChild(img);
    wrapper.appendChild(removeBtn);

    return wrapper;
}

function addImageInput() {
    if (imageCount >= maxImages) {
        warning.classList.remove('hidden');
        return;
    }
    warning.classList.add('hidden');
    const input = createImageInput(imageCount);
    imageInputs.appendChild(input);
    imageCount++;
}

function removeImageInput(wrapper) {
    imageInputs.removeChild(wrapper);
    imageCount--;
    warning.classList.add('hidden');
}

addImageBtn.addEventListener('click', addImageInput);

// Tambahkan satu input gambar secara default
addImageInput();
</script>

@endsection
