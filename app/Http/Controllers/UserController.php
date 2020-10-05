<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Users;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index')->with('app_title', 'WhatsApp API')->with('title', 'Lihat akun');
    }

    public function add()
    {
        return view('users.add')->with('app_title', 'WhatsApp API')->with('title', 'Tambah akun');
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

    public function edit($id)
    {
        return view('users.edit')->with('app_title', 'WhatsApp API')->with('title', 'Edit akun');
    }

}
