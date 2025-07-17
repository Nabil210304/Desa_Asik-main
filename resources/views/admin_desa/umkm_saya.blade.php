@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                        No
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                        Nama
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                        kategori UMKM
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                        Nomer izin usaha
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                        Nomer Telepone
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($umkm as $index => $user)
                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-purple-50' }}">
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $user->nama_umkm }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $user->kategori_umkm }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $user->nomor_izin_berusaha }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $user->no_telepon}}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <a class="text-blue-500 hover:text-blue-700 mr-2" href="/admin_desa_umkm_edit/{{$user->id_umkm}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="/admin_desa_hapus_umkm/{{$user->id_umkm }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:text-red-700" onclick="return confirm('Yakin hapus user ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex items-center justify-between p-5 bg-white border-t border-gray-200">
            <a href="/desa_tambah_umkm/{{$id}}" class="bg-purple-600 text-white px-4 py-2 rounded-md text-sm flex items-center hover:bg-purple-700">
                <i class="fas fa-plus mr-2"></i>
                Tambah UMKM
            </a>
        </div>
    </div>
</div>
@endsection
