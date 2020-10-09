<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Users;
use App\Pasien;
use Alert;

class LoginController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            return redirect('/');
        }
        else{
            return view('login')->with('title', 'Login');
        }
    }

    public function login(Request $req)
    {
        $this->validate($req,[
            'username' => 'required|min:4|max:30',
            'password' => 'required|min:4'
        ]);
            
        $username = $req->username;
        $passwod = $req->password;

        $data = Users::where('username', $username)->first();
        
        if($data){
            // if(Hash::check($passwod, $data->password)){
            //     Session::put('user_id', $data->id);
            //     Session::put('nama', $data->nama);
            //     Session::put('email', $data->email);
            //     Session::put('level', $data->level);
                
            //     alert()->success('Sukses', 'Berhasil login');
            //     return redirect('dashboard');
            // }
            if($passwod == $data->password){
                Session::put('user_id', $data->id);
                Session::put('nama', $data->nama);
                Session::put('email', $data->email);
                Session::put('level', $data->level);
                
                alert()->success('Sukses', 'Berhasil login');
                return redirect('dashboard');
            }
            else{
                alert()->warning('Gagal', 'Password salah');
                return back();
            }
        }
        else{
            alert()->warning('Gagal', 'Akun tidak ditemukan');
            return back();
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login');
    }
}
