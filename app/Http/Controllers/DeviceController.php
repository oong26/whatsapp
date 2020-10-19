<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Device;

class DeviceController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            $data = Device::all();
            
            return view('device.index')->with('app_title', 'Tape Labu')->with('title','Lihat Perangkat')->with('data', $data);
        }
        else{
            return redirect('login');
        }        
    }

    public function add()
    {
        if(Session::get('user_id') != null){
            return view('device.add')->with('app_title', 'Tape Labu')->with('title','Tambah Perangkat');
        }
        else{
            return redirect('login');
        }        
    }

    public function store(Request $req)
    {
        if(Session::get('user_id') != null){
            $this->validate($req,[
                'device' => 'required'
            ]);

            try{
                DB::table('device')->insert([
                    'nama_device' => '62'.$req->device,
                    'status' => 'unpaired',
                    'id_user' => Session::get('user_id'),
                    'hide' => 0
                ]);
                
                alert()->success('Sukses', 'Berhasil menyimpan data');
                return redirect('perangkat');
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
            $data = Device::where('id', $id)->get();
            
            return view('device.edit')->with('app_title', 'Tape Labu')->with('title', 'Edit Perangkat')->with('data', $data);
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id)
    {
        if(Session::get('user_id') != null){
            try{
                DB::table('device')->where('id', $id)->delete();
                
                alert()->success('Sukses', 'Berhasil menghapus data');
                return redirect('perangkat');
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
                'device' => 'required'
            ]);

            try{
                DB::table('device')->where('id',$req->id)->update([
                    'nama_device' => '62'.$req->device
                ]);
                
                alert()->success('Sukses', 'Berhasil memperbarui data');
                return redirect('perangkat');
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
