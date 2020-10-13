<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PasienExport;
use App\Pasien;
use App\Bidan;

class PasienController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            $data = Pasien::orderBy('updated_at', 'DESC')->get();
            
            return view('pasien.index')->with('app_title', 'WhatsApp API')->with('title','Lihat Pasien')->with('data', $data);
        }
        else{
            return redirect('login');
        }        
    }

    public function add()
    {
        if(Session::get('user_id') != null){
            $bidan = Bidan::all();
            
            return view('pasien.add')->with('app_title', 'WhatsApp API')->with('title','Tambah Pasien')->with('bidan', $bidan);
        }
        else{
            return redirect('login');
        }        
    }

    public function store(Request $req)
    {
        if(Session::get('user_id') != null){
            $this->validate($req,[
                        'nik' => 'required|min:16|max:16|unique:pasien',
                        'nama' => 'required|min:3|max:50',
                        'alamat' => 'required',
                        'phone' => 'required',
                        'resep' => 'required',
                        'bidan' => 'required'
            ]);

            try{
                $phoneIsExists = Pasien::where('phone', '62'.$req->phone)->first();
                if($phoneIsExists){
                    // Nomor telah digunakan
                    alert()->error('Error', 'Nomor telah digunakan');
                    return redirect()->back();
                }
                else{
                    //Nomor tersedia
                    DB::table('pasien')->insert([
                        'nik' => $req->nik,
                        'nama' => $req->nama,
                        'alamat' => $req->alamat,
                        'phone' => '62'.$req->phone,
                        'resep' => $req->resep,
                        'tgl_hpht' => $req->tgl,
                        'id_bidan' => Session::get('user_id')
                    ]);
                    
                    alert()->success('Sukses', 'Berhasil menyimpan data');
                    return redirect('pasien');
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
                'status' => 'required',
                'bidan' => 'required'
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

                if($req->bidan != null){
                    DB::table('pasien')->where('id',$req->id)->update([
                        'id_bidan' => $req->bidan,
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

    public function export()
    {
        if(Session::get('user_id') != null){
            // return Excel::download(new PasienExport,'pasien.xlsx');
            $data = Pasien::select('nama','phone')->get();

            return Excel::download(new PasienExport($data),'pasien.xlsx');
        }
        else{
            return redirect('login');
        }
    }
}
