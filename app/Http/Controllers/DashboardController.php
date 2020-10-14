<?php

namespace App\Http\Controllers;

use App\Users;
use App\Pasien;
use App\Chat;
use App\Device;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
            $chat = Chat::where('status', 'mengirim pesan')->get();
            $chatToday = Chat::where([
                ['time', 'like', substr(now(),0,10).'%'],
                ['status', 'mengirim pesan']
            ])->get();

            $failedChatToday = Chat::where([
                ['time', 'like', substr(now(),0,10).'%'],
                ['status', 'gagal']
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

            return view('index')->with('app_title', 'WhatsApp API')->with('title', 'Dashboard')->with('data', $data);
        }
        else{
            return redirect('login');
        }
    }

    public function msg()
    {
        return view('msg')->with('title','Pesan');
    }

    public function sendMsg(/*Request $req*/)
    {
        $user = Users::get();
        //Chat API
        // for($i=0;$i<sizeof($user);$i++){
        //     $mobile=$user[$i]->phone;
        //     $message=$user[$i]->name.", ".$user[$i]->obat;
        //     $data = [
        //         'phone' => $mobile, // Receivers phone
        //         'body' => $message, // Message
        //     ];
        
        //     $json = json_encode($data); // Encode data to JSON
        //     // URL for request POST /message
        //     $url = 'https://eu54.chat-api.com/instance176181/message?token=vuiodfsprq255oa6';
        //     // Make a POST request
        //     $options = stream_context_create(['http' => [
        //             'method'  => 'POST',
        //             'header'  => 'Content-type: application/json',
        //             'content' => $json
        //         ]
        //     ]);
        //     // Send a request
        //     $result = file_get_contents($url, false, $options);
        // }
        $pasien = Pasien::all();
		// return $req->id_device;
		$client = new Client();
        $device = Device::where('status', 'connected')->get();
        
        if(count($device) == 1){
            for($i=0;$i<count($pasien);$i++){
                $no = $pasien[$i]['phone'];
                $nama = $pasien[$i]['nama'];
                $pesan = $nama.' '.$pasien[$i]['pesan'].'. Dengan resep dibawah ini : \n'.$pasien[$i]['resep']. ' \nPesan diterima setiap jam 19.00.';
                
                //Dinamis
                $r = $client->request('POST', 'http://localhost:8000/waapi/sendText', [
                        'form_params' => [
                        'id_device' => $device[0]['id'],
                        'to' => $no,
                        'pesan' => $pesan
                    ]
                ]);

                //Statik
                // $r = $client->request('POST', 'http://localhost:8000/waapi/sendText', [
                //         'form_params' => [
                //         'id_device' => '11',
                //         'to' => $no,
                //         'pesan' => $pesan
                //     ]
                // ]);
            }
            return redirect('msg');
        }
        else{
            return 'Silahkan hubungkan hp anda dengan whatsapp web terlebih dahulu.';
        }
		
    }

}
