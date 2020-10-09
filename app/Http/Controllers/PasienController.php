<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Pasien;

class PasienController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            $data = Pasien::all();
            
            return view('pasien.index')->with('app_title', 'WhatsApp API')->with('title','Lihat Pasien')->with('data', $data);
        }
        else{
            return redirect('login');
        }        
    }

    public function add()
    {
        if(Session::get('user_id') != null){
            return view('pasien.add')->with('app_title', 'WhatsApp API')->with('title','Tambah Pasien');
        }
        else{
            return redirect('login');
        }        
    }

    public function store(Request $req)
    {
        if(Session::get('user_id') != null){
            $this->validate($req,[
                        'nik' => 'required|min:16|max:16',
                        'nama' => 'required|min:3|max:50',
                        'alamat' => 'required',
                        'phone' => 'required',
                        'resep' => 'required'
            ]);

            try{
                DB::table('pasien')->insert([
                    'nik' => $req->nik,
                    'nama' => $req->nama,
                    'alamat' => $req->alamat,
                    'phone' => '62'.$req->phone,
                    'resep' => $req->resep,
                    'tgl_hpht' => $req->tgl
                ]);
                
                alert()->success('Sukses', 'Berhasil menyimpan data');
                return redirect('pasien');
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
            $data = Pasien::where('id', $id)->get();
            
            return view('pasien.edit')->with('app_title', 'WhatsApp API')->with('title', 'Edit pasien')->with('data', $data);
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id)
    {
        if(Session::get('user_id') != null){
            try{
                DB::table('pasien')->where('id', $id)->delete();
                
                alert()->success('Sukses', 'Berhasil menghapus data');
                return redirect('pasien');
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
                'nik' => 'required|min:16|max:16',
                'nama' => 'required|min:3|max:50',
                'alamat' => 'required',
                'phone' => 'required',
                'resep' => 'required',
                'status' => 'required'
            ]);

            try{
                if($req->tgl != null){
                    DB::table('pasien')->where('id',$req->id)->update([
                        'nik' => $req->nik,
                        'nama' => $req->nama,
                        'alamat' => $req->alamat,
                        'phone' => '62'.$req->phone,
                        'resep' => $req->resep,
                        'tgl_hpht' => $req->tgl,
                        'updated_at' => now()
                    ]);
                }
                else{
                    DB::table('pasien')->where('id',$req->id)->update([
                        'nik' => $req->nik,
                        'nama' => $req->nama,
                        'alamat' => $req->alamat,
                        'phone' => '62'.$req->phone,
                        'resep' => $req->resep,
                        'updated_at' => now()
                    ]);
                }
    
                if($req->status != null){
                    DB::table('pasien')->where('id',$req->id)->update([
                        'status' => $req->status,
                        'updated_at' => now()
                    ]);
                }
                
                alert()->success('Sukses', 'Berhasil memperbarui data data');
                return redirect('pasien');
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
