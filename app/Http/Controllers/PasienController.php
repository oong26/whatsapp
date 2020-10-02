<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        return view('pasien.index')->with('title','Lihat Pasien');
    }

    public function add()
    {
        return view('pasien.add')->with('title','Tambah Pasien');
    }
}
