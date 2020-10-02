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
        return view('users.index')->with('title', 'Lihat User');
    }

    public function add()
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
