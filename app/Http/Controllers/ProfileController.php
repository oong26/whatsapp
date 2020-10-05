<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $data = Users::where('id', $id)->get();
        return $data;
        
        return view('profile.index')->with('app_title', 'WhatsApp API')->with('title', 'Lihat akun')->with('data', $data);
    }
}
