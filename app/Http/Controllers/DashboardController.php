<?php

namespace App\Http\Controllers;

use App\Users;
use App\Pasien;
use App\Chat;
use App\Device;
use GuzzleHttp\Client;
// use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Hash;
// use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
// use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use File;
use Alert;

class DashboardController extends Controller
{
    public function index()
    {
        if(Session::get('user_id') != null){
            $pasien = null;
            $checkUser = Users::join('level', 'tb_user.level', 'level.id_level')
                        ->where([
                            ['level.nama_level', 'not like', '%Admin%'],
                            ['tb_user.id', Session::get('user_id')]
                        ])->get();

            if($checkUser->isEmpty()){
                //jika user adalah super admin atau admin
                $pasien = Pasien::orderBy('id', 'DESC')->get();
            }
            else{
                //jika user adalah bidan
                $pasien = Pasien::where('id_user', Session::get('user_id'))->orderBy('updated_at', 'DESC')->get();
            }
            $users = Users::all();
            $chat = Chat::where([
                    ['terkirim', 1],
                    ['mengirim', 0]
                ])->get();
                
            $chatToday = Chat::where([
                ['waktu', 'like', substr(now(),0,10).'%'],
                ['terkirim', 1],
                ['mengirim', 0]
            ])->get();

            $failedChatToday = Chat::where([
                ['waktu', 'like', substr(now(),0,10).'%'],
                ['mengirim', 1],
                ['terkirim', 0]
            ])->get();

            $bidan = Users::join('level', 'tb_user.level', 'level.id_level')
                            ->where('level.nama_level', 'not like', '%Admin%')
                            ->get();

            $data = array(
                'data_pasien' => $pasien,
                'users' => count($users),
                'pasien' => count($pasien),
                'chat' => count($chat),
                'bidan' => count($bidan),
                'chat_today' => count($chatToday),
                'failed_chat' => count($failedChatToday)
            );

            return view('index')->with('app_title', 'Tape Labu')->with('title', 'Dashboard')->with('data', $data);
        }
        else{
            return redirect('login');
        }
    }

    public function chat(){
        if(Session::get('user_id') != null){
            $data = Chat::orderBy('id_chat', 'DESC')->get();
            
            return view('chat')->with('app_title', 'Tape Labu')->with('title', 'Chat')->with('data', $data);
        }
        else{
            return redirect('login');
        }
    }
    
    public function chatDetail($id){
        // if(Session::get('user_id') != null){
            $data = Chat::where('id_chat', $id)->get()[0];
            $data->waktu = date('d-F-Y H:i:s', strtotime($data->waktu));
            return json_encode($data);
        // }
        // else{
            // return redirect('login');
        // }
    }

    public function msg()
    {
        return view('msg')->with('title','Pesan');
    }

    public function sendMsg(/*Request $req*/)
    {
        $pasien = Pasien::all();
		// return $req->id_device;
		$client = new Client();
        
        for($i=0;$i<count($pasien);$i++){
                $no = $pasien[$i]['phone'];
                $nama = $pasien[$i]['nama'];
                $pesan = 'Hallo '.$nama.'! '.$pasien[$i]['resep'];
                // $pesan = 'Kami dari tim Puskesmas Binakal hanya melakukan uji coba aplikasi dari Puskesmas Binakal';
                
                //Dinamis
                $r = $client->request('POST', 'http://37.44.244.54:8000/waapi/sendText', [
                        'form_params' => [
                        'to' => $no,
                        'pesan' => $pesan
                    ]
                ]);

                //Statik
                // $r = $client->request('POST', 'http://37.44.244.54:8000/waapi/sendText', [
                //         'form_params' => [
                //         'id_device' => '11',
                //         'to' => $no,
                //         'pesan' => $pesan
                //     ]
                // ]);
        }
        return view('msg')->with('title', 'Artikel')->with('text', 'Pesan sudah terkirim. Silahkan tutup halaman ini.');
		
    }

    public function sendBidanMsg()
    {
        $client = new Client();
        
        $pasien = Pasien::select('pasien.nama','pasien.id_user','pasien.tgl_hpl','tb_user.nama as bidan','tb_user.phone')
                            ->join('tb_user','tb_user.id','pasien.id_user')
                            ->get();
        $phone = null;
         
        for ($i=0; $i < count($pasien) ; $i++) { 
            $hpl = substr($pasien[$i]['tgl_hpl'], 0,10);
            $phone = $pasien[$i]['phone'];
            $pesan = 'Hallo bidan '.$pasien[$i]['bidan'].'. Pasien anda yang bernama '.$pasien[$i]['nama'].' akan melakukan persalinan 10 hari lagi.';
            if($hpl == substr(now(),0,10)){
                $r = $client->request('POST', 'http://37.44.244.54:8000/waapi/sendText', [
                        'form_params' => [
                        'to' => $phone,
                        'pesan' => $pesan
                    ]
                ]);
            }
        }

        return view('msg')->with('title', 'Artikel')->with('text', 'Notifikasi sudah terkirim kepada bidan. Silahkan tutup halaman ini.');   
    }

    public function artikel()
    {
        return view('artikel')->with('title', 'Artikel')->with('text', 'Pesan sudah terkirim. Silahkan tutup halaman ini.');
    }

    public function sendArtikel(\Illuminate\Http\Request $req)
    {
        $this->validate($req,[
            'file' => 'required'
        ]);

        $artikel = $req->file('file');
        $upload_path = 'file_artikel';
        $pesan = "";
        if($req->get('pesan') != ""){
            $pesan = $req->get('pesan');
        }
        // return $pesan;

        if($artikel != null){
            $artikel->move($upload_path, $artikel->getClientOriginalName());
            $file_url = url('file_artikel/'.$artikel->getClientOriginalName());
            
            $pasien = Pasien::all();
            // return $req->id_device;
            $client = new Client();
            
            for($i=0;$i<count($pasien);$i++){
                $no = $pasien[$i]['phone'];
                $nama = $pasien[$i]['nama'];
                    
                //Dinamis
                $r = $client->request('POST', 'http://37.44.244.54:8000/sendFile', [
                    'form_params' => [
                        'to' => $no,
                        'pesan' => $pesan,
                        'fileurl' => $file_url,
                        'filename' => $artikel->getClientOriginalName()
                    ]
                ]);

            }
                
            alert()->warning('Gagal', 'Artikel belum dipilih');
            return redirect()->back();
        }
        else{
            alert()->warning('Gagal', 'Artikel belum dipilih');
            return redirect()->back();
        }
    }

}
