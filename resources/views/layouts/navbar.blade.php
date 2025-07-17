<header class="bg-[#1A936F] p-4 flex justify-between items-center text-white w-full z-[30] backdrop-blur-md">
    <button onclick="toggleSidebar()" class="text-white text-2xl">
        <i class="fas fa-bars"></i>
    </button>

    <div class="flex items-center ml-auto">
        <img src="{{ asset('image/Group 23.png') }}" alt="Logo DesaGo" class="h-12 w-12 rounded-full">

        <div class="ml-2">
            <h1 class="text-xl font-bold">DesaGo</h1>
            <p class="text-sm">Bangun Desa Bangun Indonesia</p>
        </div>
@auth
<a href="/profil/{{ Auth::user()->id_user }}" class="text-white text-2xl ml-4 flex items-center space-x-2">
    <i class="fas fa-user-circle"></i>
    <span class="text-base">{{ Auth::user()->nama }}</span>
</a>
@endauth

    </div>
</header>
