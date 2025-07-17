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
                        Email
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                        Alamat
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                        Role
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-purple-50' }}">
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $user->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $user->email }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $user->alamat }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        {{ $user->role == 1 ? 'user' : 'admin' }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <a class="text-blue-500 hover:text-blue-700 mr-2" href="/admin_desa_edit/{{$user->id_user}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="/admin_desa_hapus/{{$user->id_user }}" method="POST" class="inline">
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
            <a href="/desa_tambah_user/{{$user->id_desa }}" class="bg-purple-600 text-white px-4 py-2 rounded-md text-sm flex items-center hover:bg-purple-700">
                <i class="fas fa-plus mr-2"></i>
                Tambah User
            </a>
        </div>
    </div>
</div>
@endsection
