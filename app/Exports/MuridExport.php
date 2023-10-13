<?php

namespace App\Exports;

use App\Models\Murid;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;

class MuridExport implements FromView
{
    // /**
    //  * @return \Illuminate\Support\Collection
    //  */
    // protected $excel;
    // public function __construct($excel)
    // {
    //     $this->excel = $excel;
    // }

    public function view(): View
    {

        $murids = Murid::all();
        return view('admin.murid.laporanMurid', compact('murids'));
    }
    // public function headings(): array
    // {
    //     return [

    //         'NAMA TAGIHAN',
    //         'NAMA MURID',
    //         'ANGKATAN',
    //         'BULAN TAGIHAN',
    //         'STATUS',
    //         'TOTAL',
    //         // etc
    //     ];
    // }
}
