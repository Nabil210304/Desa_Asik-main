@extends('login.masterlogin')

@section('title', 'Home')

@section('content')
   <main class="flex-grow flex flex-col items-center mb-5 mt-8 md:mt-12 px-4 md:px-6">
       <div class="bg-white shadow-md rounded-lg p-8 w-full min-w-[320px] max-w-lg">
            <h2 class="text-[#1A936F] text-2xl font-bold mb-4 text-center">
                Pendaftaran Akun
            </h2>

            <!-- Jenis Pendaftaran -->
        <form action="/role" method="GET">
    <div class="mb-4">
        <label class="block text-gray-700 mb-2 text-lg md:text-xl" for="jenis-pendaftaran">
            Jenis Pendaftaran
        </label>
        
        <select class="w-full border border-gray-300 rounded-lg p-2 text-lg md:text-xl" 
                id="jenis-pendaftaran" name="jenis_pendaftaran">
            <option value="">Pilih role</option>
            <option value="masyarakat">Pendaftaran Masyarakat</option>
            <option value="desa">Pendaftaran Akun Desa</option>
        </select>
    </div>

      <button  type="submit" class="bg-[#1A936F] text-white w-full py-2 rounded-lg font-semibold text-lg md:text-xl">
                Lanjut
            </button>
</form>


            <!-- Tombol Lanjut -->
           

            <!-- Link Masuk -->
            <p class="text-center mt-4 text-lg md:text-xl">
                Sudah punya Akun?
                <a class="text-[#1A936F] font-semibold" href="#">Masuk disini</a>
            </p>
        </div>
   </main>
@endsection


