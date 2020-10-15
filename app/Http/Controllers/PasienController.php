<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PasienExport;
use App\Pasien;
use App\Users;
use App\Level;
use App\Desa;

class PasienController extends Controller
{
    public function index()
    {        
        if(Session::get('user_id') != null){
            $data = null;
            $desa = Desa::all();
            $user = Users::join('level', 'tb_user.level', 'level.id_level')
                        ->where([
                            ['level.nama_level', 'not like', '%Admin%'],
                            ['tb_user.id', Session::get('user_id')]
                        ])->get();
            
            $bidan = Users::join('level', 'tb_user.level', 'level.id_level')
                        ->where('level.nama_level', 'not like', '%Admin%')
                        ->get();                


            if($user->isEmpty()){
                //jika user adalah super admin atau admin
                $data = Pasien::orderBy('updated_at', 'DESC')->get();
            }
            else{
                //jika user adalah bidan
                $data = Pasien::where('id_user', Session::get('user_id'))->orderBy('updated_at', 'DESC')->get();
            }
            
            return view('pasien.index')->with('app_title', 'Tape Labu')->with('title','Lihat Pasien')->with('data', $data)->with('bidan',$bidan)->with('desa',$desa)->with('pilih_desa','')->with('pilih_bidan','');
        }
        else{
            return redirect('login');
        }        
    }

    public function add()
    {
        if(Session::get('user_id') != null){
            $bidan = Users::join('level', 'tb_user.level', 'level.id_level')
                            ->where('level.nama_level', 'not like', '%Admin%')
                            ->get();
            
            $desa = Level::groupBy('wilayah')->get();
            
            return view('pasien.add')->with('app_title', 'WhatsApp API')->with('title','Tambah Pasien')->with('bidan', $bidan)->with('desa', $desa);
        }
        else{
            return redirect('login');
        }        
    }

    public function store(Request $req)
    {
        if(Session::get('user_id') != null){
            $this->validate($req,[
                        'phone' => 'required'
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
                    $bidans = Users::join('level', 'tb_user.level', 'level.id_level')
                            ->where([
                                ['level.nama_level', 'not like', '%Admin%'],
                                ['tb_user.id', Session::get('user_id')]
                            ])->get();
                    if($bidans->isEmpty()){
                        //jika user adalah super admin atau admin
                        $this->validate($req,[
                            'nik' => 'required|min:16|max:16|unique:pasien',
                            'kis' => 'required|unique:pasien',
                            'nama' => 'required|min:3|max:50',
                            'alamat' => 'required',
                            'phone' => 'required',
                            'resep' => 'required',
                            'bidan' => 'required'
                        ]);
                        
                        DB::table('pasien')->insert([
                            'nik' => $req->nik,
                            'kis' => $req->kis,
                            'nama' => $req->nama,
                            'alamat' => $req->alamat,
                            'phone' => '62'.$req->phone,
                            'resep' => $req->resep,
                            'tgl_hpht' => $req->tgl,
                            'id_user' => $req->bidan,
                            'tgl_hpl' => $this->countHPL($req->tgl)
                        ]);
                    }
                    else{
                        //jika user adalah bidan
                        $this->validate($req,[
                            'nik' => 'required|min:16|max:16|unique:pasien',
                            'kis' => 'required|unique:pasien',
                            'nama' => 'required|min:3|max:50',
                            'alamat' => 'required',
                            'phone' => 'required',
                            'resep' => 'required'
                        ]);

                        DB::table('pasien')->insert([
                            'nik' => $req->nik,
                            'kis' => $req->kis,
                            'nama' => $req->nama,
                            'alamat' => $req->alamat,
                            'phone' => '62'.$req->phone,
                            'resep' => $req->resep,
                            'tgl_hpht' => $req->tgl,
                            'id_user' => Session::get('user_id'),
                            'tgl_hpl' => $this->countHPL($req->tgl)
                        ]);
                    }
                    
                    alert()->success('Sukses', 'Berhasil menyimpan data');
                    return redirect('pasien');
                }
            }
            catch(\Illuminate\Database\QueryException $e){
                // alert()->error('Error', 'Gagal');
                alert()->error('Error', $e->getMessage());
                return redirect()->back();
                $bidan = Users::join('level', 'tb_user.level', 'level.id_level')
                            ->where('level.nama_level', 'not like', '%Admin%')
                            ->get();
            
                return view('pasien.add')->with('app_title', 'WhatsApp API')->with('title','Tambah Pasien')->with('bidan', $bidan);
            }
        }
        else{
            return redirect('login');
        }        

    }

    public function countHPL($hpht)
    {
        $hpht = [
            'date' => substr($hpht,0,10),
            'tgl' => substr($hpht,8,2),
            'bulan' => substr($hpht,5,2),
            'tahun' => substr($hpht,2,2),
        ];
        // $tgl_hpl = $hpht['tgl'] + 7;
        $tgl_hpl = $hpht['tgl'];
        $bln_hpl = $hpht['bulan'] - 3;
        $thn_hpl = $hpht['tahun'];
        if($bln_hpl != 0){
            $thn_hpl = $thn_hpl + 1;
        }
        else{
            $bln_hpl = 12;
        }

        $hpl = [
            'hpht' => $hpht['date'],
            'tgl' => $tgl_hpl,
            'bln' => $bln_hpl,
            'thn' => '20'.$thn_hpl,
            'hpl' => '20'.$thn_hpl.'-'.$bln_hpl.'-'.$tgl_hpl
        ];
        
        return $hpl['hpl'];
    }

    public function edit($id)
    {
        if(Session::get('user_id') != null){
            $data = Pasien::where('id', $id)->get();
            $bidan = Users::join('level', 'tb_user.level', 'level.id_level')
                            ->where('level.nama_level', 'not like', '%Admin%')
                            ->get();
            
            return view('pasien.edit')->with('app_title', 'WhatsApp API')->with('title', 'Edit pasien')->with('data', $data)->with('bidan', $bidan);
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
            try{
                $this->validate($req,[
                    'id' => 'required',
                    'nik' => 'required|min:16|max:16',
                    'kis' => 'required|unique:pasien',
                    'nama' => 'required|min:3|max:50',
                    'alamat' => 'required',
                    'phone' => 'required',
                    'resep' => 'required',
                    'status' => 'required'
                ]);

                $bidans = Users::join('level', 'tb_user.level', 'level.id_level')
                            ->where([
                                ['level.nama_level', 'not like', '%Admin%'],
                                ['tb_user.id', Session::get('user_id')]
                            ])->get();

                if($bidans->isEmpty()){
                    //jika user adalah super admin atau admin

                    if($req->bidan != null){
                        DB::table('pasien')->where('id',$req->id)->update([
                            'id_user' => $req->bidan,
                            'updated_at' => now()
                        ]);
                    }
                }

                if($req->tgl != null){
                    DB::table('pasien')->where('id',$req->id)->update([
                        'nik' => $req->nik,
                        'kis' => $req->kis,
                        'nama' => $req->nama,
                        'alamat' => $req->alamat,
                        'phone' => '62'.$req->phone,
                        'resep' => $req->resep,
                        'tgl_hpht' => $req->tgl,
                        'tgl_hpl' => $this->countHPL($req->tgl),
                        'updated_at' => now()
                    ]);
                }
                else{
                    DB::table('pasien')->where('id',$req->id)->update([
                        'nik' => $req->nik,
                        'kis' => $req->kis,
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

    public function getPasienBy($desa,$id)
    {
        if(Session::get('user_id') != null){
            $data_desa = Desa::all();
            $bidan = Users::join('level', 'tb_user.level', 'level.id_level')
                        ->where('level.nama_level', 'not like', '%Admin%')
                        ->get();           

            $data = Pasien::select('pasien.*','tb_user.id','level.id_level','level.wilayah')
                            ->join('tb_user','tb_user.id','pasien.id_user')
                            ->join('level','level.id_level','tb_user.level')
                            ->where([
                                ['level.wilayah', 'like', '%'.$desa.'%'],
                                ['pasien.id_user', '=', $id]
                            ])
                            ->get();
            // return $data;
            return view('pasien.index')->with('app_title', 'Tape Labu')->with('title','Lihat Pasien')->with('data', $data)->with('bidan',$bidan)->with('desa', $data_desa)->with('pilih_desa',$desa)->with('pilih_bidan',$id);
        }
        else{
            return redirect('login');
        }
    }

    public function getPasienByDesa($desa)
    {
        if(Session::get('user_id') != null){
            $data_desa = Desa::all();
            $bidan = Users::join('level', 'tb_user.level', 'level.id_level')
                        ->where('level.nama_level', 'not like', '%Admin%')
                        ->get();           

            $data = Pasien::select('pasien.*','tb_user.id','level.id_level','level.wilayah')
                            ->join('tb_user','tb_user.id','pasien.id_user')
                            ->join('level','level.id_level','tb_user.level')
                            ->where('level.wilayah', 'like', '%'.$desa.'%')
                            ->get();
            // return $data;
            return view('pasien.index')->with('app_title', 'Tape Labu')->with('title','Lihat Pasien')->with('data', $data)->with('bidan',$bidan)->with('desa', $data_desa)->with('pilih_desa',$desa)->with('pilih_bidan','');
        }
        else{
            return redirect('login');
        }
    }

    public function getPasienByBidan($id)
    {
        if(Session::get('user_id') != null){
            $data_desa = Desa::all();
            $bidan = Users::join('level', 'tb_user.level', 'level.id_level')
                        ->where('level.nama_level', 'not like', '%Admin%')
                        ->get();           

            $data = Pasien::select('pasien.*','tb_user.id')
                            ->join('tb_user','tb_user.id','pasien.id_user')
                            ->where('pasien.id_user', '=', $id)
                            ->get();
            // return $data;
            return view('pasien.index')->with('app_title', 'Tape Labu')->with('title','Lihat Pasien')->with('data', $data)->with('bidan',$bidan)->with('desa', $data_desa)->with('pilih_desa','')->with('pilih_bidan',$id);
        }
        else{
            return redirect('login');
        }
    }
}
