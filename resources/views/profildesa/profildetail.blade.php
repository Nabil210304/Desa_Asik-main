@extends('layouts.master')

@section('title', 'Profil Desa Spesifik')

@section('content')
<div class="max-w-6xl mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Desa Ciputri</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="md:col-span-2">
            <img id="mainImage" class="w-full h-auto rounded-lg cursor-pointer"
                 src="https://storage.googleapis.com/a1aa/image/Zxj0C6WXbvu0JrroCcMngeclrZmZllJeli0xbxL8HeU.jpg"
                 alt="Main Image" onclick="openModal(this.src)">
        </div>
        <div class="flex flex-col space-y-4">
            <img class="w-full h-auto rounded-lg cursor-pointer"
                 src="https://storage.googleapis.com/a1aa/image/hIXUCRfKAkATbxRdikjg2q9W5FKjRzwIhSTDJ9IPsp8.jpg"
                 onclick="changeMainImage(this.src)" alt="Image 1">
            <img class="w-full h-auto rounded-lg cursor-pointer"
                 src="https://storage.googleapis.com/a1aa/image/FgnhpcfzpeWAzSEPF23xHAQMQHhUT3t9fe3tURHfF80.jpg"
                 onclick="changeMainImage(this.src)" alt="Image 2">
        </div>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 justify-center items-center hidden" onclick="closeModal(event)">
        <div class="relative">
            <img id="modalImage" class="max-w-screen-lg max-h-screen-lg rounded-lg" src="" alt="Expanded Image">
            <button onclick="closeModal(event)" class="absolute top-2 right-2 bg-white text-black p-2 rounded-full">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Tentang Desa</h2>
        <p class="text-justify">
         Ciputri adalah desa di kecamatan Pacet, Cianjur, Jawa Barat, Indonesia. Nama Desa Ciputri diambil dari kata "cai" dan "putri" yang artinya tempat pemandian para putri di masa lampau. Desa Ciputri kaya akan sumber daya pertanian, dan sejak 2018, Desa Ciputri mulai mengembangkan kopi yang berasal dari biji kopi arabika yang ditanam langsung dari lahan di Desa Ciputri. Semua Desa Ciputri secara administratif termasuk ke dalam wilayah Desa Cibereum, Kecamatan Pacet, Cianjur, namun sering terpisahkan karena perbedaan administrasi. Sejak tahun 1978, Desa Ciputri dengan desa Induk Cibereum diindahkan. Pemekaran Desa Ciputri juga disebabkan terlalu luasnya Desa Induk Cibereum dan terlalu banyaknya penduduk dalam satu desa.
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Visi</h2>
        <p class="text-center">
         Mewujudkan Desa Ciputri yang Mandiri, Sejahtera, dan Berkelanjutan Berbasis Kearifan Lokal serta Teknologi.
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Misi</h2>
        <p class="text-justify">
         Desa Ciputri berkomitmen untuk memberdayakan ekonomi masyarakat melalui pengembangan sektor pertanian, peternakan, dan UMKM yang inovatif. Peningkatan kualitas pendidikan dan layanan kesehatan juga menjadi prioritas guna menciptakan sumber daya manusia yang unggul dan sehat. Selain itu, desa akan menjaga sumber daya alam secara berkelanjutan dengan menjaga keseimbangan ekosistem dan memanfaatkan potensi alam secara bijak. Dalam bidang infrastruktur yang memadai dan mempermudah aksesibilitas, serta transparansi dalam pengelolaan ekonomi dan pemerintahan desa. Dengan ini, kita telah memerintahkan desa yang transparan dan partisipatif akan diperkuat dengan memanfaatkan teknologi informasi dalam pelayanan publik.
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Informasi General</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
         <table class="table-auto w-full border-collapse border border-gray-300">
          <tbody>
           <tr>
            <td class="border border-gray-300 p-2">Kecamatan</td>
            <td class="border border-gray-300 p-2">Pacet</td>
           </tr>
           <tr>
            <td class="border border-gray-300 p-2">Kabupaten</td>
            <td class="border border-gray-300 p-2">Cianjur</td>
           </tr>
           <tr>
            <td class="border border-gray-300 p-2">Provinsi</td>
            <td class="border border-gray-300 p-2">Jawa Barat</td>
           </tr>
           <tr>
            <td class="border border-gray-300 p-2">Luas Wilayah</td>
            <td class="border border-gray-300 p-2">1.234 km<sup>2</sup></td>
           </tr>
           <tr>
            <td class="border border-gray-300 p-2">Jumlah Penduduk (2021)</td>
            <td class="border border-gray-300 p-2">12,345</td>
           </tr>
           <tr>
            <td class="border border-gray-300 p-2">Kode Pos</td>
            <td class="border border-gray-300 p-2">43212</td>
           </tr>
           <tr>
            <td class="border border-gray-300 p-2">Kontak Desa</td>
            <td class="border border-gray-300 p-2">081234567890</td>
           </tr>
          </tbody>
         </table>
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63391.45988713537!2d106.993210091215!3d-6.773963214975532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69b339dc734857%3A0xb0ba0b9085544f34!2sCiputri%2C%20Kec.%20Pacet%2C%20Kabupaten%20Cianjur%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1743430742294!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-2">Info Demografis</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="w-full md:w-96 mx-auto">
                <canvas id="genderChart"></canvas>
            </div>
            <div class="w-full md:max-w-6xl mx-auto">
                <canvas id="ageChart"></canvas>
            </div>
        </div>
    </section>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-8">Perangkat Desa</h1>
        <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-8">

          <!-- Kepala Desa -->
          <div class="relative bg-white rounded-xl shadow-md overflow-hidden w-64 transition-transform transform hover:scale-105 hover:shadow-2xl group">
            <img class="w-full h-96 object-cover" src="image/orang_desa.png" alt="Kepala Desa Ciputri" />
            <div class="absolute inset-0 flex flex-col justify-center items-center bg-gray-900 bg-opacity-50 text-white text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-lg font-semibold">Kepala Desa Ciputri</p>
              <p class="text-sm">Periode 2019-2024</p>
            </div>
            <div class="absolute bottom-[-10px] left-1/2 transform -translate-x-1/2 bg-white p-4 rounded-lg shadow-lg w-48 text-center">
              <i class="fab fa-linkedin text-blue-700 text-2xl mb-2 border-2 border-transparent rounded-full p-1 transition duration-300 hover:border-blue-700"></i>
              <p class="font-bold text-lg">IRMAN FAUZI</p>
              <div class="w-12 h-1 bg-green-600 mx-auto mt-1 group-hover:bg-green-700 transition-colors"></div>
              <p class="text-gray-600 text-sm">Kepala Desa</p>
            </div>
          </div>

          <!-- Wakil Kepala Desa -->
          <div class="relative bg-white rounded-xl shadow-md overflow-hidden w-64 transition-transform transform hover:scale-105 hover:shadow-2xl group">
            <img class="w-full h-96 object-cover" src="image/orang_desa.png" alt="Wakil Kepala Desa" />
            <div class="absolute inset-0 flex flex-col justify-center items-center bg-gray-900 bg-opacity-50 text-white text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-lg font-semibold">Wakil Kepala Desa</p>
            </div>
            <div class="absolute bottom-[-10px] left-1/2 transform -translate-x-1/2 bg-white p-4 rounded-lg shadow-lg w-48 text-center">
              <i class="fab fa-linkedin text-blue-700 text-2xl mb-2 border-2 border-transparent rounded-full p-1 transition duration-300 hover:border-blue-700"></i>
              <p class="font-bold text-lg">IRMAN FAUZI</p>
              <div class="w-12 h-1 bg-green-600 mx-auto mt-1 group-hover:bg-green-700 transition-colors"></div>
              <p class="text-gray-600 text-sm">Wakil Kepala Desa</p>
            </div>
          </div>

        </div>

        <section class="py-12">
            <h3 class="text-2xl font-bold mb-8">Potensi Ekonomi</h3>
            <div class="flex flex-wrap justify-center gap-8">
                <!-- Desa 1 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full md:w-80 flex flex-col h-full border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img alt="Image of Desa Ciputri" class="w-full h-40 object-cover" src="https://storage.googleapis.com/a1aa/image/ub2EA4LsBTbNwmUsE92r-j03EdrAaTKm5I1eYjv3USQ.jpg"/>
                    <div class="p-4 flex flex-col justify-between h-full">
                        <h4 class="text-xl font-bold mb-2">Desa Ciputri</h4>
                        <p class="text-gray-600 min-h-[70px] line-clamp-3">
                            Temukan berbagai desa dengan pesona khasnya. Setiap desa memiliki cerita, budaya, dan keindahan yang siap dijelajahi. Nikmati wisata, tradisi, dan keramahan lokal yang menunggu untuk dieksplorasi!
                        </p>
                        <button class="bg-[#1A936F] text-white px-6 py-3 w-full rounded-lg shadow-md font-bold flex items-center justify-center gap-2 mt-4 transition-all duration-300 hover:bg-green-600 active:scale-95">
                            Lihat <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Desa 2 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full md:w-80 flex flex-col h-full border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img alt="Image of Desa Balamoa" class="w-full h-40 object-cover" src="https://storage.googleapis.com/a1aa/image/d-5LEhTV24q-tNEE_XJARHidZRyEKw_ULXYYz1sWiBM.jpg"/>
                    <div class="p-4 flex flex-col justify-between h-full">
                        <h4 class="text-xl font-bold mb-2">Desa Balamoa</h4>
                        <p class="text-gray-600 min-h-[70px] line-clamp-3">
                            Desa ini terkenal dengan kegiatan gotong royong yang masih sangat kental.
                        </p>
                        <button class="bg-[#1A936F] text-white px-6 py-3 w-full rounded-lg shadow-md font-bold flex items-center justify-center gap-2 mt-4 transition-all duration-300 hover:bg-green-600 active:scale-95">
                            Lihat <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Desa 3 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full md:w-80 flex flex-col h-full border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img alt="Image of Desa Pangkeh" class="w-full h-40 object-cover" src="https://storage.googleapis.com/a1aa/image/ChYA6kQyiiJDzSeSaF-zFvtHIUBkVcLbZNcSXODqkbs.jpg"/>
                    <div class="p-4 flex flex-col justify-between h-full">
                        <h4 class="text-xl font-bold mb-2">Desa Pangkeh</h4>
                        <p class="text-gray-600 min-h-[70px] line-clamp-3">
                            Desa ini memiliki berbagai produk kerajinan tangan yang unik dan berkualitas. Banyak wisatawan yang datang untuk membeli kerajinan khas desa ini.
                        </p>
                        <button class="bg-[#1A936F] text-white px-6 py-3 w-full rounded-lg shadow-md font-bold flex items-center justify-center gap-2 mt-4 transition-all duration-300 hover:bg-green-600 active:scale-95">
                            Lihat <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <h2 class="text-2xl font-bold mt-12 mb-4">Rincian Pengeluaran Dana Desa</h2>
            <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700">Nama Pengeluaran</th>
                            <th class="px-6 py-3 text-left text-gray-700">Jumlah Anggaran</th>
                            <th class="px-6 py-3 text-left text-gray-700">Tahun</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4">Pengaspalan Jalan Merpati IX</td>
                            <td class="px-6 py-4">82.450.000</td>
                            <td class="px-6 py-4">Januari 2025</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4">Pembelian ATK Baru</td>
                            <td class="px-6 py-4">9.825.750</td>
                            <td class="px-6 py-4">Desember 2024</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Gaji Pegawai</td>
                            <td class="px-6 py-4">56.425.000</td>
                            <td class="px-6 py-4">Desember 2024</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4">Bantuan Sosial</td>
                            <td class="px-6 py-4">50.000.000</td>
                            <td class="px-6 py-4">Desember 2024</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Renovasi Pos Ronda RT 04</td>
                            <td class="px-6 py-4">6.910.000</td>
                            <td class="px-6 py-4">Desember 2024</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4">Revitalisasi Taman</td>
                            <td class="px-6 py-4">15.800.000</td>
                            <td class="px-6 py-4">Desember 2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</div>

            </div>

            <script>
                function openModal(src) {
                    document.getElementById("modalImage").src = src;
                    document.getElementById("imageModal").style.display = "flex";
                }
                function closeModal(event) {
                    if (event.target.id === "imageModal" || event.target.tagName === "BUTTON") {
                        document.getElementById("imageModal").style.display = "none";
                    }
                }
                function changeMainImage(src) {
                    document.getElementById("mainImage").src = src;
                }
                const genderData = {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [{
                data: [55, 45],
                backgroundColor: ["#4F46E5", "#F59E0B"]
            }]
        };

        const ageData = {
            labels: ["0-14", "15-24", "25-54", "55-64", "65+"],
            datasets: [{
                data: [20, 15, 40, 15, 10],
                backgroundColor: ["#1E40AF", "#3B82F6", "#10B981", "#F59E0B", "#EF4444"]
            }]
        };

        // Inisialisasi Chart.js
        window.onload = function() {
            new Chart(document.getElementById("genderChart"), {
                type: "pie",
                data: genderData
            });

            new Chart(document.getElementById("ageChart"), {
                type: "bar",
                data: {
                    labels: ageData.labels,
                    datasets: [{
                        label: "Distribusi Usia",
                        data: ageData.datasets[0].data,
                        backgroundColor: ageData.datasets[0].backgroundColor
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };
            </script>
        </div>
@endsection
