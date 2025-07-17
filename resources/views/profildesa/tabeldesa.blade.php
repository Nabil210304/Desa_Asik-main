@extends('layouts.master')

@section('title', 'Home')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- Font Awesome (buat icon edit/delete) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table id="umkmTable" class="display min-w-full">
            <thead>
                <tr>
                    
                    <th>Desa</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten/Kota</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
               
                <tr>
                    <td>{{ $data->nama_desa }}</td>
                    
                    <td>{{$data->kecamatan}}</td>
                    <td>{{$data->kabupaten}}</td>
            
                    <td>
                        <a href="/admin_desaqu/{{$data->id_prangkat_desa}}" class="text-blue-500 mr-2"><i class="fas fa-edit"></i></a>
                       <form action="{{ url('/hapus_desa/' . $data->id_desa) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-500 hover:text-red-700">
        <i class="fas fa-trash"></i>
    </button>
</form>

                    </td>
                </tr>
              
            </tbody>
            @endforeach
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    $('#umkmTable').DataTable({
      responsive: true
    });
  });
</script>

@endsection
