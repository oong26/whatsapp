<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BidanExport;
use App\Users;
use App\Level;

class UserController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            $data = Users::join('level','tb_user.level', 'level.id_level')->get();
            
            return view('users.index')->with('app_title', 'WhatsApp API')->with('title', 'Lihat akun')->with('data',$data);
        }
        else{
            return redirect('login');
        }   
    }

    public function add()
    {
        if(Session::get('user_id') != null){
            $level = Level::all();
            return view('users.add')->with('app_title', 'WhatsApp API')->with('title', 'Tambah akun')->with('level', $level);
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
                    'password' => $req->password
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
            $level = Level::all();
    
            return view('users.edit')->with('app_title', 'WhatsApp API')->with('title', 'Edit akun')->with('data', $data)->with('level', $level);
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
                'username' => 'required|min:3|max:30',
                'level' => 'required',
                'status' => 'required'
            ]);
    
            try{
                DB::table('tb_user')->where('id',$req->id)->update([
                    'nama' => $req->nama,
                    'email' => $req->email,
                    'alamat' => $req->alamat,
                    'level' => $req->level, 
                    'username' => $req->username,
                    'updated_at' => now()
                ]);

                if($req->password != null){
                    DB::table('tb_user')->where('id',$req->id)->update([
                        'password' => $req->password,
                        'updated_at' => now()
                    ]);
                }

                if($req->status != null){
                    DB::table('tb_user')->where('id',$req->id)->update([
                        'status' => $req->status,
                        'updated_at' => now()
                    ]);
                }
                
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

    public function export()
    {
        if(Session::get('user_id') != null){
            // return Excel::download(new PasienExport,'pasien.xlsx');
            $data = Users::select('nama','phone','level')->where('level','!=',1)->get();

            return Excel::download(new BidanExport($data),'bidan.xlsx');
        }
        else{
            return redirect('login');
        }
    }
}
