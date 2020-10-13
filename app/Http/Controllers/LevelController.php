<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Level;

class LevelController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            $data = Level::all();
            
            return view('level.index')->with('app_title', 'WhatsApp API')->with('title','Lihat Wewenang')->with('data', $data);
        }
        else{
            return redirect('login');
        }        
    }

    public function add()
    {
        if(Session::get('user_id') != null){
            return view('level.add')->with('app_title', 'WhatsApp API')->with('title','Tambah Wewenang');
        }
        else{
            return redirect('login');
        }        
    }

    public function store(Request $req)
    {
        if(Session::get('user_id') != null){
            $this->validate($req,[
                'wewenang' => 'required|min:3|max:50'
            ]);

            try{
                if($req->wilayah == null){
                    DB::table('level')->insert([
                        'nama_level' => $req->wewenang
                    ]);
                }
                else{
                    DB::table('level')->insert([
                        'nama_level' => $req->wewenang,
                        'wilayah' => $req->wilayah
                    ]);
                }
                
                alert()->success('Sukses', 'Berhasil menyimpan data');
                return redirect('wewenang');
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
            $data = Level::where('id_level', $id)->get();
            
            return view('level.edit')->with('app_title', 'WhatsApp API')->with('title', 'Edit Wewenang')->with('data', $data);
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id)
    {
        if(Session::get('user_id') != null){
            try{
                DB::table('level')->where('id_level', $id)->delete();
                
                alert()->success('Sukses', 'Berhasil menghapus data');
                return redirect('wewenang');
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
            $this->validate($req,[
                'id' => 'required',
                'wewenang' => 'required|min:3|max:50'
            ]);

            try{
                if($req->wilayah == null){
                    DB::table('level')->where('id_level',$req->id)->update([
                        'nama_level' => $req->wewenang
                    ]);
                }
                else{
                    DB::table('level')->where('id_level',$req->id)->update([
                        'nama_level' => $req->wewenang,
                        'wilayah' => $req->wilayah
                    ]);
                }
                
                alert()->success('Sukses', 'Berhasil memperbarui data');
                return redirect('wewenang');
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
