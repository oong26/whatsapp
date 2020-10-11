<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BidanExport;
use App\Bidan;

class BidanController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            $data = Bidan::all();
            
            return view('bidan.index')->with('app_title', 'WhatsApp API')->with('title','Lihat Bidan')->with('data', $data);
        }
        else{
            return redirect('login');
        }        
    }

    public function add()
    {
        if(Session::get('user_id') != null){
            return view('bidan.add')->with('app_title', 'WhatsApp API')->with('title','Tambah Bidan');
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
                        'alamat' => 'required',
                        'phone' => 'required|unique:bidan'
            ]);

            try{
                $phoneIsExists = Bidan::where('phone', '62'.$req->phone)->first();
                if($phoneIsExists){
                    // Nomor telah digunakan
                    alert()->error('Error', 'Nomor telah digunakan');
                    return redirect()->back();
                }
                else{
                    //Nomor tersedia
                    DB::table('bidan')->insert([
                        'nama' => $req->nama,
                        'alamat' => $req->alamat,
                        'phone' => '62'.$req->phone
                    ]);
                    
                    alert()->success('Sukses', 'Berhasil menyimpan data');
                    return redirect('bidan');
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

    public function edit($id)
    {
        if(Session::get('user_id') != null){
            $data = Bidan::where('id_bidan', $id)->get();
            
            return view('bidan.edit')->with('app_title', 'WhatsApp API')->with('title', 'Edit Bidan')->with('data', $data);
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id)
    {
        if(Session::get('user_id') != null){
            try{
                DB::table('bidan')->where('id_bidan', $id)->delete();
                
                alert()->success('Sukses', 'Berhasil menghapus data');
                return redirect('bidan');
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
                'nama' => 'required|min:3|max:50',
                'alamat' => 'required',
                'phone' => 'required'
            ]);

            try{
                DB::table('bidan')->where('id_bidan',$req->id)->update([
                    'nama' => $req->nama,
                    'alamat' => $req->alamat,
                    'phone' => '62'.$req->phone,
                    'updated_at' => now()
                ]);
                
                alert()->success('Sukses', 'Berhasil memperbarui data data');
                return redirect('bidan');
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
