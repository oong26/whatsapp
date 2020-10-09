<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Users;

class UserController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            $data = Users::all();
            
            return view('users.index')->with('app_title', 'WhatsApp API')->with('title', 'Lihat akun')->with('data',$data);
        }
        else{
            return redirect('login');
        }   
    }

    public function add()
    {
        if(Session::get('user_id') != null){
            return view('users.add')->with('app_title', 'WhatsApp API')->with('title', 'Tambah akun');
        }
        else{
            return redirect('login');
        }   
    }

    public function store(Request $req)
    {
        if(Session::get('user_id') != null){
            $this->validate($req,[  
                'nama' => 'required|min:3|max:50',
                'email' => 'required',
                'alamat' => 'required',
                'username' => 'required|min:3|max:30',
                'password' => 'required|min:3',
                'level' => 'required',
            ]);
            
            try{
                DB::table('tb_user')->insert([
                    'nama' => $req->nama,
                    'email' => $req->email,
                    'status' => 1,
                    'alamat' => $req->alamat,
                    'level' => $req->level, 
                    'username' => $req->username,
                    'password' => Hash::make($req->password)
                ]);
    
                alert()->success('Sukses', 'Berhasil menyimpan data');
                return redirect('akun');
            }
            catch(\Illuminate\Database\QueryException $e){
                alert()->error('Error', 'Gagal');
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id)
    {
        if(Session::get('user_id') != null){
            try{
                DB::table('tb_user')->where('id', $id)->delete();
                
                alert()->success('Sukses', 'Berhasil menghapus data');
                return redirect('akun');
            }
            catch(\Illuminate\Database\QueryException $e){
                alert()->error('Error', 'Gagal');
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        }   
    }

    public function edit($id)
    {
        if(Session::get('user_id') != null){
            $data = Users::where('id',$id)->get();
    
            return view('users.edit')->with('app_title', 'WhatsApp API')->with('title', 'Edit akun')->with('data', $data);
        }
        else{
            return redirect('login');
        }
    }

    public function update(Request $req)
    {
        if(Session::get('user_id') != null){
            $this->validate($req,[  
                'nama' => 'required|min:3|max:50',
                'email' => 'required',
                'alamat' => 'required',
                'username' => 'required|min:3|max:30',
                'password' => 'required|min:3',
                'level' => 'required',
                'status' => 'required'
            ]);
    
            try{
                DB::table('tb_user')->where('id',$req->id)->update([
                    'nama' => $req->nama,
                    'email' => $req->email,
                    'status' => 1,
                    'alamat' => $req->alamat,
                    'level' => $req->level, 
                    'username' => $req->username,
                    'password' => Hash::make($req->password)
                ]);
                
                alert()->success('Sukses', 'Berhasil memperbarui data');
                return redirect('akun');
            }
            catch(\Illuminate\Database\QueryException $e){
                alert()->error('Error', $e->getMessage());
                return redirect()->back();
            }
        }
        else{
            return redirect('login');
        }   
    }
}
