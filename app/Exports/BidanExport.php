<?php

namespace App\Exports;

use App\Users;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BidanExport implements FromView
{
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }
    
    public function view(): View{
        return view('users.export', [
                'data' => $this->data
            ]);
    }

}
