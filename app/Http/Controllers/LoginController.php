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
            return view('login')->with('title', 'Tape Labu - Login');
        }
    }

    public function login(Request $req)
    {
        $this->validate($req,[
            'username' => 'required|min:3|max:30',
            'password' => 'required|min:4'
        ]);
            
        $username = $req->username;
        $password = $req->password;

        $data = Users::join('level', 'tb_user.level', 'level.id_level')->where('username', $username)->first();
        
        if(!empty($data)){
            if($data->status == 1){
                if($password == $data->password){
                    Session::put('user_id', $data->id);
                    Session::put('nama', $data->nama);
                    Session::put('email', $data->email);
                    Session::put('level', $data->level);
                    Session::put('nama_level', $data->nama_level);
                    
                    alert()->success('Sukses', 'Berhasil login');
                    return redirect('/');
                }
                else{
                    alert()->warning('Gagal', 'Password salah');
                    return view('login')->with('title', 'Tape Labu - Login');
                }
            }
            else{
                alert()->warning('Gagal', 'Akun telah di nonaktifkan. Harap hubungi admin');
                return view('login')->with('title', 'Tape Labu - Login');
            }
        }
        else{
            alert()->warning('Gagal', 'Akun tidak ditemukan');
            return view('login')->with('title', 'Tape Labu - Login');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login');
    }
}
