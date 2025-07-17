<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')</title>
    <style>
    @keyframes naikTurun {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px); /* Ketinggian loncatan, sesuaikan jika perlu */
      }
    }

    .animasi-naik-turun {
      animation: naikTurun 4s ease-in-out infinite;
    }
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
  </style>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Navbar (Bisa dikontrol dari setiap halaman) -->
    @yield('navbar', View::make('login.navbar'))

    <!-- Konten utama -->
    <main class="relative">
        @yield('content')
    </main>

    <!-- Footer -->
    @yield('footer', View::make('login.footer'))

    <!-- JavaScript -->
    <script src="{{ asset('/js/sidebar.js') }}"></script>
</body>
</html>
