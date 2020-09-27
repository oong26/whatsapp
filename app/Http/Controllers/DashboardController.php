<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Users;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index')->with('title', 'Dashboard');
    }

    public function msg()
    {
        return view('msg')->with('title', 'Pesan');
    }

    public function sendMsg(/*Request $req*/)
    {
        $user = Users::get();
        // return $user[0]->phone;
        for($i=0;$i<sizeof($user);$i++){
            $mobile=$user[$i]->phone;
            $message=$user[$i]->name.", ".$user[$i]->obat;
            $data = [
                'phone' => $mobile, // Receivers phone
                'body' => $message, // Message
            ];
        
            $json = json_encode($data); // Encode data to JSON
            // URL for request POST /message
            $url = 'https://eu54.chat-api.com/instance176181/message?token=vuiodfsprq255oa6';
            // Make a POST request
            $options = stream_context_create(['http' => [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $json
                ]
            ]);
            // Send a request
            $result = file_get_contents($url, false, $options);
        }
        // $this->validate($req,[  
        //     'no' => 'required',
        //     'msg' => 'required'
        // ]);
        // $mobile=$req->no;
        // $message=$req->msg;
        //     $data = [
        //         'phone' => $mobile, // Receivers phone
        //         'body' => $message, // Message
        //     ];
        // $json = json_encode($data); // Encode data to JSON
        // // URL for request POST /message
        // $url = 'https://eu54.chat-api.com/instance176181/message?token=vuiodfsprq255oa6';
        // // Make a POST request
        // $options = stream_context_create(['http' => [
        //         'method'  => 'POST',
        //         'header'  => 'Content-type: application/json',
        //         'content' => $json
        //     ]
        // ]);
        // // Send a request
        // $result = file_get_contents($url, false, $options);
        // print_r($result);
    }

    public function addUser()
    {
        return view('users.add')->with('title', 'Tambah User');
    }

    public function storeUser(Request $req)
    {
        $this->validate($req,[  
            'nama' => 'required|min:3|max:50',
            'username' => 'required|min:4|max:30',
            'password' => 'required|min:4',
            'phone' => 'required'
        ]);
        
        DB::table('users')->insert([
            'name' => $req->nama,
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'phone' => $req->phone
        ]);

        return redirect('/');
    }
}
