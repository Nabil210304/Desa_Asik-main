<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EditdataController;
use App\Http\Controllers\ProfilDesaController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\super_admin_manege_user;
use App\Http\Controllers\super_admin_manage_desa;
use App\Http\Controllers\admin_desa_desa_saya;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\masyarakat;
use App\Http\Controllers\admin_desa_manage_prangkat;
use App\Http\Controllers\admin_desa_manage_umkm;
use App\Http\Controllers\admin_desa_manage_berita;
use App\Http\Middleware\CekRole;


// template dokumen
Route::post('/upload-img', [ImageUploadController::class, 'uploadGambar'])->name('upload.gambar')->middleware('auth');
Route::post('/upload-gambar', [ImageUploadController::class, 'uploadImage'])->middleware('auth');
Route::post('/simpan_dokumen', [ImageUploadController::class, 'tambah'])->middleware('auth');
Route::get('/home_dokumen/{id}', [ImageUploadController::class, 'home_desa'])->middleware('auth');
Route::get('/home_dokumen', [ImageUploadController::class, 'home'])->middleware('auth');
Route::post('/tambah_dokumen', [ImageUploadController::class, 'tambah_dokument'])->middleware('auth');
Route::get('/surat/{id}/edit', [ImageUploadController::class, 'edit'])->name('surat.edit')->middleware('auth');
Route::delete('/surat/{id}', [ImageUploadController::class, 'hapusSurat'])->name('surat.destroy');
Route::get('pengaturan/{id}', [ImageUploadController::class, 'pengaturan'])->middleware('auth');
Route::put('/surat/update/{id}', [ImageUploadController::class, 'update_surat'])->name('surat.update')->middleware('auth');
Route::delete('/hapus-gambar/{id}', [ImageUploadController::class, 'hapusGambar_surat'])->name('gambar.hapus')->middleware('auth');


// chat

// super admin
Route::view('/chat', 'chat');

Route::get('/data_user', [super_admin_manege_user::class, 'index'])->middleware(CekRole::class . ':3');
Route::get('/admin_edit/{id}', [super_admin_manege_user::class, 'v_edit']);
Route::get('/user/download-gambar/{id}', [super_admin_manege_user::class, 'download_gambar'])->name('user.download.gambar');
Route::put('super_admin_edit_user/{id}', [super_admin_manege_user::class, 'edit'])->middleware('auth');

Route::get('/tambah_desa', [ProfilDesaController::class, 'tambahDesa'])->middleware(CekRole::class . ':3');

Route::delete('/hapus_desa/{id}', [ProfilDesaController::class, 'destroy'])->name('desa.destroy');
Route::get('/admin_desaqu/{id}', [ProfilDesaController::class, 'detail_desa'])->middleware('auth');
Route::get('/filter_desa', [ProfilDesaController::class, 'filterDesa'])->middleware('auth');
Route::get('/serach_desa', [ProfilDesaController::class, 'cari'])->middleware('auth');
Route::post('/super_admin_tambahdesa', [super_admin_manage_desa::class, 'tambah'])->middleware(CekRole::class . ':3');
Route::get('/desa/{id}', [masyarakat::class, 'detail_desa'])->middleware('auth');

// admin desa
Route::get('/desaqu/{id}', [admin_desa_desa_saya::class, 'index'])->middleware(CekRole::class . ':0,2');
Route::get('/v_edit_desa_saya/{id}', [admin_desa_desa_saya::class, 'v_edit'])->middleware(CekRole::class . ':0,2');
Route::get('/data_pengeluaran_desa/{id}', [admin_desa_desa_saya::class, 'tabel_pengeluaran'])->middleware(CekRole::class . ':0,2');
Route::get('/pengeluaran/{id}', [admin_desa_desa_saya::class, 'download'])->middleware('auth');;
Route::get('/tambah_pengeluaran_desa/{id}', [admin_desa_desa_saya::class, 'form_pengeluaran'])->middleware(CekRole::class . ':0,2');
Route::get('/tambah_pemasukan_desa/{id}', [admin_desa_desa_saya::class, 'form_pemasukan'])->middleware(CekRole::class . ':0,2');
Route::post('/admin_desa_edit/{id}', [admin_desa_desa_saya::class, 'update'])->middleware(CekRole::class . ':0,2');;
Route::post('/admin_desa_tambah_pengluaran/{id}', [admin_desa_desa_saya::class, 'tambah_pengeluaran'])->middleware(CekRole::class . ':0,2');
Route::get('/edit_pengluaran/{id}', [admin_desa_desa_saya::class, 'v_edit_pengluaran'])->middleware(CekRole::class . ':0,2');
Route::post('/edit_pengeluaran/{id}', [admin_desa_desa_saya::class, 'proses_edit_pengluaran'])->middleware(CekRole::class . ':0,2');
Route::delete('/hapus_pengluaran/{id}', [admin_desa_desa_saya::class, 'hapus'])->middleware(CekRole::class . ':0,2');;
Route::post('/admin_desa_tambah_pemasukan/{id}', [admin_desa_desa_saya::class, 'tambah_pemasukan'])->middleware(CekRole::class . ':0,2');
Route::get('/edit_pemasukan/{id}', [admin_desa_desa_saya::class, 'v_edit_pemasukan'])->middleware(CekRole::class . ':0,2');
Route::post('/edit_pemasukan/{id}', [admin_desa_desa_saya::class, 'proses_edit_pemasukan'])->middleware(CekRole::class . ':0,2');
Route::delete('/hapus_pemasukan/{id}', [admin_desa_desa_saya::class, 'hapus_pemasukan'])->middleware(CekRole::class . ':0,2');;
Route::get('/v_data_pemasukan/{id}', [admin_desa_desa_saya::class, 'tabel_pemasukan'])->middleware(CekRole::class . ':0,2');
Route::get('/data_prangkat/{id}', [admin_desa_manage_prangkat::class, 'index'])->middleware(CekRole::class . ':0');
Route::get('/admin_desa_edit/{id}', [admin_desa_manage_prangkat::class, 'v_edit'])->middleware(CekRole::class . ':0');
Route::put('/admin_desa_edit_user/{id}', [admin_desa_manage_prangkat::class, 'edit'])->middleware(CekRole::class . ':0');
Route::post('/admin_desa_tambah_user', [admin_desa_manage_prangkat::class, 'proses_tambah'])->middleware(CekRole::class . ':0');
Route::delete('/admin_desa_hapus/{id_user}', [admin_desa_manage_prangkat::class, 'destroy'])->name('admin_desa.hapus')->middleware(CekRole::class . ':0');
Route::get('/desa_tambah_user/{id}', [admin_desa_manage_prangkat::class, 'tambah'])->middleware(CekRole::class . ':0');


Route::get('/data_umkm/{id}', [admin_desa_manage_umkm::class, 'index'])->middleware(CekRole::class . ':0,2');
Route::get('/desa_tambah_umkm/{id}', [admin_desa_manage_umkm::class, 'tambah'])->middleware(CekRole::class . ':0,2');
Route::put('/edit_umkm_admin_desa/{id_umkm}', [admin_desa_manage_umkm::class, 'update'])->middleware(CekRole::class . ':0,2');
Route::delete('/admin_desa_hapus_umkm/{id}', [admin_desa_manage_umkm::class, 'destroy'])->middleware(CekRole::class . ':0,2');
Route::get('/admin_desa_umkm_edit/{id}', [admin_desa_manage_umkm::class, 'vedit'])->middleware(CekRole::class . ':0,2');
Route::post('/admin_desa_umkm_simpan', [admin_desa_manage_umkm::class, 'simpanUmkmBaru'])->middleware(CekRole::class . ':0,2');



Route::get('/admin_berita_saya/{id}', [admin_desa_manage_berita::class, 'index'])->middleware(CekRole::class . ':0,2');
Route::post('/admin_desa_tambah_berita', [admin_desa_manage_berita::class, 'simpanBerita'])->name('berita.simpan')->middleware(CekRole::class . ':0,2');
Route::get('/admin_desa_tambah-berita', [admin_desa_manage_berita::class, 'vtambah'])->middleware(CekRole::class . ':0,2');
Route::get('/admin_desa_vedit', [admin_desa_manage_berita::class, 'vt'])->middleware(CekRole::class . ':0,2');
Route::get('/admin_desa_vedit/{id}', [admin_desa_manage_berita::class, 'editBerita'])->middleware(CekRole::class . ':0,2');


// auth
Route::get('/', [AuthController::class, 'login']);
Route::get('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('/role', [AuthController::class, 'register_role']);
Route::get('/register-alt', [AuthController::class, 'registerAlt']);
Route::get('/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/request-accepted', [AuthController::class, 'requestAccepted']);
Route::get('/reset-success', [AuthController::class, 'resetSuccess']);
Route::get('/verify', [AuthController::class, 'verify']);
Route::get('/profil/{id}', [AuthController::class, 'profil']);
Route::post('/daftar_masyarakat', [AuthController::class, 'daftar_masyarakat']);
Route::post('/daftar_desa', [AuthController::class, 'regis_desa']);
Route::put('/profil/{id}', [AuthController::class, 'proses_update'])->name('profil.update');
Route::get('/register_desa', [AuthController::class, 'v_regis_desa']);
Route::post('/login', [AuthController::class, 'proseslogin']);
Route::post('/forgot-password', [AuthController::class, 'prosesForgotPassword']);
Route::get('/repassword', [AuthController::class, 'resetPassword']);
Route::post('/repassword', [AuthController::class, 'prosesResetPassword']);


//landing
Route::get('/home', [HomeController::class, 'home'])->middleware('auth');
Route::get('/about', [HomeController::class, 'about'])->middleware('auth');


// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index')->middleware('auth');
Route::get('/tambah-berita', [BeritaController::class, 'tambahBerita'])->name('berita.tambah')->middleware(CekRole::class . ':3');
Route::get('/berita/detail/{id}', [BeritaController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/berita/edit/{id}', [BeritaController::class, 'editBerita'])->name('berita.edit')->middleware(CekRole::class . ':0,2,3');
Route::put('/berita/edit/{id}', [BeritaController::class, 'updateBerita'])->middleware(CekRole::class . ':0,2,3');
Route::get('/listberita', [BeritaController::class, 'listBerita'])->name('listberita')->middleware(CekRole::class . ':3');
Route::post('/tambah-berita', [BeritaController::class, 'simpanBerita'])->name('berita.simpan')->middleware('auth');
Route::delete('/berita/delete/{id}', [BeritaController::class, 'deleteBerita'])->middleware('auth');
Route::post('/berita/ulasan/tambah/{id}', [BeritaController::class, 'tambahUlasan'])->name('ulasan.tambah')->middleware('auth');

// web.php
Route::get('/cari_berita', [BeritaController::class, 'cariBerita'])->middleware('auth');;
Route::get('/filter_berita_desa', [BeritaController::class, 'filter_berita_desa'])->middleware('auth');

// Edit Data
Route::get('/editdata', [EditdataController::class, 'index'])->middleware('auth');

// Profil Desa
Route::get('/profildesa', [ProfilDesaController::class, 'index'])->name('profildesa.index')->middleware('auth');
Route::get('/profildetail', [ProfilDesaController::class, 'detail'])->middleware('auth');
Route::get('/tutorial', [ProfilDesaController::class, 'tutorial'])->middleware('auth');
Route::get('/tambah_desa', [ProfilDesaController::class, 'tambahDesa'])->middleware('auth');
Route::post('/desa/simpan', [ProfilDesaController::class, 'simpanDesa'])->name('desa.simpan')->middleware('auth');;
Route::get('/admin/manipulasi_desa', [ProfilDesaController::class, 'tabel'])->middleware('auth');

// UMKM
Route::get('/umkm', [UmkmController::class, 'index'])->middleware('auth');
Route::get('/umkm/{id}', [UmkmController::class, 'vdetail'])->name('umkm.show')->middleware('auth');
Route::get('/tambah-umkm', [UmkmController::class, 'tambahUmkm'])->middleware(CekRole::class . ':3');
Route::get('/manipulasi', [UmkmController::class, 'view_admin_list_umkm'])->middleware(CekRole::class . ':3');
Route::post('/tambah-umkm', [UmkmController::class, 'simpanUmkmBaru'])->name('umkm.simpan')->middleware('auth');
Route::get('/umkms', [UmkmController::class, 'index'])->name('umkm.index')->middleware('auth');
Route::get('/admin/umkm/edit/{id}', [UmkmController::class, 'vedit'])->middleware(CekRole::class . ':0,2,3');
Route::put('/edit_umkm_admin/{id_umkm}', [UmkmController::class, 'update'])->middleware(CekRole::class . ':0,2,3');
Route::delete('/admin/umkm/delete/{id}', [UmkmController::class, 'destroy'])->middleware(CekRole::class . ':0,2,3');
Route::match(['get', 'post'], '/serach', [UmkmController::class, 'cari'])->middleware('auth');;

// Wisata
Route::get('/wisata', [WisataController::class, 'index'])->middleware('auth');
Route::get('/wisatadetail', [WisataController::class, 'wisatadetail'])->middleware('auth');
Route::get('/tambah-wisata', [WisataController::class, 'tambahWisata'])->middleware('auth');
Route::post('/upload_ulasan', [UmkmController::class, 'simpan_ulasan_umkm'])->middleware('auth');

// Auth/Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/home', function () {
    return view('home.home');
})->middleware('auth');


Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'forgotPassword']);
