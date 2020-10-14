<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Waktu;

class WaktuController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            $data = Waktu::all();
            
            return view('waktu.index')->with('app_title', 'Tape Labu')->with('title', 'Lihat waktu')->with('data',$data);
        }
        else{
            return redirect('login');
        }
    }

    public function add()
    {
        if(Session::get('user_id') != null){
            return view('waktu.add')->with('app_title', 'Tape Labu')->with('title', 'Tambah waktu');
        }
        else{
            return redirect('login');
        }
    }

    public function store(Request $req)
    {
        if(Session::get('user_id') != null){
            try {
                $this->validate($req,[
                    'judul' => 'required|max:30',
                    'jam' => 'required'
                ]);
    
                DB::table('waktu')->insert([
                    'judul' => $req->judul,
                    'jam' => $req->jam,
                    'is_active' => 0
                ]);
    
                alert()->success('Sukses', 'Berhasil menyimpan data');
                return redirect('waktu');
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

    public function updateActive($id,$value)
    {
        if(Session::get('user_id') != null){
            if($id != null){
                try{
                   if($value == 1){
                        DB::table('waktu')->where('id', $id)->update([
                            'is_active' => 1
                        ]);

                        DB::table('waktu')->where('id', '!=', $id)->update([
                            'is_active' => 0
                        ]);
            
                        alert()->success('Sukses', 'Waktu berhasil diaktifkan');
                        return redirect('waktu');
                   }
                   else{
                        DB::table('waktu')->where('id', $id)->update([
                            'is_active' => 0
                        ]);
            
                        alert()->success('Sukses', 'Waktu berhasil dinonaktifkan');
                        return redirect('waktu');
                   }
                }
                catch(\Illuminate\Database\QueryException $e){
                    alert()->error('Error', 'Gagal');
                    return redirect()->back();
                }
            }
        }
        else{
            return redirect('login');
        }
    }

    public function edit($id)
    {
        if(Session::get('user_id') != null){
            try{
                if($id != null){
                    $data = Waktu::where('id', $id)->get();

                    return view('waktu.edit')->with('title', 'Edit waktu')->with('data', $data);
                }
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

    public function update(Request $req)
    {
        if(Session::get('user_id') != null){
            try{
                $this->validate($req,[
                    'id' => 'required',
                    'judul' => 'required|max:30',
                    'jam' => 'required',
                    'status' => 'required'
                ]);

                DB::table('waktu')->where('id', $req->id)->update([
                    'judul' => $req->judul,
                    'jam' => $req->jam,
                    'is_active' => $req->status
                ]);

                alert()->success('Sukses', 'Berhasil memperbarui data');
                return redirect('waktu');
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
                if($id != null){
                    DB::table('waktu')->where('id', $id)->delete();

                    alert()->success('Sukses', 'Berhasil menghapus data');
                    return redirect('waktu');
                }
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
}
