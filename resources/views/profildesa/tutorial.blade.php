@extends('layouts.master')

@section('title', 'Administrasi Terpadu')

@section('content')
<div class="max-w-4xl mx-auto mt-6 mb-4 bg-white rounded-lg shadow-lg p-4">
    <h2 class="text-xl font-bold text-white bg-[#48A98C] p-2 rounded-t-lg">
        Tutorial Penggunaan Platform
    </h2>
    <div class="flex justify-center">
        <!-- Container responsif dengan ukuran asli maksimal 865x450 -->
        <div class="w-full max-w-[865px] relative aspect-[865/450]">
            <video class="absolute inset-0 w-full h-full" controls>
                <source src="image\tutor.mp4" type="video/mp4">
            </video>
        </div>
    </div>
</div>
@endsection
