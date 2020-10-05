<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Users;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $data = Users::where('id', $id)->get();
        
        return view('profile.index')->with('app_title', 'WhatsApp API')->with('title', 'Lihat akun')->with('data', $data);
    }

    public function update(Request $req)
    {
        $this->validate($req, [
            'nama' => 'required|min:3|max:50'
        ]);

        try{
            $id = Session::get('user_id');
            
            if($id != null){
                DB::table('tb_user')->where('id', $id)->update([
                    'nama' => $req->nama,
                    'alamat' => $req->alamat,
                    'updated_at' => now()
                ]);

                session()->put('nama', $req->nama);
            }
            else{
                alert()->error('Error', 'Gagal');
                return redirect('/');
            }
            
            alert()->success('Sukses', 'Berhasil memperbarui profil');
            return redirect('dashboard');
        }
        catch(\Illuminate\Database\QueryException $e){
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }
    }
}
