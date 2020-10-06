<?php

namespace App\Http\Controllers;

use App\Users;
use App\Pasien;
use App\Chat;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class DashboardController extends Controller
{
    public function index()
    {
        $users = Users::all();
        $pasien = Pasien::orderBy('id', 'DESC')->get();
        $chat = Chat::where('status', 'mengirim pesan')->get();

        $data = array(
            'data_pasien' => $pasien,
            'users' => count($users),
            'pasien' => count($pasien),
            'chat' => count($chat)
        );

        return view('dashboard')->with('app_title', 'WhatsApp API')->with('title', 'Dashboard')->with('data', $data);
    }

    public function msg()
    {
        return view('msg')->with('title', 'Pesan');
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

		for($i=0;$i<count($pasien);$i++){
			$no = $pasien[$i]['phone'];
			$nama = $pasien[$i]['nama'];
			$pesan = $nama.' '.$pasien[$i]['pesan'].' setiap jam 12 siang.';
			
			$r = $client->request('POST', 'http://localhost:8000/waapi/sendText', [
				'form_params' => [
					'id_device' => '11',
					'to' => $no,
					'pesan' => $pesan
				]
			]);
		}
		return redirect('/');
    }

}
