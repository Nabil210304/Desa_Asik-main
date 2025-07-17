<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed left-0 top-0 h-screen w-64 bg-[#2E8F74] text-white z-[100] transform -translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
    <div class="p-4">
        <!-- Header Logo dan Nama -->
        <div class="flex items-center">
            <img class="h-12 w-12 rounded-full" src="{{ asset('image/Group 23.png') }}" alt="Logo">
            <div class="ml-2">
                <h1 class="text-lg font-bold">DesaGo</h1>
                <p class="text-sm">Bangun Desa Bangun Indonesia</p>
            </div>
        </div>

        <!-- Tombol Logout -->
        @auth
        <div class="text-center mt-6">
            <form id="logoutForm" action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="inline-block bg-[#1A936F] text-white font-bold no-underline py-2 px-5 rounded-full border-2 border-white text-[16px] shadow-md transition-all duration-300 ease-in-out hover:bg-white hover:text-[#178a5a]">
                    Keluar
                </button>
            </form>
        </div>
        @endauth
    </div>

    <!-- Menu Navigasi -->
    <nav>
        <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/profildesa" class="block font-bold">Profil Desa</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Temukan berbagai desa dengan pesona khasnya</p>
        </div>

        <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/umkm" class="block font-bold">UMKM</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Temukan UMKM unggulan dari desa</p>
        </div>
        <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="http://127.0.0.1:5000/" class="block font-bold" target="_blank">Absensi</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Kelola dan lihat data absensi</p>
        </div>
         <hr class="border-t border-white opacity-80 my-2">
         {{-- <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="http://127.0.0.1:5000/vfdataset_page/{{ Auth::user()->id_user }}" class="block font-bold" target="_blank">Generate Muka</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Kelola dan lihat data absensi</p>
        </div> --}}
         <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="http://127.0.0.1:5000/addprsn" class="block font-bold" target="_blank">Generate Muka</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Kelola dan lihat data absensi</p>
        </div>
        @auth
    @if (auth()->user()->role == 3)
  <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/data_user" class="block font-bold">Data User</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Manage Data User</p>
        </div>
          @endif
@endauth
  @auth
      @if (auth()->user()->role == 0)
          <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/data_prangkat/{{ Auth::user()->id_desa }}" class="block font-bold">Data Prangkat Desa</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Manage Data Prangkat Desa</p>
        </div>
         @endif
@endauth
  @auth
    @if (auth()->user()->role == 0||auth()->user()->role == 2  )
          <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/data_umkm/{{ Auth::user()->id_desa }}" class="block font-bold">UMKM Saya</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Manage Data  UMKM</p>
        </div>
         @endif
@endauth

  @auth
   @if (auth()->user()->role == 0 ||auth()->user()->role == 2  )
          <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/admin_berita_saya/{{ Auth::user()->id_desa }}" class="block font-bold">Berita Saya</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Manage Data  Berita</p>
        </div>
        @endif

          @if (auth()->user()->role == 0 ||auth()->user()->role == 2 ||auth()->user()->role == 3  )
        <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/chat" class="block font-bold">Chat Bot</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Chat dengan Chat bot kami</p>
        </div>
        @endif
        @endauth
          @auth
          @if (auth()->user()->role == 0 ||auth()->user()->role == 2  )
        <hr class="border-t border-white opacity-80 my-2">
          <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/home_dokumen/{{ Auth::user()->id_desa }}" class="block font-bold">Template Dokumen</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Buat Template Dokumen</p>
        </div>
        @endif
        @endauth
          @auth
          @if (auth()->user()->role == 3 )
        <hr class="border-t border-white opacity-80 my-2">
          <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/home_dokumen" class="block font-bold">Template Dokumen</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Buat Template Dokumen</p>
        </div>
        @endif
        @endauth

        <hr class="border-t border-white opacity-80 my-2">
         <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/tutorial" class="block font-bold">Tutorial</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Lihat Tutorial penggunaan nya</p>
        </div>

        <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/berita" class="block font-bold">Berita</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Update informasi terbaru</p>
        </div>
         @auth
          @if (auth()->user()->role == 0 ||auth()->user()->role == 2  )
          <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/desaqu/{{ Auth::user()->id_desa }}" class="block font-bold">Desa</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Akses Desa Saya</p>
        </div>
        @endif
@endauth
@auth
          @if (auth()->user()->role == 0 ||auth()->user()->role == 2 ||auth()->user()->role == 3  )
        <hr class="border-t border-white opacity-80 my-2">
        <div class="group px-6 py-3 hover:border-l-4 hover:border-white">
            <a href="/about" class="block font-bold">Tentang Kami</a>
            <p class="text-sm opacity-80 group-hover:opacity-100">Cari tahu tentang kami</p>
        </div>
        @endif
        @endauth
    </nav>
</div>

<!-- Tombol Tutup Sidebar -->
<button id="closeButton" onclick="toggleSidebar()" class="hidden fixed left-72 top-4 px-5 py-2 bg-[#178a5a] text-white font-bold rounded-full border-2 border-white shadow-md z-50 transition-all duration-300 ease-in-out items-center space-x-2 hover:bg-white hover:text-[#178a5a]">
    <i class="fas fa-times"></i>
    <span>Tutup</span>
</button>

<!-- Script Konfirmasi Logout -->
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin keluar?',
            text: "Kamu akan keluar dari akun sekarang.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A936F',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        })
    }
</script>
