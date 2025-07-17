@php
    $path = public_path('storage/uploads/gambar/1.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp

<img src="{{ $base64 }}" alt="gambar" width="200">
