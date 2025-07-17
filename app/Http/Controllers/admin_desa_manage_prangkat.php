<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
class admin_desa_manage_prangkat extends Controller
{
    //
    public function index($id)
{ $users = DB::table('users')->where('id_desa', $id)->get();

    return view('admin_desa.prangkat_desa', compact('users'));
}
   public function v_edit($id){
          
        
              $user = DB::table('users')
            ->where('id_user', $id)
            ->first();
            
            
   return view('admin_desa.v_edit_perangkat',compact('user'));
    }
    public function edit(Request $request,$id){
     $user = User::where('id_user', $id)->firstOrFail();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
        'nik' => 'required|string|max:255',
      
        'no_hp' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:255',
           'tgl_pelantikan' => 'required|date',
    
        'status_verifikasi' => 'nullable|in:menunggu,diterima,ditolak',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->nik = $request->nik;
    $user->tgl_pelatikan = $request->tgl_pelantikan;
    $user->kode_pos = $request->kode_pos;
    $user->no_hp = $request->no_hp;
    $user->alamat = $request->alamat;

  

   
    $user->save();

    return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
    }
public function tambah($id){

  
 return view('admin_desa.tambah_user',compact('id'));
}
public function proses_tambah(Request $request){
 $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'nik' => 'required|string|max:255',
        'tgl_pelantikan' => 'required|date',
        'kode_pos' => 'nullable|string|max:10',
        'no_hp' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:255',
        'role' => 'required|integer',
      
    ]);

    $user = new User();
    $user->id_user=  'DSA' . now()->format('YmdHis') . rand(1000, 9999);
 
 $user->id_desa=$request->id_desa;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->nik = $request->nik;
    $user->tgl_pelatikan = $request->tgl_pelantikan;
    $user->kode_pos = $request->kode_pos;
    $user->no_hp = $request->no_hp;
    $user->alamat = $request->alamat;
    $user->role = $request->role;
    
    $user->save();

    return redirect()->back()->with('success', 'Data user berhasil ditambahkan.');
}
public function destroy($id_user)
{
    $user = User::findOrFail($id_user);
    $user->delete();

    return redirect()->back()->with('success', 'User berhasil dihapus.');
}


}
