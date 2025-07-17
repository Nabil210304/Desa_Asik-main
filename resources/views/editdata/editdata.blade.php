@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div class="bg-white shadow-lg border-2 rounded-lg w-[500px] mb-4 mt-5 max-w-full mx-auto">
    <!-- Header -->
    <div class="bg-[#48A98C] text-white font-bold text-lg p-4 rounded-t-lg text-center">
        Edit Data Desa
    </div>

    <!-- Body -->
    <div class="p-6">
        <label for="dataSelect" class="block mb-2 text-gray-700 font-medium">
            Pilih data yang ingin di edit.
        </label>
        <select id="dataSelect" class="w-full p-3 border border-purple-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            <option>Profile Desa</option>
            <option>UMKM Desa</option>
            <option>Administrasi Terpadu</option>
            <option>Wisata</option>
            <option>Berita</option>
        </select>

        <!-- Button -->
        <div class="mt-6 text-center">
            <button class="inline-block bg-[#1A936F] text-white font-bold no-underline py-2 px-5 rounded-full border-2 border-white text-[16px] shadow-md transition-all duration-300 ease-in-out hover:bg-white hover:text-[#178a5a]">
                EDIT DATA
            </button>
        </div>
    </div>
</div>
@endsection
