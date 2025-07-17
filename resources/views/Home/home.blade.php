@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="relative">
        <img alt="Farmers working in a rice field" class="w-full h-[500px] md:h-[700px] lg:h-[900px] object-cover" src="image/image 2.png"/>

        <!-- Overlay Gelap -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <!-- Konten -->
        <div class="absolute inset-0 flex flex-col justify-center items-center md:items-start text-white px-6 md:px-12 text-center md:text-left">
            <h2 class="text-3xl md:text-5xl font-bold">
                Transparansi Dana Desa

            </h2>
            <p class="text-lg md:text-2xl mt-2">
                Cek Alokasi Dana Desamu dengan Mudah &amp; Transparan
            </p>
            <button onclick="window.location.href='/profildesa'"
                class="bg-[#1A936F] hover:bg-green-700 text-white font-bold py-4 px-6 md:py-5 md:px-8 rounded-full mt-4 text-base md:text-xl">
                Jelajahi Sekarang
            </button>
        </div>
    </div>


@endsection
