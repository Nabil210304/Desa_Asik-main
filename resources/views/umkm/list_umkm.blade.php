 
 @extends('layouts.master')

@section('title', 'Admin UMKM')

@section('content')
   <main class="px-8 py-10">
   <div class="overflow-x-auto">
    <table class="w-full border-collapse text-sm">
     <thead>
      <tr class="text-black font-semibold text-left border-b border-gray-200">
       <th class="py-3 px-4 min-w-[60px]">
        Nama UMKM
       </th>
       <th class="py-3 px-4 min-w-[160px]">
       Waktu Operasional
        <i class="fas fa-sort text-gray-400 ml-1">
        </i>
       </th>
       <th class="py-3 px-4 min-w-[100px]">
        Kategori UMKM
        <i class="fas fa-sort text-gray-400 ml-1">
        </i>
       </th>
       <th class="py-3 px-4 min-w-[100px]">
        NIB
        <i class="fas fa-sort text-gray-400 ml-1">
        </i>
       </th>
       <th class="py-3 px-4 min-w-[120px]">
        Nomer Telepon
        <i class="fas fa-sort text-gray-400 ml-1">
        </i>
       </th>
      
       <th class="py-3 px-4 min-w-[100px]">
        Action
       </th>
      </tr>
     </thead>
   <tbody>
    @forelse($data as $row)
    <tr class="bg-[#f8f8ff]">
        <td class="py-4 px-4">
            {{ $row->nama_umkm }}
        </td>
        <td class="py-4 px-4">
            {{ $row->waktu_operasional }}
        </td>
        <td class="py-4 px-4">
            {{ $row->kategori_umkm ?? '-' }}
        </td>
        <td class="py-4 px-4">
            {{ $row->nomor_izin_berusaha ?? '-' }}
        </td>
        <td class="py-4 px-4">
            {{ $row->no_telepon ?? '-' }}
        </td>
   <td class="py-4 px-4 space-x-3 flex items-center">

    <!-- Tombol Edit -->
    <a href="{{ url('/admin/umkm/edit/' . $row->id_umkm) }}" aria-label="Edit {{ $row->id_umkm }}" class="text-indigo-600 hover:text-indigo-400">
        <i class="fas fa-edit text-lg"></i>
    </a>

    <!-- Tombol Hapus -->
    <form action="{{ url('/admin/umkm/delete/' . $row->id_umkm) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-400 ml-2" aria-label="Hapus {{ $row->id_umkm }}">
            <i class="fas fa-trash-alt text-lg"></i>
        </button>
    </form>

</td>


        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="py-4 px-4 text-center text-gray-500">Tidak ada data UMKM</td>
    </tr>
    @endforelse
</tbody>

    </table>
   </div>
   <!-- Controls below table -->
   <div class="flex flex-col md:flex-row items-center justify-between mt-6 gap-4">
    <div class="flex items-center space-x-2 text-sm">
     <span>
      Show
     </span>
     <select aria-label="Select number of entries to show" class="bg-gray-200 rounded-md px-3 py-1 cursor-pointer text-gray-700">
      <option>
       5
      </option>
      <option>
       10
      </option>
      <option>
       15
      </option>
      <option>
       20
      </option>
     </select>
     <span>
      entries
     </span>
    </div>
    <input aria-label="Search table" class="border border-gray-300 rounded-md px-3 py-1 w-60 text-sm focus:outline-none focus:ring-2 focus:ring-[#42977d]" placeholder="Search..." type="search"/>
    <a href="/tambah-umkm"
   class="bg-indigo-600 text-white font-semibold rounded-md px-4 py-2 flex items-center space-x-2 hover:bg-indigo-700 transition">
  <i class="fas fa-plus"></i>
  <span>Tambah umkm</span>
</a>

   </div>
  </main>
@endsection
