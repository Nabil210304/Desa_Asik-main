@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div class="container mx-auto p-4 ">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
           <!-- Tombol Kembali -->
    <a href="javascript:history.back()"
    class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-full shadow transition mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>
     <table class="min-w-full leading-normal">
      <thead>
       <tr class="bg-gray-100">

        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Nama
        </th>

        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Jumlah
        </th>
        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Deskripsi
        </th>
         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
       Tahun
        </th>
         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Bulan
        </th>
         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         kuitansi
        </th>
         <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Status
        </th>
        <th class="px-5 py-3 border-b-2 border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
         Action
        </th>
       </tr>
      </thead>
      <tbody>
      <tbody>
    @foreach($pengluaran as $item)
    <tr class="{{ $loop->even ? 'bg-purple-50' : '' }}">

        <td class="px-5 py-5 border-b border-gray-200 text-sm flex items-center">

            {{ $item->nama }}
        </td>

        <td class="px-5 py-5 border-b border-gray-200 text-sm">
               Rp{{ number_format($item->jumlah, 0, ',', '.') }}
        </td>

        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{ $item->deskripsi }}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{ $item->tahun }}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{ $item->bulan }}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            @if($item->kuitansi)
          <a href="{{ asset($item->kuitansi) }}" target="_blank" class="text-blue-500 underline">Lihat</a>

            @else
                <span class="text-gray-400">Tidak ada</span>
            @endif
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            {{$item->status}}
        </td>
        <td class="px-5 py-5 border-b border-gray-200 text-sm">
            <a href="/edit_pengluaran/{{ $item->id}}" class="text-blue-500 hover:text-blue-700 mr-2">
                <i class="fas fa-edit"></i>
            </a>
            <form action="/hapus_pengluaran/{{ $item->id}}" method="POST" class="inline">
                @csrf
                @method('DELETE')
               <input type="hidden" name="id_desa" value="{{ $item->id_desa}}" />

                <button onclick="return confirm('Yakin ingin hapus?')" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>

     </table>

</div>

     <div class="flex items-center justify-between p-5 bg-white border-t border-gray-200">
      <div class="flex items-center">
       <span class="text-sm text-gray-700">
        Show
       </span>
       <select class="mx-2 border border-gray-300 rounded-md text-sm text-gray-700">
        <option>
         5
        </option>
        <option>
         10
        </option>
        <option>
         15
        </option>
       </select>
       <span class="text-sm text-gray-700">
        entries
       </span>
      </div>
      <div class="relative">
       <input class="border border-gray-300 rounded-md text-sm text-gray-700 pl-8 pr-4 py-2" placeholder="Search..." type="text"/>
       <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <i class="fas fa-search text-gray-400">
        </i>
       </div>
      </div>

  <a href="/tambah_pengeluaran_desa/{{$id}}" class="bg-purple-600 text-white px-4 py-2 rounded-md text-sm flex items-center hover:bg-purple-700">
  <i class="fas fa-plus mr-2"></i>
  Tambah pengeluaran
</a>
     </div>
    </div>
   </div>



@endsection
