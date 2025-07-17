<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login() {
        return view('login.login');
    }

    public function forgotPassword() {
        return view('login.forgotpass');
    }


    public function register() {
        return view('login.register');
    }

    public function registerAlt() {
        return view('login.register1');
    }

    public function resetPassword() {
        return view('login.repassword');
    }

    public function requestAccepted() {
        return view('login.reqaccepted');
    }

    public function resetSuccess() {
        return view('login.rpasssuccess');
    }

    public function verify() {
        return view('login.verif');
    }

    public function profil($id) {
         $user = User::where('id_user', $id)->firstOrFail();
    return view('Login.profil', compact('user'));

    }
    public function proses_update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'no_hp' => 'nullable|string|max:20',

        'alamat' => 'nullable|string|max:255',
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->no_hp = $request->no_hp;

    $user->alamat = $request->alamat;
    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}

    public function register_role(Request $request)
{
    $jenis = $request->query('jenis_pendaftaran'); // menangkap query string

    // Contoh pakai untuk logika
    if ($jenis === 'masyarakat') {
        return redirect('/register-alt');

        // lakukan sesuatu untuk masyarakat
    } elseif ($jenis === 'desa') {
        // lakukan sesuatu untuk desa
         return redirect('/register_desa');
    }

    // Kirim ke view (jika ada)
    return view('role.index', compact('jenis'));
}
public function v_regis_desa(){
      return view('login.regis_desa');
}
   public function daftar_masyarakat(Request $request)
{
     $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
             'alamat' => 'required',
            'phone' => 'required|digits_between:10,15',
            'password' => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ]);



    // Simpan ke tabel users
    User::create([
        'id_user' => 'MSY' . now()->format('YmdHis') . rand(1000, 9999),
        'name' => $validated['nama'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'alamat' => $validated['alamat'],
        'password' => Hash::make($validated['password']),
        'role' => 1,
    ]);

   Alert::success('Berhasil', 'Pendaftaran berhasil!');
      return redirect('/');

}
  public function regis_desa(Request $request)

    {


              $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string',
            'desa' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'sk_pengangkatan' => 'required|string',
            'tanggal_pelantikan' => 'required|date',
            'kode_pos'=>'required',
            'file_sk' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // Upload file SK dengan nama unik
        $file = $request->file('file_sk');
        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('sk'), $fileName);

        // Simpan data user (atau buat model terpisah jika perlu)
        $user = User::create([
              'id_user' => 'DSA' . now()->format('YmdHis') . rand(1000, 9999),
            'name' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_hp' => $request->phone,
            'alamat' => $request->alamat,

            'nama_desa' => $request->desa,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'no_sk' => $request->sk_pengangkatan,
            'tgl_pelatikan' => $request->tanggal_pelantikan,
            'sk_pengangkatan' => $fileName,
            'kode_pos'=>$request->kode_pos,
            'password' => Hash::make($request->password),
            'role' => 0, // opsional, jika role digunakan
        ]);
   Alert::success('Berhasil', 'Pendaftaran berhasil!, tunggu konfirmasi lanjut');
      return redirect('/');

    }

 public function proseslogin(Request $request)
    {

        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if ($request->ajax()) {
                return response()->json(['success' => true, 'redirect' => '/home']);
            }
            return redirect('/home');
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'errors' => ['email' => ['Email atau password salah']]
                ], 422);
            }
            Log::info('Login failed with:', $credentials);
            return back()->withErrors(['email' => 'Email atau password salah']);
        }
    }
        public function logout(Request $request)
    {
        Auth::logout(); // Keluarin user yang login

        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect('/login')->with('success', 'Berhasil logout');
    }
    public function prosesForgotPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return back()->with('error', 'Email tidak ditemukan.');
    }

    // Simpan email ke session untuk proses reset berikutnya
    session(['reset_email' => $user->email]);
    return redirect('/repassword');
}

public function prosesResetPassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|same:confirm-password',
        'confirm-password' => 'required|min:6'
    ]);

    $email = session('reset_email');
    if (!$email) {
        return redirect('/forgot-password')->with('error', 'Session reset tidak ditemukan.');
    }

    $user = User::where('email', $email)->first();
    if (!$user) {
        return redirect('/forgot-password')->with('error', 'User tidak ditemukan.');
    }

    $user->password = Hash::make($request->password);
    $user->save();

    session()->forget('reset_email');
    return redirect('/login')->with('success', 'Password berhasil direset. Silakan login.');
}
}
