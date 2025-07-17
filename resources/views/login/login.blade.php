@extends('login.masterlogin')

@section('title', 'Home')

@section('navbar')
@endsection  <!-- Menghapus navbar -->

@section('footer')
@endsection  <!-- Menghapus footer -->

@section('content')
<div class="flex flex-col md:flex-row bg-[#F9F9F9] min-h-screen">
    <!-- Left Section -->
    <div class="flex-1 flex items-start justify-center p-6 z-[2]">
        <div class="mt-8 ml-4">
            <div class="flex items-center space-x-4">
                <img alt="Kementerian Desa Logo" class="mb-0" height="75" width="75" src="image/Group 23.png"/>
                <div class="leading-tight">
                    <h1 class="text-[22px] font-semibold text-[#1E1E1E]">Kementerian Desa</h1>
                    <p class="text-[14px] text-[#A0A0A0] mt-[-2px]">Bangun Desa Bangun Indonesia</p>
                </div>
            </div>
            <div class="mt-8 flex justify-center">
                <img
                src="image/blob 2.png"
                alt="Digital Transformation"
                class="w-[550px] h-auto animasi-naik-turun"
                />
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="flex-1 flex items-center justify-center p-6 z-[1] bg-[#F9F9F9]">
        <div class="bg-white px-10 py-8 rounded-[20px] shadow-lg w-full max-w-md">
            <img alt="Hand holding a phone" class="mx-auto mb-4" src="image/device.png" width="100"/>
            <h2 class="text-xl font-semibold text-center mb-6 text-[#1E1E1E]">
                Transformasi Digital Berawal Disini
            </h2>
            <form action="/login" method="post">
                @csrf
                <div class="mb-4">
                    <div class="flex items-center bg-[#92E3A9] rounded-md overflow-hidden">
                        <span class="px-3 text-gray-700">
                            <i class="fas fa-user"></i>
                        </span>
                        <input class="w-full bg-[#92E3A9] px-3 py-2 focus:outline-none" name="email" placeholder="ID Desa" type="text" required />
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex items-center bg-[#92E3A9] rounded-md overflow-hidden relative">
                        <span class="px-3 text-gray-700">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input id="password-input" class="w-full bg-[#92E3A9] px-3 py-2 focus:outline-none" name="password" placeholder="Kata Sandi" type="password" required />
                        <button type="button" onclick="togglePassword()" class="absolute right-3 text-gray-600 focus:outline-none">
                            <i id="eye-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="flex justify-end mb-4">
                    <a class="text-sm text-green-600 hover:underline" href="/forgot-password">
                        Lupa kata sandi?
                    </a>
                </div>
                <div class="text-center">
                    <button class="bg-[#1A936F] hover:bg-white hover:text-[#178a5a] text-white font-semibold py-2 w-full rounded-[25px] shadow-md transition-all duration-300" type="submit">
                        Masuk
                    </button>
                </div>
            </form>
            <div class="text-center mt-4">
                <a class="text-sm text-gray-400 hover:text-gray-600" href="/register">
                    Buat Akun →
                </a>
            </div>
        </div>
    </div>
</div>
<script>
function togglePassword() {
    const input = document.getElementById('password-input');
    const icon = document.getElementById('eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

document.getElementById('form-login').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);
    const errorDiv = document.getElementById('login-error');
    errorDiv.textContent = '';

    try {
        const res = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: data
        });

        if (res.ok) {
            // Jika sukses, redirect ke home
            window.location.href = '/home';
        } else {
            const result = await res.json();
            if(result.errors && result.errors.email) {
                errorDiv.textContent = result.errors.email[0];
            } else if(result.message) {
                errorDiv.textContent = result.message;
            } else {
                errorDiv.textContent = 'Terjadi kesalahan. Coba lagi.';
            }
        }
    } catch (err) {
        errorDiv.textContent = 'Gagal terhubung ke server.';
    }
});
</script>
@endsection
