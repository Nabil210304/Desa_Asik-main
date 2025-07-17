<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Kementerian Desa
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: "Poppins", sans-serif;
    }
  </style>
 </head>
 <body class="bg-white text-black">
  <!-- Header -->
  <header class="bg-[#42977d] flex justify-between items-center px-8 py-6">
   <button class="bg-[#0f6a56] text-white font-semibold rounded-full px-6 py-2 border border-white shadow-[0_4px_0_0_rgba(0,0,0,0.15)] hover:brightness-110 transition" type="button">
    Kembali
   </button>
   <div class="flex items-center space-x-4">
    <img alt="Logo of Kementerian Desa with red roof, green and blue elements inside a circle" class="w-12 h-12" height="48" src="https://storage.googleapis.com/a1aa/image/7de37ff5-8a28-41bf-1558-bc04db387f8d.jpg" width="48"/>
    <div class="text-white">
     <h1 class="font-extrabold text-xl leading-none">
      Kementerian Desa
     </h1>
     <p class="text-sm font-normal leading-tight">
      Bangun Desa Bangun Indonesia
     </p>
    </div>
   </div>
  </header>
  <!-- Table Section -->
  <main class="px-8 py-10">
   <div class="overflow-x-auto">
    <table class="w-full border-collapse text-sm">
     <thead>
      <tr class="text-black font-semibold text-left border-b border-gray-200">
       <th class="py-3 px-4 min-w-[60px]">
        No
       </th>
       <th class="py-3 px-4 min-w-[160px]">
        Nama Wisata
        <i class="fas fa-sort text-gray-400 ml-1">
        </i>
       </th>
       <th class="py-3 px-4 min-w-[100px]">
        Desa
        <i class="fas fa-sort text-gray-400 ml-1">
        </i>
       </th>
       <th class="py-3 px-4 min-w-[100px]">
        Kecamatan
        <i class="fas fa-sort text-gray-400 ml-1">
        </i>
       </th>
       <th class="py-3 px-4 min-w-[120px]">
        Kabupaten/ Kota
        <i class="fas fa-sort text-gray-400 ml-1">
        </i>
       </th>
       <th class="py-3 px-4 min-w-[100px]">
        Provinsi
        <i class="fas fa-sort text-gray-400 ml-1">
        </i>
       </th>
       <th class="py-3 px-4 min-w-[100px]">
        Action
       </th>
      </tr>
     </thead>
     <tbody>
      <tr class="bg-[#f8f8ff]">
       <td class="py-4 px-4">
        #20462
       </td>
       <td class="py-4 px-4 flex items-center space-x-2">
        <img alt="Image of a brown traditional woven basket representing Wisata Desa Sade" class="w-8 h-8 rounded" height="32" src="https://storage.googleapis.com/a1aa/image/7682710c-de48-4566-783e-fccbc8dea417.jpg" width="32"/>
        <span>
         Wisata Desa Sade
        </span>
       </td>
       <td>
        <div class="flex items-center gap-2">
          <img alt="Image of a brown traditional woven basket representing Desa Kedayunan"
               class="w-8 h-8 rounded"
               height="32"
               src="https://storage.googleapis.com/a1aa/image/fec8284a-6564-43e3-e376-b9a6ccb3076c.jpg"
               width="32"/>
          <span>Kedayunan</span>
        </div>
      </td>

       <td class="py-4 px-4">
        Kabat
       </td>
       <td class="py-4 px-4">
        Banyuwangi
       </td>
       <td class="py-4 px-4">
        Jawa Timur
       </td>
       <td class="py-4 px-4 space-x-3">
        <button aria-label="Edit #20462" class="text-indigo-600 hover:text-indigo-400">
         <i class="fas fa-edit text-lg">
         </i>
        </button>
        <button aria-label="Delete #20462" class="text-red-700 hover:text-red-500">
         <i class="fas fa-trash-alt text-lg">
         </i>
        </button>
       </td>
      </tr>
      <tr>


      </tr>
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
    <button class="bg-indigo-600 text-white font-semibold rounded-md px-4 py-2 flex items-center space-x-2 hover:bg-indigo-700 transition" type="button">
     <i class="fas fa-plus">
     </i>
     <span>
      Tambah Wisata
     </span>
    </button>
   </div>
  </main>
  <!-- Footer -->
  <footer class="px-20 py-12 flex flex-col md:flex-row justify-between gap-12 md:gap-0">
   <!-- Kontak -->
   <div class="flex flex-col gap-6 max-w-xs">
    <h2 class="text-[#42977d] font-extrabold text-lg">
     Kontak
    </h2>
    <a class="flex items-center gap-3 border border-[#0f6a56] rounded-full px-5 py-2 w-max text-black hover:bg-[#0f6a56] hover:text-white transition" href="tel:+621234567878">
     <i class="fas fa-phone-alt text-lg">
     </i>
     <span class="font-semibold text-base">
      +62 123 456 7878
     </span>
    </a>
    <a class="flex items-center gap-3 border border-[#0f6a56] rounded-full px-5 py-2 w-max text-black hover:bg-[#0f6a56] hover:text-white transition" href="mailto:official@gmail.com">
     <i class="fas fa-envelope text-lg">
     </i>
     <span class="font-semibold text-base">
      official@gmail.com
     </span>
    </a>
   </div>
   <!-- Jelajahi -->
   <div class="max-w-xs">
    <h2 class="text-[#42977d] font-extrabold text-lg mb-4">
     Jelajahi
    </h2>
    <ul class="list-disc list-inside space-y-2 text-base font-normal text-black">
     <li>
      Kebijakan Privasi
     </li>
     <li>
      Syarat dan Ketentuan
     </li>
     <li>
      Pusat Bantuan
     </li>
    </ul>
   </div>
   <!-- Sosial Media -->
   <div class="max-w-xs flex flex-col items-start gap-6">
    <h2 class="text-[#42977d] font-extrabold text-lg">
     Sosial Media
    </h2>
    <div class="flex flex-wrap gap-4 text-3xl">
     <a aria-label="Instagram" class="hover:opacity-80 transition" href="#">
      <i class="fab fa-instagram text-gradient" style="background: linear-gradient(45deg, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
      </i>
     </a>
     <a aria-label="Facebook" class="hover:opacity-80 transition text-blue-700" href="#">
      <i class="fab fa-facebook-square">
      </i>
     </a>
     <a aria-label="X" class="hover:opacity-80 transition text-black" href="#">
      <i class="fab fa-x-twitter">
      </i>
     </a>
     <a aria-label="LinkedIn" class="hover:opacity-80 transition text-blue-800" href="#">
      <i class="fab fa-linkedin">
      </i>
     </a>
     <a aria-label="YouTube" class="hover:opacity-80 transition text-red-600" href="#">
      <i class="fab fa-youtube">
      </i>
     </a>
     <a aria-label="TikTok" class="hover:opacity-80 transition text-black" href="#">
      <img alt="TikTok logo black icon" class="w-8 h-8" height="32" src="https://storage.googleapis.com/a1aa/image/7fbbc5d6-de42-4be2-05a2-d44c307361d8.jpg" width="32"/>
     </a>
     <a aria-label="WhatsApp" class="hover:opacity-80 transition text-green-600" href="#">
      <i class="fab fa-whatsapp">
      </i>
     </a>
    </div>
    <div class="flex items-center gap-6">
     <img alt="Logo of Kementerian Desa with red roof, green and blue elements inside a circle" class="w-12 h-12" height="48" src="https://storage.googleapis.com/a1aa/image/7de37ff5-8a28-41bf-1558-bc04db387f8d.jpg" width="48"/>
     <img alt="QR code for Kementerian Desa" class="w-16 h-16" height="64" src="https://storage.googleapis.com/a1aa/image/709d563c-456a-4e82-7956-28984ff685b9.jpg" width="64"/>
    </div>
   </div>
  </footer>
 </body>
</html>
