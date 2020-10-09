<?php

namespace App\Exports;

use App\Pasien;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class PasienExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Pasien::select('nama','phone')->get();
//     }

// }
class PasienExport implements FromView
{
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }
    
    public function view(): View{
        return view('pasien.export', [
                'data' => $this->data
            ]);
    }

}
