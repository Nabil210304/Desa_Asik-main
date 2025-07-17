<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Kementerian Desa')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

   <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables CSS -->

    <style>

        /* Hilangkan scrollbar di sidebar */
        #sidebar::-webkit-scrollbar { display: none; }
        #sidebar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Style untuk back to top button */
        #back-to-top {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            transition: all 0.3s ease;
        }

        .input-error { border-color: #dc2626 !important; }
        .error-message { color: #dc2626; }

        .ql-editor {
          font-weight: normal;
        }
        .ql-editor strong {
          font-weight: bold;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Konten Utama -->
    <main class="relative flex-1">
        @include('sweetalert::alert')
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Back to Top Button -->
    <button id="back-to-top" class="bg-green-600 hover:bg-green-700 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg transition-colors duration-300">
        <i class="fas fa-arrow-up text-lg"></i>
    </button>

    <!-- Script Sidebar -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const closeButton = document.getElementById('closeButton');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            closeButton.classList.toggle('hidden');
        }
    </script>

    <!-- Script Back to Top -->
    <script>
        // Tampilkan/tutup tombol ketika di-scroll
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            const backToTopButton = document.getElementById('back-to-top');
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                backToTopButton.style.display = "flex"; // Menggunakan flex untuk centering ikon
            } else {
                backToTopButton.style.display = "none";
            }
        }

        // Fungsi untuk kembali ke atas
        document.getElementById('back-to-top').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

    </script>
<!-- jQuery & DataTables JS -->


</body>
</html>
